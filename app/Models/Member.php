<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    //

    public function user() { return $this->belongsTo(User::class); }

    public function accounts() { return $this->hasMany(Account::class); }

    public function contributions() { return $this->hasMany(Contribution::class); }

    public function loanApplications() { return $this->hasMany(LoanApplication::class); }

    public function loans() { return $this->hasMany(Loan::class); }

    public function guarantees() { return $this->hasMany(LoanGuarantor::class, 'guarantor_member_id'); }

    public function shareCapitals() { return $this->hasMany(ShareCapital::class); }

    public function documents() { return $this->hasMany(MemberDocument::class); }

}