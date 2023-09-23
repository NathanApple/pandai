<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //
    public function index(Request $request){
        return view('question.index');
    }
}
