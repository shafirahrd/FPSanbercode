<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerComment extends Model
{
    //
    protected $table = 'answer_comments';
    protected $fillable = ['content','uploader_id', 'answer_id'];
    
    /** RELATIONSIHPS */
    public function uploader(){
        return $this->belongsTo('App\User', 'uploader_id');
    }
    public function answer(){
        return $this->belongsTo('App\Answer');
    }
}
