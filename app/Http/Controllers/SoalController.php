<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function index() {
        $data = Question::inRandomOrder()
                ->where('id', '>=', 1)
                ->where('id', '<=', 5)
                ->first();
        return view("home")->with('data', $data);
    }

    public function check_jawaban(Request $request, $id) {
        $question = Question::find($id);
    
        $selectedAnswer = $request->input('jawaban');
    
        $isCorrect = ($selectedAnswer == $question->correct_answer);
    
        if ($isCorrect) {
            return response()->json(
                [
                    'status' => 'benar',
                    'id' => $question->answer_id
                ]
            );
        }
    
        return response()->json([
            'status' => 'salah',
            'jawaban_benar' => $question->correct_answer,
            'id' => $question->answer_id
        ]);
    }
}
