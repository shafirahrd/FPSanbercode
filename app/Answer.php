<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Answer extends Model
{
    //
    protected $table = 'answers';
    protected $fillable = ['content', 'uploader_id', 'question_id'];

    /**
     * Function to get the number of votes
     * an answer has
     * 
     * @return int
     */
    public static function count_votes($id)
    {
        $answer = Answer::where('id', $id)->get()[0];
        $votes = 0;
        foreach ($answer->votes as $vote) {
            $votes += $vote->value;
        }
        return $votes;
    }
    public static function insert(Request $request)
    {
        Answer::create([
            'content' => $request->content,
            'uploader_id' => $request->Session::get('user_id'),
            'question_id' => $request->question_id
        ]);
    }
    public static function update(Request $request, $id)
    {

        Answer::where('id', $id)
            ->update([
                'title' => $request['title'],
                'content' => $request['content'],
                'tags' => $request['tags']
            ]);
    }

    /**
     * Function to vote the answer
     * 
     * @return void
     */
    public static function vote($userid, $answerid, $value)
    {
        $record = AnswerVote::where('voter_id', $userid)
            ->where('answer_id', $answerid)
            ->get();
        if ($record) {
            $record[0]->update([
                'value' => $value
            ]);
        } else {
            AnswerVote::create([
                'voter_id' => $userid,
                'answer_id' => $answerid,
                'value' => $value
            ]);
        }
    }

    /** RELATIONSIHPS */
    public function uploader()
    {
        return $this->belongsTo('App\User', 'uploader_id');
    }
    public function question()
    {
        return $this->belongsTo('App\Question', 'question_id');
    }
    public function _question()
    {
        return $this->hasOne('App\Question', 'best_answer_id');
    }
    public function comments()
    {
        return $this->hasMany('App\AnswerComment');
    }
    public function votes()
    {
        return $this->hasMany('App\AnswerVote');
    }
}
