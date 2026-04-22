<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    //

    public function member() { return $this->belongsTo(Member::class); }

    public function journalEntry() { return $this->belongsTo(JournalEntry::class); }

    public function recordedBy() { return $this->belongsTo(User::class, 'recorded_by'); }

}