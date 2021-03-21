<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Users;

class MT_Property_Controller extends Controller
{

    private $loggedIn_UserID;

    public function owner_dashboard($user_id)
    {
        $this->loggedIn_UserID = $user_id;

        $property_data = Property::where('user_id', $this->loggedIn_UserID)->get();
        $owner_data = Users::where('id', $user_id)->first();
        return view('Mini_Traum_Views.MT_Property_Dashboard', [
            'properties' => $property_data,
            'owner_name' => $owner_data->user_name,
            'owner_email' => $owner_data->user_email,
        ]);
    }

    public function create()
    {
        echo $this->loggedIn_UserID;
        return view('Mini_Traum_Views.MT_Property_Create');
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Property::where('user_id', $this->loggedIn_UserID)->count() >= 3) {
            return redirect('/dashboard');
        }

        $property = Property::create([
            'user_id' => $request->session()->get('session_key'),
            'name' => $request->name,
            'location' => $request->location,
            'max_guests' => $request->max_guests,
        ]);
        $property->save();

        return redirect('/dashboard');
    }


    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Property $property)
    {
        /**
         * If requests can't be processed then the request is rejected automatically
         */
        foreach ($property->bookings as $booking) {
            if (!$booking->canBook() && $booking->status == 'pending') {
                $booking->update(['status' => 'reject']);
            }
        }

        if ($property->user->id == $request->session()->get('session_key')) {
            return view('Mini_Traum_Views.MT_Property_Edit', ['property' => $property,]);
        }
        return redirect('/dashboard');
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {

        $property->update([
            'user_id' => $request->session()->get('session_key'),
            'name' => $request->name,
            'location' => $request->location,
            'max_guests' => $request->max_guests,
        ]);
        return redirect('/dashboard');
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return redirect('/dashboard');
    }

    public function publish(Property $property)
    {
        $property->update([
            'publish_status' => !($property->publish_status)
        ]);
        return redirect('/dashboard');
    }

    public function change_status(Request $request, Booking $booking)
    {
        switch ($request->input('action')):
            case 'accept':
                $booking->update(['status' => 'accept']);
                break;
            case 'reject':
                $booking->update(['status' => 'reject']);
                break;
        endswitch;

        /*
         * Added redirecting to edit page
         */
        $property = Property::where('id', '=', $booking->property_id)->first();
        return redirect()->route('properties.edit', $property);
    }

    public function bookingHistory(Request $request)
    {
        $properties = Property::where('user_id', $request->session()->get('session_key'))->get();
        $bookings = array();
        foreach ($properties as $property) {
            $bookings = array_merge($bookings, $property->pastBookings->all());
        }
        return view('Mini_Traum_Views.MT_Property_BookingHistory', ['bookings' => $bookings]);
    }
}
