<?php

namespace App\Http\Controllers\Editor;

use App\Models\Level;
use App\Models\Module;
use App\Models\Programme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::all();
        return view('editor.levels.index', compact('levels'));
    }

    public function showDetails($id)
    {
        $level = Level::find($id);
        $added_by = $level->added_by ? \App\Models\User::find($level->added_by)->name : 'Unknown';


        $level_programmes = $level->programmes()->get()->unique('title');

        $level_modules = $level->modules()->get()->unique('code');

        return view('editor.levels.level_details', compact(['level', 'level_programmes', 'level_modules', 'added_by']));

        /*$programme_modules = $programme->modules()->get();
        $programme_users = $programme->users()->get()->count();

        $programme_levels = $programme->levels()->orderByDesc('level_module_programme.created_at')->get();
        $programme_levels = $programme_levels->unique('title');


        return view('layouts.admin.programmes.programme_details', compact(['programme', 'added_by', 'programme_modules', 'programme_users', 'programme_levels']));*/
    }

    public function removeModule(Request $request){

        $module = Module::find($request->module_id);
        $level = Level::find($request->level_id);

        $programme_ids=[];
        $affecting_users=[];
        $affecting_programmes=[];

        //A module is taught only once in a programme and it can be taught in any number of programmes therefore
        //we can check how many programmes are using a module. Since each level module programme in  the level_module_programme table is unique
        //if we find the modules for each level in that table which will in turn give us the number of programmes they are been used. Further these
        //resulted record set can be filtered to find how many times a particular module has been repeated in that table under a particular level
        //which will give you all the programmes that module has been taught under that level.

        //$level _module_repeatings is used to hold all the records from the level_module_programme table for each level
        $level_module_repeatings=$level->modules()->where('modules.id',$request->module_id)->get();

        foreach ($level_module_repeatings as $repeating){

            $programme_ids[]=$repeating->pivot->programme_id;
        }

        //dd($programme_ids);

        $module_users = $module->users;

        foreach ($module_users as $user){
            foreach ($programme_ids as $id){
                // dd( 'I am here 200');
                if($user->programme_id == $id){

                    $affecting_users[]=$user;
                    $affecting_programmes[$id]=$id;
                }
            }
        }

        $affecting_users_count=count($affecting_users);
        $number_of_programmes=count($programme_ids);
        $affecting_programmes_count=count($affecting_programmes);

        if($affecting_users_count){
            return redirect()->back()->with('error',"Aborted! $number_of_programmes programmes using the module under level $level->title. $affecting_programmes_count Programmes have $affecting_users_count users"  );
        }
        else{
            $level->modules()->wherePivotIn('programme_id',$programme_ids)->detach($request->module_id);
            return redirect()->back()->with('success','The Module was removed');
        }
    }

    public function removeProgramme(Request $request){
        $level = Level::find($request->level_id);
        $programme = Programme::find($request->programme_id);

        //find all the affecting modules with this detach and check if it has any associate students under that programme

        $affecting_modules=$level->modules()->wherePivot('programme_id',$request->programme_id)->get();

        $modules_with_students = 0;
        $module_ids=[];
        $affecting_users=[];
        $affecting_users=collect($affecting_users);

        foreach ($affecting_modules as $module){
            $users=$module->users()->where('programme_id',$request->programme_id)->get();
            if($users->count()){
                $modules_with_students++;
                $affecting_users=$affecting_users->merge($users);
            }
            $module_ids[]=$module->id;
        }
        $affecting_users=$affecting_users->unique('id');
        $affetcting_student_count=$affecting_users->count();
        $total_modules=$affecting_modules->count();

        if($modules_with_students){
            return redirect()->back()->with('error',"Aborted! Total modules affecting =  $total_modules, Modules with students = $modules_with_students, Affecting students = $affetcting_student_count");
        }else{
            $level->modules()->wherePivot('programme_id', $request->programme_id)->detach($module_ids);
            return redirect()->back()->with('success','Successfully removed the programme.');
        }
    }

    public function addNewLevelView(){
        return view('editor.levels.add_level'); // 'admin.level.add.view'
    }

    public function storeLevel(Request $request){
        $request->validate([
            'title' => 'required|unique:levels,title',
        ]);
        Level::create($request->all());
        return redirect()->route('editor.levels.index')->with('success', 'New level was created by ' . $request->title . '.');
    }

    public function updateLevelNameView($id){
        $level = Level::find($id);
        return view('editor.levels.edit_level', compact('level'));
    }

    public function updateLevelName(Request $request){
        $request->validate([
            'title' => 'required|unique:levels,title',
        ]);

        $level = Level::find($request->level_id);
        $oldLevelTitle = $level->title;
        $level->title = $request->get('title');
        $level->save();

        return redirect()->route('editor.levels.index')->with('success', ' Level Title Updated Successfully. ' . $oldLevelTitle . ' => ' . $level->title . '.');
    }

    public function deleteLevel($level_id){

        $level = Level::find($level_id);
        $message = $level->title;

        if($level->programmes->isEmpty()){
            $level->delete();
            $message .= ' was removed.';
            return redirect()->route('editor.levels.index')->with('success', $message);
        }else{
            $message .= ' can not be deleted. The Level relate to modules and courses.';
            return redirect()->route('editor.levels.index')->with('error', $message);
        }
    }

    public function showLevelsBin(){
        $levels = Level::onlyTrashed()->get();

        return view('editor.levels.level_bin', compact('levels'));
    }

    public function forceLevelDelete($id){
        Level::onlyTrashed()->where('id',$id)->forceDelete();

        return redirect()->route('editor.levels.index')->withSuccess('Level removed successfully.');
    }

    public function restoreLevel($id){

        Level::onlyTrashed()->where('id',$id)->restore();

        return redirect()->back()->withSuccess('Level restored successfully.');
        /*        return redirect()->route('level.index')->withSuccess('Level restored.');*/
    }
}
