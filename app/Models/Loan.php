<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    //

    public function application() { return $this->belongsTo(LoanApplication::class, 'loan_application_id'); }

    public function member() { return $this->belongsTo(Member::class); }

    public function loanProduct() { return $this->belongsTo(LoanProduct::class); }

    public function repaymentSchedules() { return $this->hasMany(LoanRepaymentSchedule::class); }

    public function repayments() { return $this->hasMany(LoanRepayment::class); }

    public function penalties() { return $this->hasMany(LoanPenalty::class); }

    public function account() { return $this->belongsTo(Account::class); }

    public function disbursedBy() { return $this->belongsTo(User::class, 'disbursed_by'); }

}
