<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    //

    public function lines() { return $this->hasMany(JournalLine::class); }

    public function transactions() { return $this->hasMany(Transaction::class); }

    public function contributions() { return $this->hasMany(Contribution::class); }

    public function loanRepayments() { return $this->hasMany(LoanRepayment::class); }

    public function postedBy() { return $this->belongsTo(User::class, 'posted_by'); }

    public function reversedBy() { return $this->belongsTo(User::class, 'reversed_by'); }

}