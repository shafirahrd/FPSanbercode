<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class AnswerComment extends Model
{
    //
    protected $table = 'answer_comments';
    protected $fillable = ['content','uploader_id', 'answer_id'];
    
    public static function insert(Request $request, $id)
    {
        return AnswerComment::create([
            'answer_id' => $id,
            'uploader_id' => Session::get('id'),
            'content' => $request->content
        ]);
    }
    /** RELATIONSIHPS */
    public function uploader(){
        return $this->belongsTo('App\User', 'uploader_id');
    }
    public function answer(){
        return $this->belongsTo('App\Answer');
    }
}
