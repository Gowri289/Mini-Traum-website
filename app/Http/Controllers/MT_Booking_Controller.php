<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users as User_Model;
use App\Models\Booking;
use App\Models\Property;
use App\Http\SearchHelper\Search;
use App\Http\SearchHelper\UpdatedDetailsSearch;

class MT_Booking_Controller extends Controller
{
    public function guest_dashboard($user_id)
    {

        #passing user data into dashboard view
        # all properties are displayed in guest dashboards
        $user_data = User_Model::where('id', $user_id)->first();
        $property_data = Property::where('publish_status',true)->get();
        return view('Mini_Traum_Views.MT_Guest_Dashboard', [
            'properties' => $property_data,
            'guest' => $user_data,
        ]);
    }

    public function showPropertiesByLocation(Request $request)
    {
        /*
         * If user does not enter any field or if from date is greater than to date , request should not processed
         */
        if(empty($request->location) || empty($request->fromDate) || empty($request->toDate) || empty($request->guestCount)){
            return redirect('/dashboard');
        }
        elseif( !empty($request->fromDate) && !empty($request->toDate) && ($request->fromDate > $request->toDate)){
            return redirect('/dashboard');
        }
        $properties = Search::getData($request->location, $request->fromDate, $request->toDate, $request->guestCount);
        return view('Mini_Traum_Views.MT_Guest_SearchedProperties', compact('properties', 'request'));
    }


    public function propertyDetails(Request $request)
    {
        /*
         * Made an array and passed the data into it
         */

        $property = Property::where('id', $request->id)->first();
        return view('Mini_Traum_Views.MT_Guest_PropertyDetails', compact('request', 'property'));
    }

    public function store(Request $request, $id)
    {
        if(UpdatedDetailsSearch::getUpdatedSearchData($request->fromDate,$request->toDate,$request->guestCount,$id)) {
            //logic for storing the data in database
            $booking = new Booking();
            $booking->user_id = $request->session()->get('session_key');
            $booking->from_date = $request->fromDate;
            $booking->property_id = $id;
            $booking->to_date = $request->toDate;
            $booking->guest_count = $request->guestCount;
            $booking->save();
            return view('Mini_Traum_Views.MT_Guest_Success_Message');
        }
        return view('Mini_Traum_Views.MT_Guest_Error_Message');


    }

    public function showPastBookings(Request $request)
    {
        $id = $request->session()->get('session_key');
        $todayDate = date("Y-m-d");
        $bookings = Booking::where('user_id', '=', $id)
            ->where('to_date', '<', $todayDate)
            ->where('status', 'accept')->get();
        return view('Mini_Traum_Views.MT_Guest_PastBookings', compact('bookings'));
    }

    public function upComingBookings(Request $request)
    {
        $id = $request->session()->get('session_key');
        $todayDate = date("Y-m-d");
        $bookings = Booking::where('user_id', '=', $id)
            ->where('to_date', '>=', $todayDate)->get();
        return view('Mini_Traum_Views.MT_Guest_FutureBookings', compact('bookings'));
    }

    public function edit(Request $request, $id)
    {

        $bookings = Booking::where('id', $id)->first();
        return view('Mini_Traum_Views.MT_Guest_Booking_Edit', compact('bookings'));

    }

    public function update(Request $request, $id)
    {
        $propertyId = Booking::where('id',$id)->get('property_id')->first()->property_id;
        if(UpdatedDetailsSearch::getUpdatedSearchData($request->fromDate,$request->toDate,$request->guestCount,$propertyId)) {
            Booking::where('id', $id)->update([
                'from_date' => $request->fromDate,
                'to_date' => $request->toDate,
                'guest_count' => $request->guestCount
            ]);
            return redirect('/upComingBookings');
        }
        return view('Mini_Traum_Views.MT_Guest_Error_Message');
    }

    public function cancel(Request $request, $id)
    {
        Booking::where('id', $id)->delete();
        return redirect('/upComingBookings');
    }


}
