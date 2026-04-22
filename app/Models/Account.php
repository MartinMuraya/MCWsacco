<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //

    public function member() { return $this->belongsTo(Member::class); }

    public function transactions() { return $this->hasMany(Transaction::class); }

    public function journalLines() { return $this->hasMany(JournalLine::class); }

}