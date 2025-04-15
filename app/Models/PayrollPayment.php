<?php

namespace App\Models;
use App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;

class PayrollPayment extends Model
{
    protected $guarded = [];

    public function payroll()
    {
        return $this->belongsTo(Payroll::class);
    }
}
