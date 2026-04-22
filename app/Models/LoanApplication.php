<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanApplication extends Model
{
    //

    public function member() { return $this->belongsTo(Member::class); }

    public function loanProduct() { return $this->belongsTo(LoanProduct::class); }

    public function guarantors() { return $this->hasMany(LoanGuarantor::class); }

    public function loan() { return $this->hasOne(Loan::class); }

    public function reviewedBy() { return $this->belongsTo(User::class, 'reviewed_by'); }

    public function approvedBy() { return $this->belongsTo(User::class, 'approved_by'); }

}