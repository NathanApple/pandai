<?php

namespace App\Http\Controllers;

// use Auth;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return to_route("question");
    }

    public function view(Request $request, $id){
        $question = Question::find($id);
        $answers = Answer::where('question_id', $id)->get();

        return view('question.view', compact('question', 'answers'));
    }

    public function answer(Request $request, $id){
        $question = Question::find($id);

        Answer::create([
            'user_id' => Auth::user()->id,
            'question_id' => $id,
            'answer' => $request->answer,
            'points' => $question->points,
        ]);

        return redirect(route('question.view', ['id' => $id]))->with('success','Jawaban berhasil disimpan');
    }
}