<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*    public function index(){
    	return view('question.index');
    }

    public function login(){
    	return view('auth.login');
    }
    
    public function register(){
    	return view('auth.register');
    }

    public function createquestion(){
    	return view('question.form');
    }

    public function indexanswer(){
    	return view('answer.index');
    }

    public function editquestion(){
    	return view('question.form_edit');
    }

     */
}
