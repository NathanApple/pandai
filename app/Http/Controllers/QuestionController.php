<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //
    public function index(Request $request){
        $questions = Question::get();
        return view('question.index', compact('questions'));
    }
}
