<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //

    public function member() { return $this->belongsTo(Member::class); }

    public function account() { return $this->belongsTo(Account::class); }

    public function journalEntry() { return $this->belongsTo(JournalEntry::class); }

    public function recordedBy() { return $this->belongsTo(User::class, 'recorded_by'); }

}