<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanRepayment extends Model
{
    //

    public function loan() { return $this->belongsTo(Loan::class); }

    public function schedule() { return $this->belongsTo(LoanRepaymentSchedule::class, 'repayment_schedule_id'); }

    public function journalEntry() { return $this->belongsTo(JournalEntry::class); }

    public function recordedBy() { return $this->belongsTo(User::class, 'recorded_by'); }

}