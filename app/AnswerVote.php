<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerVote extends Model
{
    //
    protected $table = 'answer_votes';
    protected $fillable = ['value','voter_id', 'answer_id'];
    
    /** RELATIONSIHPS */
    public function voter(){
        return $this->belongsTo('App\User', 'voter_id');
    }
    public function answer(){
        return $this->belongsTo('App\Answer');
    }
}

