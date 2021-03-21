<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;
use App\Models\Booking;

class Users extends Model
{

    use HasFactory;
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function bookings()
    {
        if($this->user_type == 'guest'){
            return $this->hasMany(Booking::class);
        }
    }
}
