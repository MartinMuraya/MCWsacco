<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanGuarantor extends Model
{
    //

    public function loanApplication() { return $this->belongsTo(LoanApplication::class); }

    public function member() { return $this->belongsTo(Member::class, 'guarantor_member_id'); }

}
