<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HostelImage extends Model
{
    //

    public function hostel() { return $this->belongsTo(Hostel::class); }

}
