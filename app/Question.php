<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Question extends Model
{
    //
    protected $table = 'questions';
    protected $fillable = ['title', 'content', 'tags', 'uploader_id', 'best_answer_id'];

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
            'uploader_id' => $request->Session::get('user_id')
        ]);
    }
    public static function update(Request $request, $id)
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
        $record = QuestionVote::where('voter_id', $userid)
            ->where('question_id', $questionid)
            ->get();
        if ($record) {
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
        $question = Question::where('id', $id)->get()[0];
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
