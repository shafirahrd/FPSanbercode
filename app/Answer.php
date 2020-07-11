<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    //
    protected $table = 'answers';
    protected $fillable = ['content', 'uploader_id', 'question_id'];
    use SoftDeletes;

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
    public static function insert(Request $request, $id)
    {
        Answer::create([
            'content' => $request->content,
            'uploader_id' => Session::get('id'),
            'question_id' => $id
        ]);
    }
    public static function update_(Request $request, $id)
    {
        Answer::where('id', $id)
            ->update([
                'content' => $request['content'],
            ]);
    }

    /**
     * Function to vote the answer
     * 
     * @return void
     */
    public static function vote($userid, $answerid, $value)
    {
        $test = AnswerVote::where('voter_id', $userid)
            ->where('answer_id', $answerid)
            ->where('value', $value)
            ->get();
        if(count($test)>0)
            return true;
        $record = AnswerVote::where('voter_id', $userid)
            ->where('answer_id', $answerid)
            ->get();
        if (count($record)>0) {
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
