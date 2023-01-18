<?php

namespace App\Http\Controllers\Editor;

use App\Models\Programme;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;

class ProgrammeController
{
    public function index()
    {
        $programmes = Programme::all();
        return view('editor.programmes.index', compact('programmes'));
    }

    public function addProgrammeView()
    {
        return view('editor.programmes.add_programme');
    }

    public function editProgrammeView($id)
    {
        $programme = Programme::find($id);
        return view('editor.programmes.edit_programme', compact('programme'));
    }

    public function storeProgramme(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:programmes,title',
        ]);

        $programme['title'] = strip_tags($request->title);
        $programme['added_by'] = Auth::user()->id;

        Programme::create($programme);

        return redirect()->route('editor.programme.index')->with('success', 'New Programme Created. ' . $request->title . '.');
    }

    public function updateProgramme(Request $request)
    {

        $request->validate([
            'title' => 'required|unique:programmes,title',
        ]);

        $programme = Programme::find($request->id);

        $oldProgrammeTitle = $programme->title;

        $programme->title = $request->get('title');
        $programme->save();

        return redirect()->route('editor.programme.index')->with('success', 'Programme title updated successfully from ' . $oldProgrammeTitle . ' to ' . $programme->title . '.');
    }

    public function deleteProgramme($id)
    {
        $programme = Programme::find($id);

        $message = $programme->title . ' - ';

        if ($programme->modules->isEmpty()) {
            if ($programme->users->count()) {
                return back()->with('error','Programme can not be deleted. It has associated students.');
            } else {
                $programme->delete();
                $message .= 'was deleted.';
                return redirect()->route('editor.programmes.index')->with('success', $message);
            }

        } else {
            $message .= 'can not be deleted. It has associated modules.';
            return redirect()->route('editor.programmes.index')->with('error', $message);
        }
    }

    public function showProgrammeBin()
    {
        $programmes = Programme::onlyTrashed()->get();

        return view('editor.programmes.programme_bin', compact('programmes'));
    }

    public function forceDelete($id)
    {
        Programme::onlyTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('editor.programmes.index')->withSuccess('Programme removed successfully.');
    }

    public function restore($id)
    {
        Programme::onlyTrashed()->where('id', $id)->restore();
        return redirect()->back()->withSuccess('Programme restored.');
        /* return redirect()->route('programme.index')->withSuccess('Programme restored.'); */
    }

    public function showDetails($id)
    {
        $programme = Programme::find($id);
        $added_by = $programme->added_by ? User::find($programme->added_by)->name : 'Unknown';

        $programme_modules = $programme->modules()->get();
        $programme_users = $programme->users()->get()->count();

        $programme_practicals = [];
        foreach ($programme_modules as $module){
            //['programme'=>$programme,'level'=>Level::find($programme->pivot->level_id)];
            //$module

            $programme_practicals[] = $module->practicals()->get();
        }

        $programme_levels = $programme->levels()->orderByDesc('level_module_programme.created_at')->get();
        $programme_levels = $programme_levels->unique('title')->sortBy('title');

        return view('editor.programmes.programme_details', compact(['programme', 'added_by', 'programme_modules', 'programme_users', 'programme_levels', 'programme_practicals']));
    }

    public function getProgrammeSkills($programme_id){
        // Skills List Array
        $user_skill_list = [];

        // Get all modules in the programme
        $programme = Programme::find($programme_id);
        $pro_modules = $programme->modules()->orderByDesc('level_module_programme.created_at')->get();
        // For each module get all practicals.
        foreach($pro_modules as $module){
            $practicals = $module->practicals;
            // Get all skills in each practical.
            foreach($practicals as $practical) {
                $practical_skills = $practical->skills;
                foreach($practical_skills as $skill) {

                    //$skillCategoryItem = Skill::find($skill->id);
                    //$added_by = $programme->added_by ? \App\Models\User::find($programme->added_by)->name : 'Unknown';

                    //$skills=$skillCategory->skills();
                    $user_skill_list[] = $skill->title;
                    //$data[]=['Skills'=>$skills];
                }
                //$user_skill_list = $practical_skills;
            }
        }
        $user_skill_list = array_count_values($user_skill_list);
        //dd($counts);

        return view('editor.programmes.programme_skills', compact(['user_skill_list', 'programme']));
    }

    public function getSkillByTitle($title){
        $skill = DB::table('skills')
            ->where('title', $title)
            ->first();

        return redirect()->route('editor.skill.show.details', $skill->id);
    }
}
