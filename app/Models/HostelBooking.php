<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HostelBooking extends Model
{
    //

    public function room() { return $this->belongsTo(Room::class); }

    public function confirmedBy() { return $this->belongsTo(User::class, 'confirmed_by'); }

}
