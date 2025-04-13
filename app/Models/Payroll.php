<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $guarded = [];
    // Payroll.php
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function allowances()
    {
        return $this->hasMany(Allowance::class);
    }

    public function deductions()
    {
        return $this->hasMany(Deduction::class);
    }
}
