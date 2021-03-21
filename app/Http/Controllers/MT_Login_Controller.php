<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users as User_Model;

class MT_Login_Controller extends Controller
{
    private $login_errors = [];
    public function login_page(){
        $this->login_errors = [];
        return view('/Mini_Traum_Views/MT_Login');
    }

    //check for empty fields
    public function empty_fields($user_email,$user_password){
        if(empty($user_email) || empty($user_password)){
            return true;
        }
        return false;
    }
    //check if user credentials are correct(if wrong redirect to login)
    public function does_user_exists($user_email){
        $user_data = User_Model::where('user_email',$user_email);
        if($user_data->count() == 0){
            return false;
        }
        return true;
    }
    //check if password is correct
    public function correct_credentials($user_email,$user_password){
        $stored_password = User_Model::where('user_email',$user_email)->get(['user_password'])->first();
        if($stored_password->user_password == $user_password){
            return true;
        }
        return false;
    }

    public function make_session(Request $request){
        $loggedin_user_email = $request->input('Mini_Traum_Login_Email');
        $loggedin_user_password = $request->input('Mini_Traum_Login_Password');
        $request->session()->put('flashedEmail',$loggedin_user_email);
        if($this->empty_fields($loggedin_user_email,$loggedin_user_password)){
            if(empty($loggedin_user_email)){
                $this->login_errors['empty_email'] = true;
            }
            if(empty($loggedin_user_password)){
                $this->login_errors['empty_password'] = true;
            }
            return view('/Mini_Traum_Views/MT_Login',[
                'login_errors'=>$this->login_errors,
            ]);
        }
        if(!$this->does_user_exists($loggedin_user_email)){
            $this->login_errors['user_not_exists'] = true;
            return view('/Mini_Traum_Views/MT_Login',[
                'login_errors'=>$this->login_errors,
            ]);
        }
        if(!$this->correct_credentials($loggedin_user_email,$loggedin_user_password)){
            $this->login_errors['incorrect_credentials'] = true;
            return view('/Mini_Traum_Views/MT_Login',[
                'login_errors'=>$this->login_errors,
                $request,
            ]);
        }
        /*
         * Changed session_key from email to user_id
         */
        $loggedin_user_id = User_Model::where('user_email',$loggedin_user_email)->first()->id;
        $request->session()->put('session_key',$loggedin_user_id);
        $request->session()->forget('flashedEmail');
        $this->login_errors = [];
        return redirect('/dashboard');
    }
    public function logout(Request $request){
        $this->login_errors = [];
        if($request->session()->has('session_key')){
            $request->session()->forget('session_key');
            $request->session()->flush();
        }
        return redirect('/login');
    }
}
