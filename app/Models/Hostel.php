<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    protected $guarded = [];
    protected $casts = [
        'gallery' => 'array',
        'amenities' => 'array',
    ];
    public function rooms() { return $this->hasMany(Room::class); }

    public function images() { return $this->hasMany(HostelImage::class); }

}