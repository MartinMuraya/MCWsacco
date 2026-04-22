<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberDocument extends Model
{
    //

    public function member() { return $this->belongsTo(Member::class); }

    public function uploadedBy() { return $this->belongsTo(User::class, 'uploaded_by'); }

}