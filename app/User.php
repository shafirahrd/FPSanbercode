<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
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
        'name', 'email', 'password',
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

    /**
     * Function to add user reputation. first parameter
     * is the user id, the seccond is the increment or
     * decrement value
     * 
     * @return void
     */
    public static function add_reputation($id, $value){
        $user = User::where('id', $id);
        $current_reputation = $user->reputation;
        $user->update([
            'reputation'=>($current_reputation + $value)
        ]);
    }

    /** RELATIONSIHPS */
    public function questions(){
        return $this->hasMany('App\Question');
    }
    public function answers(){
        return $this->hasMany('App\Answer');
    }
    public function questionComments(){
        return $this->hasMany('App\QuestionComment');
    }
    public function answerComments(){
        return $this->hasMany('App\AnswerComment');
    }
    public function questionVotes(){
        return $this->hasMany('App\QuestionVote');
    }
    public function answerVotes(){
        return $this->hasMany('App\AnswerVote');
    }
}
