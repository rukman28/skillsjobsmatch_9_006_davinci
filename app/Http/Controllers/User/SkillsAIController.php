<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;


class SkillsAIController extends Controller
{

    public function generateCoverLetterForm(){
        return view('user.skills_ai.generate_cover_letter_form');
    }

    public function generateCoverLetter(Request $request){
        $open_ai = new OpenAi($_ENV['OPEN_AI_SECRET']);

        $prompt = $request->prompt;

        $result = $open_ai->createEdit([
            "model" => "text-davinci-edit-001",
            "input" => $prompt,
            "instruction" => "Write a cover letter applying for the job",
        ]);

        $json_result = json_decode($result, true);

        //dd($json_result['choices'][0]['text']);

        $cover_letter = $json_result['choices'][0]['text'];

        //$cover_letter = "Test";

        return view('user.skills_ai.generate_cover_letter_result', compact('cover_letter'));
    }

    public function generateQAForm(){
        return view('user.skills_ai.generate_interview_questions_form');
    }

    public function generateQAResult(Request $request){
        $open_ai = new OpenAi($_ENV['OPEN_AI_SECRET']);

        $prompt = $request->prompt;

        $result = $open_ai->completion([
            'model' => 'text-davinci-002',
            'prompt' => 'Create a list of 20 questions for my interview with a ' . $request->prompt .':\n',
            'temperature' => 0.9,
            'max_tokens' => 450,
            'frequency_penalty' => 0,
            'presence_penalty' => 0.6,
        ]);

        $json_result = json_decode($result, true);

        //dd($json_result);

        $questions = $json_result['choices'][0]['text'];

        //dd($questions);

        return view('user.skills_ai.generate_interview_questions_result', compact('questions'));

        //$cover_letter = "Test";

    }
}
