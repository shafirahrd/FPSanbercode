<?php

namespace App\Http\Controllers;

use App\Answer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function create()
    {
        return view('question');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        Answer::insert($request, $id);
        return redirect()->action('QuestionController@show', ['question'=>$id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('question');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $answer = Answer::find($id);
        if(Session::has('id') && (Session::get('id')==$answer->uploader->id))
        return view('answer.form_edit', compact('answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $answer = Answer::find($id);
        $question = $answer->question;
        if(Session::has('id') && (Session::get('id')==$answer->uploader->id)){
            Answer::update_($request, $id);
            return redirect()->action('QuestionController@show', ['question'=>$question->id]);
        }
        return redirect('question');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $answer = Answer::find($id);
        $question = $answer->question;
        if(Session::has('id') && (Session::get('id')==$answer->uploader->id)){
            $success = Answer::destroy($id);
            if ($success) {
                return redirect()->action('QuestionController@show', ['question'=>$question->id]);
            }
        }
        return redirect('question');
    }
    
    public function vote(Request $request){
        if (Session::has('id')) {
            $user = User::find(Session::get('id'));
            $question = Answer::find($request->id);
            if($request->value == -1){
                if ($user->reputation >= 15){
                    $clear = Answer::vote($user->id, $request->id, $request->value);
                    if(!($clear)){
                        User::add_reputation($question->uploader->id, -1);
                        $finalVote = Answer::count_votes($request->id);
                        return response()->json(array('msg'=> 'vote recorded', 'value'=>$finalVote));
                    }else
                        return response()->json(array('msg'=> 'you voted this', 'value'=>null));
                }else
                    return response()->json(array('msg'=> 'minimum requirement to downvote is 15 reputation', 'value'=>null));
            }else{
                $clear = Answer::vote($user->id, $request->id, $request->value);
                if(!($clear)){
                    User::add_reputation($question->uploader->id, 10);
                    $finalVote = Answer::count_votes($request->id);
                    return response()->json(array('msg'=> 'vote recorded', 'value'=>$finalVote));
                }else
                    return response()->json(array('msg'=> 'you voted this', 'value'=>null));
            }
        } else
            return response()->json(array('msg'=> null, 'value'=>null));
    }
}
