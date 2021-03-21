<?php

namespace App\Http\SearchHelper;

use App\Models\Property;
use App\Models\Users;
use App\Models\Booking;

class UpdatedDetailsSearch
{
    /**
     * @param $fromDate {Date}
     * @param $toDate {Date}
     * @param $searchedGuestCount {Integer}
     * @param $propertyId {Integer}
     * @return boolean
     */
    public static function getUpdatedSearchData($fromDate, $toDate, $searchedGuestsCount, $propertyId): bool
    {
        /*
         * Searches for any booking history of the property(with property_id = $propertyId)
         * If found add all the guests count of the clashed dates
         * If max_guests - cumulative guest count is greater than $searchedGuestCount then booking can be accepted
         */
        $bookingFromDate = $fromDate;
        $bookingToDate = $toDate;
        /**
         * $bookedData stores booked properties that clashes with current from and to date
         */
        $bookedData = Booking::where('from_date', '>=', $bookingFromDate)->where('to_date', '<=', $bookingToDate)
            ->orWhere('from_date', '<', $bookingToDate)->where('to_date', '>=', $bookingToDate)
            ->orWhere('from_date', '<=', $bookingFromDate)->where('to_date', '>=', $bookingFromDate)
            ->where('property_id', '=', $propertyId)->where('status', '=', 'accept')
            ->get()->toArray();

        /**
         * $totalGuestCount stores maximum available vacancy of a property
         */
        $totalGuestCount = Property::where('id', '=', $propertyId)->get(['max_guests'])->first();
        /**
         * $bookedGuestsCount is the cumulative guest count that were accepted by owners and clashes with current from and to date
         */
        $bookedGuestsCount = 0;
        if (empty($bookedData)) {
            $bookedGuestsCount = 0;
        } else {
            foreach ($bookedData as $key => $data) {
                /*
                 * Bug fix here (prev: it was checking all clashed properties, current: it only checks certain property)
                 */
                if($data['property_id'] == $propertyId && $data['status'] == 'accept'){
                    $bookedGuestsCount += $data['guest_count'];
                }
            }
        }
        return $totalGuestCount->max_guests - $bookedGuestsCount >= $searchedGuestsCount;
    }
}

