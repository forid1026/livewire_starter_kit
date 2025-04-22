<?php

namespace App\Livewire;

use App\Models\PayrollPayment;
use Flux\Flux;
use App\Models\Payroll;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PayrollPaymentManager extends Component
{
    public $payrollPaymentId;
    #[On('refreshPaymentManager')]
    public function render()
    {
        return view(
            'livewire.payroll-payment-manager',
            [
                'payrollPayments' => PayrollPayment::latest()->paginate(5)
            ]
        );
    }
    public function edit($id)
    {
        $this->dispatch('editPayrollPayment', $id);
    }

    public function delete($id)
    {
        $this->payrollPaymentId = $id;
        Flux::modal('delete-payment')->show();
    }

    public function deletePayment()
    {
        DB::beginTransaction();
        try {
            $payrollPayment = PayrollPayment::findOrFail($this->payrollPaymentId);
            $payroll = Payroll::find($payrollPayment->payroll_id);
            $payroll->due_salary += $payrollPayment->amount;
            if ($payroll->due_salary == 0) {
                $payroll->status = 'Paid';
            } elseif ($payroll->due_salary == $payroll->net_salary) {
                $payroll->status = 'Unpaid';
            } else {
                $payroll->status = 'Partial';
            }
            $payroll->save();
            $payrollPayment->delete();
            $this->dispatch('refreshPaymentManager');
            Flux::modal('delete-payment')->close();
            Flux::toast('Payment deleted successfully.');
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error("Error updating Payroll Payment: {$e->getMessage()}");
            Flux::toast($e->getMessage(), 'error');
            return;
        }
    }
}
