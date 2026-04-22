<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    //

    public function createdBy() { return $this->belongsTo(User::class, 'created_by'); }

}