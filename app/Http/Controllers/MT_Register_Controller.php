<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB_Connect;
use App\Models\Users as User_Model;

class MT_Register_Controller extends Controller
{
    //array to store all reg_errors
    private array $reg_errors = array();
    public function register(){
        /*
         * Calling Register Page
         */
        $this->reg_errors = array();
        return view('/Mini_Traum_Views/MT_Register',$this->reg_errors);
    }
    /*
     * Function to check if the user is already present in the database
     */
    public function already_an_user($user_email){
        $user_data = User_Model::where('user_email',$user_email);
        if($user_data->count() != 0){
            return true;
        }
        return false;
    }
    public function password_confirmation($password,$confirm_password){
        $password = trim($password);
        //Removing spaces
        $confirm_password = trim($confirm_password);
        if($password !== $confirm_password){
            return true;
        }
        return false;
    }
    public function empty_fields($input_data){
        foreach ($input_data as $key => $value){
            if(empty($value)){
                return true;
            }
        }
        return false;
    }
    public function register_user(Request $request){
        /*
         * Inserting users based on their type
         */
        #Chcking for form reg_errors
        $guest_data = [
            'user_name'=> $request->input('Mini_Traum_Register_Name'),
            'user_email'=> $request->input('Mini_Traum_Register_Email'),
            'user_password'=>$request->input('Mini_Traum_Register_Password'),
            'user_confirm_password'=>$request->input('Mini_Traum_Register_ConfirmPassword'),
            'user_type'=> $request->input('Mini_Traum_User_Type'),
        ];
        $request->session()->put(['flashedEmail' => $guest_data['user_email'],'flashedUserName'=>$guest_data['user_name']]);
        if($this->empty_fields($guest_data)){
            if(empty($guest_data['user_name'])){
                $this->reg_errors['empty_name'] = true;
            }
            if(empty($guest_data['user_email'])){
                $this->reg_errors['empty_email'] = true;
            }
            if(empty($guest_data['user_password'])){
                $this->reg_errors['empty_password'] = true;
            }
            if(empty($guest_data['user_confirm_password'])){
                $this->reg_errors['empty_confirm_password'] = true;
            }
            return view('/Mini_Traum_Views/MT_Register', [
                'reg_errors'=>$this->reg_errors,
            ]);
        }
        if($this->password_confirmation($guest_data['user_password'],$guest_data['user_confirm_password'])){
            $this->reg_errors['password_not_match'] = true;
            return view('/Mini_Traum_Views/MT_Register', [
                'reg_errors'=>$this->reg_errors,
            ]);
        }
        if($this->already_an_user($guest_data['user_email'])){
            $this->reg_errors['user_exists'] = true;
            return view('/Mini_Traum_Views/MT_Register', [
                'reg_errors'=>$this->reg_errors,
            ]);
        }

        $user_model = new User_Model();
        $user_model->user_name = $guest_data['user_name'];
        $user_model->user_email = $guest_data['user_email'];
        $user_model->user_password = $guest_data['user_password'];
        $user_model->user_type = $guest_data['user_type'];
        $user_model->save();
        $this->reg_errors = [];
        $request->session()->forget('flashedUserName');
        return redirect('/login');
    }

}
