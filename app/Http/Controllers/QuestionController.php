<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //
    public function index(Request $request){
        $questions = Question::get();
        return view('question.index', compact('questions'));
    }

    public function store(Request $request){
        $question = new Question();
        $user = Auth::user();
        $question->user_id =  $user->id;
        $question->question = $request->question;
        $question->refundPoints = 1;
        $question->Points = 2;
        $question->save();
        return $this->index($request);
    }
}