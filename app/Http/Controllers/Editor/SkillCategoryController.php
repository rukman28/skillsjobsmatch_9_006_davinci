<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\Practical;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\User;
use Illuminate\Http\Request;

class SkillCategoryController extends Controller
{
    public function index(){

        $skillCategories = SkillCategory::all();
        return view('editor.skill-categories.index', compact('skillCategories'));
    }

    public function showDetails($id){
        $skillCategory = SkillCategory::find($id);
        // $added_by = $skillCategory->added_by ? Admin::find($skillCategory->added_by)->name : 'Unknon';
        $added_by = $skillCategory->added_by ? User::find($skillCategory->added_by)->name : 'Unknown'; //UNKNOWN must not be applied

        $skills = $skillCategory->skills()->get();

        return view('editor.skill-categories.skill_category_details', compact(['skillCategory', 'added_by','skills']));
    }

    public function removeSkill(Request $request)
    {
        $skill = Skill::find($request->skill_id);
        /*
        try {
            Skill::destroy($request->skill_id);
            return redirect()->back()->with('success', '[ ' . $skill->title . ' ] was deleted.');

        } catch (QueryException $e) {

            if ($e->errorInfo[1] == 1451) {
                return redirect()->back()->with('error', '[ ' . $skill->title . ' ] can not be deleted. It has associated practicals.');

            }
        }*/

        if($skill->practicals->isEmpty()){
            $skill->delete();
            return redirect()->back()->with('success', '[ ' . $skill->title . ' ] was deleted.');
        }else{
            return redirect()->back()->with('error', '[ ' . $skill->title . ' ] can not be deleted. It has associated practicals.');
        }
    }

    public function showEditView($id)
    {
        $skillCategory = SkillCategory::find($id);
        return view('editor.skill-categories.edit_skill_cate', compact('skillCategory'));

    }

    public function updateSkillsCategoryName(Request $request){
        $request->validate([
            'title' => 'required|unique:skill_categories,title'
        ]);

        $skillCategory = SkillCategory::find($request->id);

        $oldSkillCategoryTitle = $skillCategory->title;

        $skillCategory->title = $request->get('title');
        $skillCategory->save();

        return redirect()->route('editor.skill-categories.index')->with('success', 'Skills Category title Updated.[ ' . $oldSkillCategoryTitle . ' => ' . $skillCategory->title . ' ]');

    }

    public function removeSkillsCategory($id){

        $skillCategory = SkillCategory::find($id);
        $message['msg'] = '[ ' . $skillCategory->title . ' ] ';
        $message['msg_type'] = 'success';


        if($skillCategory->skills->isNotEmpty()){
            $message['msg'] .= 'can not be deleted. It has associated skills';
            $message['msg_type'] = 'warning';
            return redirect()->route('editor.skill-categories.index')->with('error', $message['msg']);

        }else{
            $skillCategory->delete();
            $message['msg'] .= 'removed successfully.';
            return redirect()->route('editor.skill-categories.index')->with($message['msg_type'], $message['msg']);
        }
    }

    public function addNewSkillsCategoryView(){
        return view('editor.skill-categories.add_skill_cate');
    }

    public function storeNewSkillsCategory(Request $request){
        $request->validate([
            'title' => 'required|unique:skill_categories,title'
        ]);
        SkillCategory::create($request->all());
        return redirect()->route('editor.skill-categories.index')->with('success', 'New category was created.[ ' . $request->title . ' ]');

    }

    public function showPracticals($id){

        $skill_category = SkillCategory::find($id);

        //find all skills for a skill category
        $category_skills=$skill_category->skills;

        $arr_practicals=[];

        foreach ($category_skills as $skill){
            //find practicals for each skill in the particular skill category
            $skill_practicals=$skill->practicals;
            foreach ($skill_practicals as $practical){
                //store all the practicals into $arr_practicals[]
                $arr_practicals[]=$practical;
            }
        }

        $practical_collection = collect($arr_practicals);
        //remove all the duplicate practicals from the $arr_practicals
        $practical_collection = $practical_collection->unique('id')->values()->all();

        return view('editor.skill-categories.view_practicals',compact('practical_collection','skill_category'));
    }

    public function removePractical(Request $request){

        //find all the skills for a practical
        $practical = Practical::find($request->practical_id);
        $practical_skills = $practical->skills;

        //find all the skills for a Skill Category
        $skill_category = SkillCategory::find($request->skillcategory_id);
        $category_skills = $skill_category->skills;

        //find the intersection of those two above results
        $common_skills = $practical_skills->intersect($category_skills);


        //remove binding records from the pivot table [practical_skill]
        foreach ($common_skills as $skill){
            $skill->practicals()->detach($practical->id);
        }

        return redirect()->back()->with('success','[ '.$practical->title.' ] was removed.');
    }

    public function showBin(){
        $skill_categories = SkillCategory::onlyTrashed()->get();

        return view('editor.skill-categories.skill_cate_bin', compact('skill_categories'));
    }

    public function forceDelete($id){
        SkillCategory::onlyTrashed()->where('id',$id)->forceDelete();
        return redirect()->route('editor.skill-categories.index')->withSuccess('Skill Category was successfully removed.');
    }

    public function restore($id){
        SkillCategory::onlyTrashed()->where('id',$id)->restore();

        return redirect()->back()->withSuccess('Skill Category successfully restored.');
        /* return redirect()->route('skillCategory.index')->withSuccess('Skill Category restored.');*/
    }
}
