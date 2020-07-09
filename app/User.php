<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'reputation',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function AuthRouteAPI(Request $request){
        return $request->user();
     }

    /**
     * Function to add user reputation. first parameter
     * is the user id, the seccond is the increment or
     * decrement value
     * 
     * @return void
     */
    public static function add_reputation($id, $value){
        $user = User::where('id', $id)->get();
        if($user) $user = $user[0];
        $current_reputation = $user->reputation;
        $final_value = $current_reputation + $value;
        $user->update([
            'reputation'=> $final_value
        ]);
    }

    /** RELATIONSIHPS */
    public function questions(){
        return $this->hasMany('App\Question', 'uploader_id');
    }
    public function answers(){
        return $this->hasMany('App\Answer', 'uploader_id');
    }
    public function questionComments(){
        return $this->hasMany('App\QuestionComment', 'uploader_id');
    }
    public function answerComments(){
        return $this->hasMany('App\AnswerComment', 'uploader_id');
    }
    public function questionVotes(){
        return $this->hasMany('App\QuestionVote', 'voter_id');
    }
    public function answerVotes(){
        return $this->hasMany('App\AnswerVote', 'voter_id');
    }
}
