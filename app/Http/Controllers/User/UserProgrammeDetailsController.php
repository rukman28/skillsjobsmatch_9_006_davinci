<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Programme;
use App\Models\User;
use App\Models\Level;
use App\Traits\UserSkill;
use App\Models\Skill;
use App\Models\Module;
use App\Models\Practical;

class UserProgrammeDetailsController extends Controller
{
    use UserSkill;

    public function index(){
        return view('user.dashboard');
    }

    public function selectProgramme(){
        $user = Auth::user();

        if(is_null($user->programme_id) || empty($user->programme_id)){
            $programmes = Programme::all();
            return view('user.programme.select_programme', compact('programmes'));
        }else{
            $this->selectModules();
        }

        //$user_programme = $user->programme_id
    }

    public function changeProgramme(Request $request){
        $programmes = Programme::all();
        return view('user.programme.select_programme', compact('programmes'));
    }

    public function storeProgramme(Request $request){
        if($request->programme){
            User::where('id', Auth::id())
                ->update(['programme_id' => $request->programme]);

            return redirect()->route('user.select.modules')->withSuccess('Programme was successfully added to your profile.');
        }else{
            return Redirect()->back()->with('error', 'Error occurred: 6544346');
        }
    }


    public function selectModules()
    {

        /*$user = Auth::user();
        $user_programme = Programme::find($user->programme_id);
        $user_modules = $user->modules;
        var_dump($user_modules);
        return view('layouts.user.programme.show_user_modules', compact('user_modules', 'user_programme'));*/

        $user = Auth::user();
        $user_modules = $user->modules;
        $programme_id = $user->programme_id;
        $programme = Programme::find($programme_id);
        $programme_modules = $programme->modules;

        $available_modules = $programme_modules->diff($user_modules)->sortBy('title');

        return view('user.programme.select_modules', compact('available_modules', 'programme'));
    }

    public function storeUserModules(Request $request)
    {
        $request->validate([
            'module_ids' => 'required|array',
        ], [
            'module_ids.required' => 'Select modules to add',
        ]);

        $user = Auth::user();
        $user->modules()->syncWithoutDetaching($request->module_ids);

        return redirect()->route('user.show.modules')->withSuccess('Modules were added successfully.');
    }

    public function userSkills()
    {
        $user = Auth::user();
        $skills = $this->getAllUserSkills($user);

        //dd($skills);

        if(!$user->modules->count()){
            return redirect()->route('user.select.modules')->with('error', 'You have not selected any modules for your programme to make a search');
        }
        $user_skills = [];

        foreach ($skills as $skill_id) {
            $user_skills[] = Skill::find($skill_id);
        }

        return view('layouts.user.programme.user_skills', compact('user_skills'));
    }

    public function userPracticals()
    {
        $user_modules = Auth::user()->modules;
        if (!$user_modules->count()) {
            return redirect()->route('user.select.modules')->with('error', 'You have not selected any modules for your programme to make a search');
        } else {
            $user_practicals = [];
            foreach ($user_modules as $module) {
                foreach ($module->practicals as $practical) {
                    $user_practicals[$practical->id] = $practical;
                }
            }

            return view('user.programme.user-practicals', compact('user_practicals'));

        }
    }

    public function showUserModules()
    {
        $user = Auth::user();
        $user_programme = Programme::find($user->programme_id);
        $user_modules = $user->modules;

        return view('user.module.show', compact('user_modules', 'user_programme'));
    }

    public function deleteUserModule($id)
    {
        $user = Auth::user();
        $is_successful = $user->modules()->detach($id);
        if ($is_successful > 0) {
            return redirect()->route('user.show.modules')->withSuccess('Module deleted successfully.');
        } else {
            return redirect()->route('user.show.modules')->withSuccess('Module delete was not successful.');
        }
    }

    public function showModulesByLevel()
    {
        $programme = Programme::find(Auth::user()->programme_id);

        $user_modules = Auth::user()->modules;


        if (!$user_modules->count()) {
            return Redirect()->back()->with('error', 'You have not selected any modules for your programme');
        } else {

            $levels = Level::orderBy('title')->get();
            $data = [];
            $modules_by_level = [];

            foreach ($user_modules as $module) {
                $level = $module->levels()->wherePivot('programme_id', Auth::user()->programme_id)->first();
                if(!is_null($level)){
                    $data[] = ['module' => $module, 'level' => $level->id];
                }
            }

            foreach ($levels as $level) {
                foreach ($data as $item) {
                    if ($item['level'] == $level->id) {
                        $modules_by_level[$level->title][] = $item['module'];
                    }
                }
            }
            return view('user.programme.modules-by-level', compact('modules_by_level', 'programme'));
        }
    }

    public function programmeDetailTraverser($item_name, $item_id)
    {

        if (!Auth::user()->modules()->count()) {
            return Redirect()->back()->with('error', 'You have not selected any modules for your programme');

        } else {

            switch ($item_name) {

                case "programme":   // This comes directly from the nav bar "programme Details"
                    $collectionName = 'module';
                    $collectionOwner = Programme::find($item_id);
                    $collectionOwnerName = 'Programme';
                    $collection = Auth::user()->modules;
                    return view('user.programme.programme-item-traverse', compact('collectionOwner', 'collectionName', 'collection', 'collectionOwnerName'));

                case "modules":
                    $collectionName = 'practical';
                    $collectionOwner = Module::find($item_id);
                    $collectionOwnerName = 'Module';
                    $collection = $collectionOwner->practicals;
                    return view('user.programme.programme-item-traverse', compact('collectionOwner', 'collectionName', 'collection', 'collectionOwnerName'));

                case "practicals":
                    $collectionName = 'skill';
                    $collectionOwner = Practical::find($item_id);
                    $collectionOwnerName = 'Practical';
                    $collection = $collectionOwner->skills;


                    $categorised_skills_arr = []; // two-dimensional array
                    foreach ($collection as $skill) {
                        $skill_category_title = $skill->skillCategory->title;

                        $found_match = false;
                        foreach ($categorised_skills_arr as $key => $category_skills) {
                            if ($skill_category_title === $key) {
                                $categorised_skills_arr[$key][] = $skill;
                                $found_match = true;
                                break;
                            }
                        }

                        if (!$found_match) {
                            $categorised_skills_arr[$skill_category_title][] = $skill;
                        }

                    }

                    $collection = $categorised_skills_arr;
                    return view('user.programme.programme-item-traverse', compact('collectionOwner', 'collectionName', 'collection', 'collectionOwnerName'));

            }
        }
    }
}
