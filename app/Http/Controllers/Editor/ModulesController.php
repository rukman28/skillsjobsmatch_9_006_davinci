<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Module;
use App\Models\Practical;
use App\Models\Programme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ModulesController extends Controller
{
    public function index(){
        $modules = Module::all();
        return view('editor.modules.index', compact('modules'));
    }

    public function showDetails($id){

        $data=[];
        $module = Module::find($id);

        $added_by = $module->added_by ? User::find($module->added_by)->name : 'Unknown'; //UNKNOWN must not be applied
        $module_programmes =$module->programmes()->orderBy('pivot_created_at','desc')->get();

        foreach ($module_programmes as $programme){
            $data[] = ['programme'=>$programme,'level'=>Level::find($programme->pivot->level_id)];
        }

        $module_practicals = $module->practicals()->get();
        $module_students = $module->users()->count();

        return view('editor.modules.module_details', compact(['module', 'added_by', 'data', 'module_practicals', 'module_students']));
    }

    public function removeProgramme(Request $request){

        $request->validate([
            'module_id'=>'required|numeric',
            'programme_id'=>'required|numeric'
        ]);
        $module=Module::find($request->module_id);
        $programme=Programme::find($request->programme_id);

        try {
            $module->programmes()->detach($request->programme_id);
            return redirect()->back()->with('success','[ '.$programme->title.' ] Module Link was deleted.');
        }catch(QueryException $e){
            return redirect()->back()->with('error','[ '.$programme->title.' ] Module Link has associated students.');
        }
    }

    public function removePractical(Request $request){
        $module = Module::find($request->module_id);
        $practical = Practical::find($request->practical_id);

        try {
            $module->practicals()->detach($request->practical_id);

            return redirect()->back()->with('success','[ '.$practical->title.' ] Practical link was deleted.');
        }catch(QueryException $e){
            return redirect()->back()->with('error','Practical has associated links with other tables.');
        }

        //return redirect()->route('module-practicals-used', $request->module_id)->with('success','The [ ' . $practical->title . ' ] was removed.');
    }

    public function addNewModuleView(){

        $programmes = Programme::all();
        $levels = Level::all();

        return view('editor.modules.add_module', compact('programmes', 'levels'));
    }

    public function storeNewModule(Request $request){
        $request->validate([
            'title' => 'required|unique:modules,title',
            'code' => 'required|unique:modules,code',
            'programme_id' => 'integer',
            'level_id' => 'integer'
        ], [
            'programme_id.integer' => 'Select a programme',
            'level_id.integer' => 'Select a level'
        ]);

        $request->merge(['added_by' => Auth::id()]);

        try {

            DB::beginTransaction();

            $module = Module::create($request->all());

            $module->programmes()->attach($request->programme_id, [
                'level_id' => $request->level_id,
                'added_by' => $request->added_by,
            ]);

            DB::commit();

            return redirect()->route('editor.modules.index')->with('success', 'New Module Created.[ ' . $request->title . ' ]');


        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('editor.modules.index')->with('error', 'Module creation aborted for [ ' . $request->title . ' ] Try Again');

        }
    }

    public function editModuleView($id){

        $module = Module::find($id);
        return view('editor.modules.edit_module', compact('module'));
    }

    public function updateModuleName(Request $request){

        $request->validate([
            'title' => 'required|unique:modules,title',
        ]);

        $module = Module::find($request->module_id);
        $oldModuleTitle = $module->title;
        $module->title = $request->title;
        $module->save();

        return redirect()->route('editor.modules.index')->with('success', 'Module title updated Successfully. ' . $oldModuleTitle . ' => ' . $module->title . '.');
    }

    public function removeModule($id){
        //working fine without pivot table
        $module = Module::find($id);

        $message = [
            'msg' => '[ ' . $module->title . ' ] ',
            'msg_type' => 'success'
        ];

        if($module->programmes->isEmpty()){
            if($module->practicals->isEmpty()){
                $module->delete();
                $message['msg'] .= 'was removed.';
            }else{
                $message['msg'] .= 'can not be deleted. It has related Practicals.';
                $message['msg_type'] = 'error';

                return redirect()->route('editor.modules.index')->with($message['msg_type'], $message['msg']);
            }
            return redirect()->route('editor.modules.index')->with($message['msg_type'], $message['msg']);
        }else{
            $message['msg'] .= 'can not be deleted. It has related  Programmes.';
            $message['msg_type'] = 'error';

            return redirect()->route('editor.modules.index')->with($message['msg_type'], $message['msg']);
        }
    }

    public function showModulesBin(){
        $modules = Module::onlyTrashed()->get();
        return view('editor.modules.module_bin', compact('modules'));
    }

    public function forceModuleDelete($id){
        Module::onlyTrashed()->where('id',$id)->forceDelete();

        return redirect()->route('editor.modules.index')->withSuccess('Module removed successfully.');

    }

    public function restoreModule($id){
        Module::onlyTrashed()->where('id',$id)->restore();

        return redirect()->back()->withSuccess('Module restored successfully.');
        /* return redirect()->route('module.index')->withSuccess('Module restored.');*/
    }

    public function showAvailableProgrammesToModule($id){

        $module = Module::find($id);
        $module_programmes = $module->programmes;
        $all_programmes = Programme::all();

        $available_programmes = $all_programmes->diff($module_programmes);
        $available_programmes = $available_programmes->sortBy('title');

        $levels = Level::all();
        $levels = $levels->sortBy('title');

        return view('editor.modules.select_programmes',compact('available_programmes','levels','module'));
    }

    public function addProgrammeToModule(Request $request){

        $request->validate([
            'programme_id'=>'numeric',
            'level_id'=>'numeric',
            'module_id'=>'required',
        ],
            [
                'programme_id.numeric'=>'Select a programme',
                'level_id.numeric'=>'Select a level',
                'module_id.required'=>'Incorrect data. Try again.'
            ]);
        try{
            $module=Module::find($request->module_id);
            $module->programmes()->attach($request->programme_id,[
                'level_id'=>$request->level_id,
                'added_by'=>Auth::id()
            ]);
            return redirect()->route('editor.module.details' ,$request->module_id)->with('success', 'New module and academic course link was created successfully.');

        } catch(QueryException $e) {

            // mysql = 1062 Duplicate entry
            // sqlite = 19 UNIQUE constraint

            if($e->errorInfo[1] == 1062) {

                return Redirect::back()->with('error','Error has occurred. Duplicate entry.');

            }
        }


    }

    public function showAvailablePracticals($id)
    {

        $module = Module::find($id);
        $module_practicals = $module->practicals;
        $practicals = Practical::all();
        $availablePracticalsToBook = $practicals->diff($module_practicals)->sortBy('title');

        return view('editor.modules.select_practicals', compact('availablePracticalsToBook', 'module'));
    }

    public function storeModulePracticals(Request $request)
    {
        $request->validate([
            'module_id' => 'required',
            'practical_ids' => 'required|array',
        ],
            [
                'practical_ids.required'=>'Select Practicals',
            ]);

        $module = Module::find($request->module_id);

        foreach ($request->practical_ids as $id){
            $module->practicals()->sync([$id => ['added_by' => Auth::id()]], false);
        }

        return redirect()->route('editor.module.details', $module->id)->with('success','The Practicals were added successfully.');
    }
}
