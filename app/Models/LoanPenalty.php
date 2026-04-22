<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanPenalty extends Model
{
    //

    public function loan() { return $this->belongsTo(Loan::class); }

    public function schedule() { return $this->belongsTo(LoanRepaymentSchedule::class, 'repayment_schedule_id'); }

    public function waivedBy() { return $this->belongsTo(User::class, 'waived_by'); }

}