<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionVote extends Model
{
    //
    protected $table = 'question_votes';
    protected $fillable = ['value','voter_id', 'question_id'];
    
    /** RELATIONSIHPS */
    public function voter(){
        return $this->belongsTo('App\User', 'voter_id');
    }
    public function question(){
        return $this->belongsTo('App\Question');
    }
}
