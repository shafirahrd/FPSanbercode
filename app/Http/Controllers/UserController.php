<?php

namespace App\Http\Controllers;

use App\ModelUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(){
        if(!Session::get('login')){
            return redirect('login')->with('alert','Please log in or register first');
        }
        else{
            return redirect('/question');
        }
    }

    public function login(){
        return view('auth.login');
    }

    public function loginPost(Request $request){

        $email = $request->email;
        $password = $request->password;

        $data = User::where('email',$email)->get();
        if($data){ //apakah email tersebut ada atau tidak
            $data = $data[0];
            if(Hash::check($password,$data->password)){
                Session::put('id',$data->id);
                Session::put('name',$data->name);
                Session::put('email',$data->email);
                Session::put('login',TRUE);
                return redirect('/question');
            }
            else{
                return redirect('login')->with('alert','Invalid email or password!');
            }
        }
        else{
            return redirect('login')->with('alert','Invalid email or password!');
        }
    }

    public function logout(){
        Session::flush();
        return redirect('login')->with('alert','Log out Succes');
    }

    public function register(Request $request){
        return view('auth.register');
    }

    public function registerPost(Request $request){
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|min:4|email|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        User::insert($request);
        return redirect('login')->with('alert-success','Register succes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
