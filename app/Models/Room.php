<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //

    public function hostel() { return $this->belongsTo(Hostel::class); }

    public function bookings() { return $this->hasMany(HostelBooking::class); }

    public function waitlists() { return $this->hasMany(HostelWaitlist::class); }

    public function images() { return $this->hasMany(RoomImage::class); }

}