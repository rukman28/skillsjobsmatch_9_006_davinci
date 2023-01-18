<?php

namespace App\Traits;
use Illuminate\Support\Facades\Auth;



trait UserSkill{

    public function getUserSkillDetails($skill_to_search, &$skill_practiced_times)//$skill_practiced_times passed by reference
    {
        $skill_result = [];

        $user = Auth::user();

        $user_modules = $user->modules;

        $skill_practiced_times = 0;

        foreach ($user_modules as $module) {
            $user_practicals = $module->practicals;

            foreach ($user_practicals as $practical) {

                $user_skills = $practical->skills;

                foreach ($user_skills as $skill) {
                    if ($skill->title == $skill_to_search) { //////// This must be modified with Regex to enable the flexible searching

                        $skill_result[$skill_to_search][$module->id][] = $practical;
                        ++$skill_practiced_times;
                    }
                }
            }
        }
        return $skill_result;
    }

    public function getAllUserSkills($user){
        $user_modules = $user->modules;

        $user_skill_list = [];
        foreach ($user_modules as $module) {
            $user_practicals = $module->practicals;
            //dd($user_practicals);
            foreach ($user_practicals as $practical) {
                $user_skills = $practical->skills;
                foreach ($user_skills as $skill) {
                    $user_skill_list[$skill->title] = $skill->id;
                    // [$user_skill_list] contains all the skills student has practiced
                }
            }
        }
        return $user_skill_list;
    }




}
