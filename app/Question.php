<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    //
    protected $table = 'questions';
    protected $fillable = ['title', 'content', 'tags', 'uploader_id', 'best_answer_id'];
    protected $appends = ['votes'];
    use SoftDeletes;

    public static function get_newest(){
        return Question::select('*')->orderBy('created_at', 'desc')->get();
    }
    public static function get_top_voted(){
        $questions = Question::all();
        foreach ($questions as $question) {
            $question->votes = Question::count_votes($question->id);
        }
        return $questions->sortBy('votes', SORT_REGULAR,true);
    }
    /**
     * Function to add new question
     * 
     * @return void
     */
    public static function insert(Request $request)
    {
        Question::create([
            'title' => $request->title,
            'content' => $request->content,
            'tags' => $request->tags,
            'uploader_id' => Session::get('id')
        ]);
    }
    public static function update_(Request $request, $id)
    {
        Question::where('id', $id)
            ->update([
                'title' => $request['title'],
                'content' => $request['content'],
                'tags' => $request['tags']
            ]);
    }

    /**
     * Function to vote the question
     * 
     * @return void
     */
    public static function vote($userid, $questionid, $value)
    {
        $test = QuestionVote::where('voter_id', $userid)
            ->where('question_id', $questionid)
            ->where('value', $value)
            ->get();
        if(count($test)>0)
            return true;
        $record = QuestionVote::where('voter_id', $userid)
            ->where('question_id', $questionid)
            ->get();
        if (count($record)>0) {
            $record[0]->update([
                'value' => $value
            ]);
        } else {
            QuestionVote::create([
                'voter_id' => $userid,
                'question_id' => $questionid,
                'value' => $value
            ]);
        }
    }

    /**
     * Function to get the number of votes
     * a question has
     * 
     * @return int
     */
    public static function count_votes($id)
    {
        $question = Question::find($id);
        $votes = 0;
        foreach ($question->votes as $vote) {
            $votes += $vote->value;
        }
        return $votes;
    }

    /**
     * Function to set the best answer of a question.
     * first parameter is the question id, the second
     * one is the answer id meant to be the best answer
     * 
     * @return void
     */
    public static function set_best_answer($questionid, $answerid)
    {
        Question::where('id', $questionid)->update([
            'best_answer_id' => ($answerid)
        ]);
    }

    /** RELATIONSIHPS */
    public function uploader()
    {
        return $this->belongsTo('App\User', 'uploader_id');
    }
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
    public function best_answer()
    {
        return $this->belongsTo('App\Answer', 'best_answer_id');
    }
    public function comments()
    {
        return $this->hasMany('App\QuestionComment');
    }
    public function votes()
    {
        return $this->hasMany('App\QuestionVote');
    }
}
