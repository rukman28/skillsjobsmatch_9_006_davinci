<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Programme;
use App\Models\Skill;
use App\Traits\RegExPatterns;
use App\Traits\UserSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Practical;
use Illuminate\Support\Str;


class SkillSearchController extends Controller
{
    use UserSkill, RegExPatterns;

    const PATTERN_REGEX_EN_LETTERS = 'ENGLISH_LETTER'; // This is passed to the filter string to filter the string for English letters only


    public function showSkillDetails($id)
    {

        $user = Auth::user();
        $skill = Skill::find($id);
        $skill_practiced_times = 0; //This is passed to the UserSkill Traits
        $user_programme = Programme::find($user->programme_id);

        $skill_result = $this->getUserSkillDetails($skill->title, $skill_practiced_times);

        return view('user.search.basic_search_result', compact('user_programme', 'skill_practiced_times', 'skill_result'));

    }

    public function showSkillsSearchForm()
    {
        return view('user.search.basic-search-form');
    }

    /*public function basicSkillSearchResult(Request $request)
    {
        return view('layouts.user.search.basic_search_result');
    }*/

    public function searchForGivenSkill(Request $request, $id = null)
    {

        if (($request->skill == null) && ($id == null)) {
            return redirect()->route('user.dashboard')->withErrors('Enter skill to search.');
        }


        ///////////////////////////Setting the skill to be matched using the same////////////
        ////////////  route for both link and the form submit//////////////////////////////////
        if ($id) {
            $user_input_skill = Skill::find($id)->title; //coming from a link with the skill id
        } else {
            $user_input_skill = $request->skill; //coming from a from skill title
        }


        ////////////////////////////////Extracting all the skills student has done////////////////////////////////////
        $user = Auth::user();
        $skill_practiced_times = 0; //This is passed to the UserSkill Traits
        $user_programme = Programme::find($user->programme_id);

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// [getAllUserSkills] this will return all the user skills that the user has done so far//////////////////
        /// ///////////////////////////////////////////////////////////////////////////////////////////////////////
        $user_skill_list = $this->getAllUserSkills($user);

        //check if user has not selected any modules for his programme the [getAllUserSkills] will return nil
        if (!count($user_skill_list)) {
            //return Redirect()->back()->with('error', 'You have not selected any modules for your programme to make a search');
            return redirect()->route('user.select.modules')->with('error', 'You have not selected any modules for your programme to make a search');
        } else {


            //////////////////////////////////////////////////////////////////////////////////////////////////
            /// [filterString] function filter the given word to remain only the English letters
            /// it also removes the white spaces in the given word.
            /// [stringMatch] function matches a string to a given pattern and returns
            /// true for a match and false for a not match
            /// //////////////////////////////////////////////////////////////////////////////////////////////

            $found_skill = []; //////This array is using to store all the matching results to pass to the view

            ////////////////////////////////////////////////////////////////////////////////////////////////////////
            /// This snippet will match the input skill against all the user skills to find a match////////////////
            /// both the matching input skill and the user skills are sent to the [filterString] //////////////////
            /// before the take place the matching.///////////////////////////////////////////////////////////////
            /// //////////////////////////////////////////////////////////////////////////////////////////////////

            $filtered_skill = $this->filterString(self::PATTERN_REGEX_EN_LETTERS, $user_input_skill);

            foreach ($user_skill_list as $skill_title => $skill_id) {

                $filtered_key = $this->filterString(self::PATTERN_REGEX_EN_LETTERS, $skill_title);

                if ($this->stringMatch($filtered_skill, $filtered_key)) {

                    $skill_result = $this->getUserSkillDetails($skill_title, $skill_practiced_times);
                    return view('user.search.basic_search_result', compact('user_programme', 'skill_practiced_times', 'skill_result'));

                }
            }

/////////////////////////////////////////////////////////////////////////////////////
/// Declaration to be used in conditional statements otherwise throws an error\\\\\\
            $singular_string_arr['singular_filtered_input_skill'] = '';
            $singular_string_arr['singular_filtered_user_skill'] = '';
            $singular_string_arr['plural_filtered_user_skill'] = '';
            $string_array['skill_elements'] = array();

////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////
/// Turn the input skill into its singular form before the matching take place//////////////////
/// ////////////////////////////////////////////////////////////////////////////////
            if ($this->stringMatch(' ', $user_input_skill)) {
                $string_array['skill_elements'] = explode(' ', $user_input_skill);

                foreach ($string_array['skill_elements'] as $key => $str) {

                    $string_array['skill_elements'][$key] = Str::singular($this->filterString(self::PATTERN_REGEX_EN_LETTERS, $str));
                }
                $singular_string_arr['singular_filtered_input_skill'] = implode(' ', $string_array['skill_elements']);

            } else {

                $singular_string_arr['singular_filtered_input_skill'] = Str::singular($filtered_skill/*one word has already been filtered above*/);
            }


            unset($string_array);
            $string_array['skill_elements'] = []; //reinitializing to be used for the stored user skills

            ////////////////////////////////////////////////////////////////////////////////////////////////
            /// Turn the each user skill to its singular form before carry out the matching////////////////
            /// with each stored user skills in the system.///////////////////////////////////////////////
            /// //////////////////////////////////////////////////////////////////////////////////////////
            foreach ($user_skill_list as $skill_title => $skill_id) {

                if ($this->stringMatch(' ', $skill_title)) {
                    $string_array['skill_elements'] = explode(' ', $skill_title);

                    foreach ($string_array['skill_elements'] as $k => $str) {

                        $string_array['skill_elements']['singular'][$k] = Str::singular($this->filterString(self::PATTERN_REGEX_EN_LETTERS, $str));

                        $string_array['skill_elements']['plural'][$k] = Str::plural($this->filterString(self::PATTERN_REGEX_EN_LETTERS, $str)); //casesstudy ? casesstudies

                    }

                    $singular_string_arr['singular_filtered_user_skill'] = implode(' ', $string_array['skill_elements']['singular']);
                    $singular_string_arr['plural_filtered_user_skill'] = implode(' ', $string_array['skill_elements']['plural']);  //casesstudies

                } else {

                    $singular_string_arr['singular_filtered_user_skill'] = Str::singular($this->filterString(self::PATTERN_REGEX_EN_LETTERS, $skill_title));
                }


                if ($this->stringMatch($this->filterString(self::PATTERN_REGEX_EN_LETTERS, $singular_string_arr['singular_filtered_input_skill']), $this->filterString(self::PATTERN_REGEX_EN_LETTERS, $singular_string_arr['singular_filtered_user_skill']))) {

                    $skill_result = $this->getUserSkillDetails($skill_title, $skill_practiced_times);
                    return view('user.search.basic_search_result', compact('user_programme', 'skill_practiced_times', 'skill_result'));


                } elseif ($this->stringMatch($this->filterString(self::PATTERN_REGEX_EN_LETTERS, $singular_string_arr['singular_filtered_input_skill']), Str::singular($this->filterString(self::PATTERN_REGEX_EN_LETTERS, $singular_string_arr['plural_filtered_user_skill'])))) {


                    $skill_result = $this->getUserSkillDetails($skill_title, $skill_practiced_times);

                    return view('user.search.basic_search_result', compact('user_programme', 'skill_practiced_times', 'skill_result'));

                }


            }


            $similar_skills = [];//This will store all the skills that close to the input skill if the input skill not found in the
            ////system. User can select any skill out of these that he thinks is the one he was looking for.

            foreach ($user_skill_list as $skill_title => $skill_id) {
                similar_text($filtered_skill, $this->filterString(self::PATTERN_REGEX_EN_LETTERS, $skill_title), $percentage);
                $similar_skills[$skill_id][] = intval($percentage + 0.5);

                //if any skills done more than once by the student will be eliminated and contain only once each skill in the array
            }


            arsort($similar_skills); //This will sort the values of the array in to ascending order maintaining the key value along with it.

            $similar_skills = array_slice($similar_skills, 0, 10, true);

            foreach ($similar_skills as $skill_id => $percent) {

                $suggestion_list[] = Skill::find($skill_id);
            }


            return view('user.search.basic_result_suggestions', compact('suggestion_list', 'user_input_skill', 'user_programme'));


        }
    }
}
