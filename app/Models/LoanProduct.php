<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanProduct extends Model
{
    //

    public function applications() { return $this->hasMany(LoanApplication::class); }

    public function loans() { return $this->hasMany(Loan::class); }

}
