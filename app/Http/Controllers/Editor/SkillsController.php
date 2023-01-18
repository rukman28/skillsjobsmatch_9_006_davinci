<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Practical;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\User;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function index(){
        $skills = Skill::all();
        return view('editor.skills.index', compact('skills'));
    }

    public function addNewSkillView(){

        $skillCategories = SkillCategory::all();
        return view('editor.skills.add_skill', compact('skillCategories'));
    }

    public function storeSkillDetails(Request $request){
        $request->validate([
            'title' => 'required|unique:skills,title',
            'skill_category_id' => 'required|integer'

        ]);

        Skill::create($request->all());
        return redirect()->route('editor.skills.index')->with('success', 'New Skill Created Successfully. [' . $request->title . ']');
    }

    public function showDetails($id){

        $skill = Skill::find($id);
        $practicals = $skill->practicals;

        $skill_category = $skill->skillCategory->title;

        $added_by = $skill->added_by ? User::find($skill->added_by)->name : 'Unknown'; //UNKNOWN must not be applied

        return view('editor.skills.skills_details', compact('practicals', 'skill', 'added_by', 'skill_category'));
    }

    public function removePractical(Request $request)
    {

        $practical_id=$request->practical_id;
        $skill = Skill::find($request->skill_id);
        $skill->practicals()->detach($practical_id);

        $practical = Practical::find($practical_id);

        return redirect()->back()->with('success', $practical->title.' was removed.');
    }

    public function editSkill($id){

        $skill = Skill::find($id);
        $skillCategories = SkillCategory::all();
        $selected_category = $skill->skillCategory;

        return view('editor.skills.edit_skill', compact('skill','skillCategories','selected_category'));
    }

    public function updateSkillDetails(Request $request){
        $request->validate([
            'title' => 'required',
            'skill_category_id'=>'required|integer',
        ],[
            'skill_category_id.integer' =>'Select a Skill Category to proceed.'
        ]);

        $skill = Skill::find($request->skill_id);

        $oldSkillTitle = $skill->title;
        $skill->title = $request->title;
        $skill->skill_category_id = $request->skill_category_id;
        $skill->save();

        return redirect()->route('editor.skills.index')->with('success', 'Skill Details updated Successfully. ' . $oldSkillTitle . ' => ' . $skill->title . '.');

        /* Old code
         *
         * if($skill->title == $request->title){
            $skill->skill_category_id = $request->skill_category_id;
            $skill->save();
        }elseif(Skill::where('title',$request->title)->first()){
            $skill->title=$request->title;
            $skill->skill_category_id=$request->skill_category_id;
            $skill->save();
            return redirect()->back()->with('error','The title has already been taken.');
        }else{
            $skill->title=$request->title;
            $skill->skill_category_id=$request->skill_category_id;
            $skill->save();

        return redirect()->route('admin.skills.index')->with('success', 'Skill Details were Updated.');
        }*/



    }

    public function deleteSkill($id){
        $skill = Skill::find($id);
        $message['msg'] = '[ '. $skill->title . ' ] ';
        $message['msg_type'] = 'success';

        if($skill->practicals->isEmpty()){
            $skill->delete();
            $message['msg'] .= 'was deleted successfully.';
            return redirect()->route('editor.skills.index')->with($message['msg_type'], $message['msg']);
        }else{
            $message['msg'] = 'It can not be deleted. The skill has associated Practicals';
            $message['msg_type'] = 'error';
            return redirect()->route('editor.skills.index')->with($message['msg_type'], $message['msg']);

        }
    }

    public function showBin(){
        $skills = Skill::onlyTrashed()->get();
        return view('editor.skills.skills_bin', compact('skills'));
    }

    public function forceDelete($id){
        Skill::onlyTrashed()->where('id',$id)->forceDelete();
        return redirect()->route('editor.skills.index')->withSuccess('Skill removed successfully.');
    }

    public function restore($id){
        Skill::onlyTrashed()->where('id',$id)->restore();
        return redirect()->back()->withSuccess('Skill restored successfully.');
        /* return redirect()->route('skill.index')->withSuccess('Skill restored.');*/
    }

    public function getModulesBySkillId($id){

        $skill = Skill::find($id);

        $data = (object)[];;

        $practicals = $skill->practicals;

        foreach ($practicals as $practical){
            $data = $practical->modules()->get();
            //dd(gettype($practical->modules()->get()));
        }

        //dd($data);
        //$data = collect($data);

        return view('editor.skills.modules_by_skill', compact('data', 'skill'));


    }


}
