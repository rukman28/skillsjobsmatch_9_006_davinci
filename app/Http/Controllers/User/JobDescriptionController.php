<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\RegExPatterns;
use App\Traits\UserSkill;
use Illuminate\Support\Facades\Auth;
use App\Models\Programme;

class JobDescriptionController extends Controller
{
    use UserSkill, RegExPatterns;

    public function showAddJObDescriptionPage()
    {
        if(!Auth::user()->modules()->count()){
            return redirect()->route('user.select.modules')->with('error', 'You have not selected any modules for your programme to make a search');
        }else{
            return view('user.search.job_description');
        }
    }

    public function jobDescriptionSearch(Request $request)
    {

        $user = Auth::user();

        $programme = Programme::find($user->programme_id);

        $text = strip_tags($request->job_description);

        $pattern_arr = [];
        $replacement_value_arr = [];
        $count = 0;

        $user_skill_list = $this->getAllUserSkills($user);

        foreach ($user_skill_list as $skill_title => $skill_id) {

            $pattern_arr[] = $skill_title;
            //////////////////////////////////This will replace with each match so
            $replacement_value_arr[] = "<a class=\"text-red-500 underline  hover:decoration-dashed \" href=\"" . route('user.basic.skill.details', $skill_id) . "\">$1</a>";
        }
        $new_text = $this->matchReplacement($pattern_arr, $replacement_value_arr, $text, -1, $count);
        $count = $this->stringMatch($pattern_arr, $text);

        return view('user.search.job_description_result', compact('new_text', 'count', 'programme'));

    }
}
