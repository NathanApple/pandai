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
    public function index(Request $request)
    {
        $questions = new Question();

        $search = @$request->search;

        if (@$search){
            $questions = $questions->where('question', 'like', '%'.$search.'%');
        }

        $questions = $questions->orderByDesc('created_at')->paginate(20);

        return view('question.index', compact('questions'))->with('search', $search);
    }

    public function store(Request $request)
    {
        $question = new Question();
        $user = Auth::user();
        $question->user_id =  $user->id;
        $question->question = $request->question;
        $question->refundPoints = 1;
        $question->Points = 2;
        $question->save();

        return redirect(route('question.view', ['id' => $question->id]))->with('success','Pertanyaan berhasil disimpan');
    }

    public function view(Request $request, $id)
    {
        $question = Question::find($id);
        $answers = Answer::where('question_id', $id)->get();

        $allowAnswer = false;
        if (Auth::user()->id != $question->user->id && count($answers) < 2){
            $allowAnswer = true;
        }

        return view('question.view', compact('question', 'answers', 'allowAnswer'));
    }

    public function search(Request $search)
    {
        $query = $search->input('search');

        $question = DB::table('questions')
            ->where('question', 'like', "%{$query}%") // Apply the LIKE condition
            ->first();

        return view('index', ['question' => $question]);
    }

    public function answer(Request $request, $id)
    {
        $question = Question::find($id);

        $answer = Answer::create([
            'user_id' => Auth::user()->id,
            'question_id' => $id,
            'answer' => $request->answer,
            'points' => $question->points,
        ]);

        return redirect(route('question.view', ['id' => $id]))->with('success','Jawaban berhasil disimpan');
    }
}
