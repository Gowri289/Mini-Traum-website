<?php

namespace App\Http\SearchHelper;

use App\Models\Property;
use App\Models\Users;
use App\Models\Booking;


class Search
{
    /**
     * @param $location {String}
     * @param $fromDate {Date}
     * @param $toDate {Date}
     * @param $guestCount {Integer}
     *
     * @return array [ with properties that are filtered out by input]
     */

    public static function getData($location, $fromDate, $toDate, $guestCount)
    {
        /*
        * Separating booked dates that clashes with from and to dates of guest
        */
        $bookingFromDate = $fromDate;
        $bookingToDate = $toDate;
        $bookedData = Booking::where('from_date', '>=', $bookingFromDate)->where('to_date', '<=', $bookingToDate)
            ->orWhere('from_date', '<', $bookingToDate)->where('to_date', '>=', $bookingToDate)
            ->orWhere('from_date', '<=', $bookingFromDate)->where('to_date', '>=', $bookingFromDate)
            ->where('status','=','accept')->get(['id','property_id', 'guest_count'])->toArray();

        /*
         * $bookedProperties store the property_id and cumulative guest count of that particular property
         */
        $bookedProperties = [];
        $index = 0;

        /*
        * key = property_id
        * value = guest_count
        */
        foreach ($bookedData as $key => $data) {
            if (!array_key_exists($data['property_id'], $bookedProperties)) {
                $bookedProperties[$data['property_id']] = 0;
            }
            /*
             * Add guest count if status of the request is 'accept'
             */
            if(Booking::where('id','=',$data['id'])->get('status')->first()->status == 'accept'){
                $bookedProperties[$data['property_id']] += $data['guest_count'];
            }
            $index++;
        }

        $searchLocation = $location;
        $searchGuestCount = $guestCount;

        /**
         * @param lessVacantProperties store properties whose guest vacancy is less than guest count
         */

        $lessVacantProperties = [];
        $index = 0;
        foreach ($bookedProperties as $key => $value) {
            $totalCount = Property::where('id', $key)->get(['max_guests'])->first();
            $remainingVacancy = $totalCount->max_guests - $value;
            if ($remainingVacancy < $searchGuestCount) {
                $lessVacantProperties[$index] = $key;
                $index++;
            }
        }
        /*
         * $vacantProperties is required data to be displayed after matching location,guest_count and from,to dates
         */
        $vacantProperties = Property::whereNotIn('id', $lessVacantProperties)
            #case: if search count > max_guests
            ->where('max_guests', '>=', $searchGuestCount)
            ->where('location', 'like', '%' . $searchLocation . '%')
            ->where('publish_status',true)->get();

        /*
         * $resultData stores the data in format which contains vacant status that is to be sent ot view.blade
         */
        $resultData = [];
        $index = 0;

        foreach ($vacantProperties as $data) {
            $property_id = $data->id;
            $resultData[$index]['property_id'] = $property_id;
            $resultData[$index]['name'] = $data->name;
            $resultData[$index]['location'] = $data->location;
            $resultData[$index]['max_guests'] = $data->max_guests;
            if (key_exists($property_id, $bookedProperties)) {
                $resultData[$index]['vacancy'] = $data->max_guests - $bookedProperties[$data->id];
            } else {
                $resultData[$index]['vacancy'] = $data->max_guests;
            }
            $index++;
        }

        # $resultData is sent to Guest Dashboard view

        return $resultData;

    }
}

