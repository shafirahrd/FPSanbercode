<?php

namespace App\Http\Controllers;

use App\QuestionComment;
use Illuminate\Http\Request;

class QuestionCommentController extends Controller
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
        QuestionComment::insert($request, $id);
        return redirect()->action('QuestionController@show', ['question' => $id]);
    }
}
