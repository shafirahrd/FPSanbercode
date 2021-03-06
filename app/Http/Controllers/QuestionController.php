<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        return view('question.index', ['questions' => $questions]);
    }
    public function sortedIndex($param)
    {
        if($param == 'fresh'){
            $questions = Question::get_newest();
        }elseif ($param == 'trending') {
            $questions = Question::get_top_voted();
        }
        return view('question.index', ['questions' => $questions]);
    }
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
    public function store(Request $request)
    {
        Question::insert($request);
        return redirect()->action('QuestionController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        return view('question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        if (Session::has('id') && (Session::get('id') == $question->uploader->id)) //make sure the one editing is the one creating
            return view('question.form_edit', compact('question'));
        else
            return redirect('question');
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
        $question = Question::find($id);
        if (Session::has('id') && (Session::get('id') == $question->uploader->id)) {
            Question::update_($request, $id);
            return redirect()->action('QuestionController@show', ['question' => $id]);
        } else
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
        $question = Question::find($id);
        if (Session::has('id') && (Session::get('id') == $question->uploader->id)) {
            $question = Question::destroy($id);
            if ($question) {
                return redirect('question');
            }
        } else
            return redirect('question');
    }

    public function vote(Request $request){
        if (Session::has('id')) {
            $user = User::find(Session::get('id'));
            $question = Question::find($request->id);
            if($request->value == -1){
                if ($user->reputation >= 15){
                    $clear = Question::vote($user->id, $request->id, $request->value);
                    if(!($clear)){
                        User::add_reputation($question->uploader->id, -1);
                        $finalVote = Question::count_votes($request->id);
                        return response()->json(array('msg'=> 'vote recorded', 'value'=>$finalVote));
                    }else
                        return response()->json(array('msg'=> 'you voted this', 'value'=>null));
                }else
                    return response()->json(array('msg'=> 'minimum requirement to downvote is 15 reputation', 'value'=>null));
            }else{
                $clear = Question::vote($user->id, $request->id, $request->value);
                if(!($clear)){
                    User::add_reputation($question->uploader->id, 10);
                    $finalVote = Question::count_votes($request->id);
                    return response()->json(array('msg'=> 'vote recorded', 'value'=>$finalVote));
                }else
                    return response()->json(array('msg'=> 'you voted this', 'value'=>null));
            }
        } else
            return response()->json(array('msg'=> null, 'value'=>null));
    }

    public function bestAnswer($questionid, $answerid){
        Question::set_best_answer($questionid, $answerid);
        $answer = Answer::find($answerid);
        User::add_reputation($answer->uploader->id, 15);
        return redirect()->action('QuestionController@show', ['question' => $questionid]);
    }
}
