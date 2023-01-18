<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Practical;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PracticalsController extends Controller
{
    public function index(){
        $practicals = Practical::all();
        return view('editor.practicals.index', compact('practicals'));
    }

    public function showDetails($id){
        $practical = Practical::find($id);
        $added_by = $practical->added_by ? User::find($practical->added_by)->name : 'Unknown'; //UNKNOWN must not be applied

        $practical_modules = $practical->modules()->get();
        $practical_skills = $practical->skills()->get();

        $skill_categories = [];

        foreach ($practical_skills as $skill){
            $skill_categories[] = $skill->skillCategory;
        }

        //Remove duplicate skill category based on category id
        $skill_categories = collect($skill_categories);
        $skill_categories = $skill_categories->unique('id')->values()->all();

        return view('editor.practicals.practical_details', compact(['practical', 'added_by', 'practical_modules', 'practical_skills', 'skill_categories']));
    }

    public function showSkillsForPractical($practical_id){
        $practical = Practical::find($practical_id);

        $usedSkills = $practical->skills()->orderBy('pivot_created_at','desc')->get();

        return view('editor.practicals.skills', compact(['usedSkills', 'practical']));

    }

    public function destroyPracticalSkill(Request $request)
    {

        $practical = Practical::find($request->practical_id);
        $skill = Skill::find($request->skill_id);
        $practical->skills()->detach($request->skill_id);

        //return redirect()->route('admin.practical.details', $request->practical_id)->with('success', '[ ' . $skill->title . ' ] was removed');
        return redirect()->back()->with('success','[ '.$skill->title.' ] Skill was successfully removed.');
    }

    public function showAvailableSkills($id)
    {
        $skills = Skill::all()->sortBy('title');
        $practical = Practical::find($id);


        $usedSkills = $practical->skills;

        $availableSkillToSelect = $skills->diff($usedSkills);

        return view('editor.practicals.select_skills', compact('availableSkillToSelect', 'practical'));
    }

    public function storePracticalSkills(Request $request)
    {
        $request->validate([
            'practical_id' => 'required',
            'skill_ids' => 'required|array'
        ], [
            'skill_ids.required' => 'Select Skills to add'
        ]);

        $practical = Practical::find($request->practical_id);

        foreach ($request->skill_ids as $id) {
            $practical->skills()->syncWithoutDetaching([$id => ['added_by' => Auth::id()]]);
        }


        return redirect()->route('prac-skill-used', $practical->id)->with('success', 'The Skills were added');
    }

    public function addSkillToPractical(Request $request){
        $request->validate([
            'practical_id' => 'required',
            'skill_ids' => 'required|array'
        ], [
            'skill_ids.required' => 'Select Skills to add'
        ]);

        $practical = Practical::find($request->practical_id);

        foreach ($request->skill_ids as $id) {
            $practical->skills()->syncWithoutDetaching([$id => ['added_by' => Auth::id()]]);
        }
        return redirect()->route('admin.practical.skills', $practical->id)->with('success', 'The Skills were added.');
    }

    public function removeModuleFromPractical(Request $request){

        $practical = Practical::find($request->practical_id);
        $module = Module::find($request->module_id);

        $practical->modules()->detach($request->module_id);
        return redirect()->back()->with('success','[ '.$module->title.' ] was removed.');
    }

    public function removeCategoryFromPractical(Request $request){

        $practical = Practical::find($request->practical_id);
        $practical_skills = $practical->skills;

        //Find all the skills for a skill category
        $skill_category = SkillCategory::find($request->skill_category_id);
        $category_skills = $skill_category->skills;

        //Find the intersecting skills for the above results
        $common_skills = $practical_skills->intersect($category_skills);

        foreach ($common_skills as $skill){
            $skill->practicals()->detach($request->practical_id);
        }

        return redirect()->back()->with('success','[ '.$skill_category->title.' ] was removed.');

    }

    public function addNewPracticalView(){
        return view('layouts.admin.practicals.add_practical');
    }

    public function addNewPractical(Request $request){
        $request->validate([
            'title' => 'required'
        ]);

        try {
            Practical::create($request->all());
            return redirect()->route('admin.practicals.index')->with('success', 'New Practical Created.[ ' . $request->title . ' ]');
        }catch(QueryException $e) {
            return redirect()->route('admin.practicals.index')->with('error', 'Practical creation aborted for [ ' . $request->title . ' ]. Try Again with a new name.');
        }

    }
    public function editPracticalName($id){
        $practical = Practical::find($id);
        return view('layouts.admin.practicals.edit_practical', compact('practical'));
    }

    public function updatePracticalName(Request $request){
        $request->validate([
            'title' => 'required|unique:practicals,title',
            'practical_id'=>'required'
        ]);

        $practical = Practical::find($request->practical_id);

        $oldPracticalTitle = $practical->title;

        $practical->title = $request->title;
        $practical->save();

        return redirect()->route('admin.practicals.index')->with('success', 'Title of the practical is updated.[ '.$oldPracticalTitle.' => '.$practical->title.' ]');
    }

    public function removePractical($id){

        $practical = Practical::find($id);

        $message='[ '.$practical->title.' ] ';
        $message_type='success';

        if($practical->modules->isEmpty()){
            if($practical->skills->isEmpty()){
                $practical->delete();
                $message.='was removed.';
                $message_type='success';

                return redirect()->route('admin.practicals.index')->with($message_type,$message);
            }else{
                $message.='can not be deleted. The practical has associated skills.';
                $message_type='error';

                return redirect()->route('admin.practicals.index')->with($message_type,$message);
            }
        }else{
            $message.='can not be deleted. The practical has associated modules.';
            $message_type='error';

            return redirect()->route('admin.practicals.index')->with($message_type, $message);
        }
    }

    public function showPracticalsBin(){

        $practicals = Practical::onlyTrashed()->get();
        return view('layouts.admin.practicals.practicals_bin', compact('practicals'));
    }

    public function forceDelete($id){

        Practical::onlyTrashed()->where('id',$id)->forceDelete();
        return redirect()->route('admin.practicals.index')->withSuccess('Practical successfully removed.');
    }


    public function restore($id){

        Practical::onlyTrashed()->where('id',$id)->restore();
        return redirect()->back()->withSuccess('Practical restored successfully.');
        /* return redirect()->route('practical.index')->withSuccess('Practical restored.');*/
    }
}
