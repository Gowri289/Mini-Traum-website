<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;
use App\Models\Users;
use App\Http\SearchHelper\UpdatedDetailsSearch;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
    ];
    public function guest()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    public function canBook(){
        return UpdatedDetailsSearch::getUpdatedSearchData($this->from_date,$this->to_date,$this->guest_count,$this->property_id);
    }

}
