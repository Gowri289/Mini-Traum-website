<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users as User_Model;
use App\Http\Controllers\MT_Booking_Controller;
use App\Http\Controllers\MT_Property_Controller;
class MT_Dashboard_Controller extends Controller
{
    /*
     * Checks user type and displays view according to it
     */
    public function landingPage(){
        return redirect('/dashboard');
    }
    public function show_dashboard(Request $request){
        $loggedin_user_id = $request->session()->get('session_key');
        $loggedin_user_type = User_Model::where('id',$loggedin_user_id)->first()->user_type;

        if($loggedin_user_type == "guest"){
            $booking = new MT_Booking_Controller();
            return $booking->guest_dashboard($loggedin_user_id);
        }
            $property = new MT_Property_Controller();
            return $property->owner_dashboard($loggedin_user_id);

    }
}
