<?php

namespace App\Livewire;

use App\Models\PayrollPayment;
use Livewire\Component;

class PayrollPaymentManager extends Component
{
    public function render()
    {
        return view(
            'livewire.payroll-payment-manager',
            [
                'payrollPayments' => PayrollPayment::latest()->paginate(5)
            ]
        );
    }
}
