<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    protected $casts = [
        'gallery' => 'array',
    ];
    public function rooms() { return $this->hasMany(Room::class); }

    public function images() { return $this->hasMany(HostelImage::class); }

}