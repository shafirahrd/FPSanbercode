<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionComment extends Model
{
    //
    protected $table = 'question_comments';
    protected $fillable = ['content','uploader_id', 'question_id'];

    /** RELATIONSIHPS */
    public function uploader(){
        return $this->belongsTo('App\User', 'uploader_id');
    }
    public function question(){
        return $this->belongsTo('App\Question');
    }
}
