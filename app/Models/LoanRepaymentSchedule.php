<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanRepaymentSchedule extends Model
{
    //

    public function loan() { return $this->belongsTo(Loan::class); }

    public function repayments() { return $this->hasMany(LoanRepayment::class, 'repayment_schedule_id'); }

    public function penalties() { return $this->hasMany(LoanPenalty::class, 'repayment_schedule_id'); }

}
