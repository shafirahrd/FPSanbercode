<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;

class QuestionComment extends Model
{
    //
    protected $table = 'question_comments';
    protected $fillable = ['content', 'uploader_id', 'question_id'];

    public static function insert(Request $request, $id)
    {
        QuestionComment::create([
            'question_id' => $id,
            'uploader_id' => Session::get('id'),
            'content' => $request->content

        ]);
    }

    /** RELATIONSIHPS */
    public function uploader()
    {
        return $this->belongsTo('App\User', 'uploader_id');
    }
    public function question()
    {
        return $this->belongsTo('App\Question');
    }
}
