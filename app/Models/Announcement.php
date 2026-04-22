<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    //

    public function publishedBy() { return $this->belongsTo(User::class, 'published_by'); }

}