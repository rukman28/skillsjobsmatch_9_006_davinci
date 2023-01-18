<?php

namespace App\Traits;

trait RegExPatterns
{

    public function filterString($pattern/*pattern to be filter out the string*/,$str/*string to be filtered*/)
    {

        switch($pattern){
            case "ENGLISH_LETTER":

                $filtered_string = preg_replace('/[^A-Za-z]/', '', $str);
                return $filtered_string;


            default:
                return $str;
        }

    }

    public function stringMatch($string_to_pattern, $str)
    {


        if(is_array($string_to_pattern)){
            ///////////This will return how many skills are matched in the give string////////////////////
            $count=0;

            foreach ($string_to_pattern as $key => $st){

                if( preg_match("/$st/i",$str)){
                    $count++;
                }



            }
            return $count;

        }else{

            /////////////////This will return if a given string is matched with a given string///////////////////
            $pattern = '/\b'.$string_to_pattern.'\b/i';

            $boolean = preg_match($pattern,$str);

            return $boolean;


        }


    }

    public function matchReplacement($pattern,$replacement,$text,$limit,&$count){

        if($limit == null){
            $limit = -1;
        }

        if(is_array($pattern)){
            foreach ($pattern as $key => $p){

                $pattern[$key]="/($p)/i";
            }

            ksort($pattern);
        }

        if(is_array($replacement)){
            ksort($replacement);
        }

        $count=0;


        return preg_replace($pattern,$replacement,$text,$limit,$count);



    }

    ////////////////////////////////////////////////////////////////////////////////////////////////
    /// This is been replaced by the laravel helper function ///////////////////////////////////////
    public function singularVersion($str/*string to be converted*/)
    {
        if (preg_match('/\b[a-zA-Z]+(?=ves\b)/i', $str, $match)) {
            foreach ($match as $m) {
                if (preg_match('/\b[a-zA-Z]+i\b/i', $m, $m_arr)) {
                    return $m_arr[0] . 'fe';
                } else {
                    return $m . 'f';
                }
            }

        } elseif (preg_match('/\b[a-zA-Z]+(?=ies\b)/i', $str, $match_arr)) {
            return $match_arr[0] . 'y';

        } elseif (preg_match('/\b[a-zA-Z]+(?=ses\b)/i', $str, $match_arr)) {

            return $match_arr[0] . 'se';

        } elseif (preg_match('/\b[a-zA-Z]+(?=es\b)/i', $str, $match_arr)) {

            return $match_arr[0];

        } elseif (preg_match('/\b[a-zA-Z]+(?=s\b)/i', $str, $match_arr)) {

            return $match_arr[0];

        } else {
            return $str;
        }

    }


}
