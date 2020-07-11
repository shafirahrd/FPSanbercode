<?php

namespace App\Http\Controllers;

use App\AnswerComment;
use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AnswerCommentController extends Controller
{
    //


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Session::has('id'))
            return view('question.form');
        else
            return redirect('login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        AnswerComment::insert($request, $id);
        $answer = Answer::find($id);
        return redirect()->action('QuestionController@show', ['question' => $answer->question->id]);
    }
}
