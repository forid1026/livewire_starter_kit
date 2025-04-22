<?php

namespace App\Livewire\PayrollPayment;

use App\Models\Payroll;
use App\Models\PayrollPayment;
use Illuminate\Support\Facades\DB;
use Flux\Flux;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $payrollPaymentId, $payment_date, $amount, $voucher;
    public function render()
    {
        return view('livewire.payroll-payment.edit');
    }

    #[On('editPayrollPayment')]
    public function editPayrollPayment($id)
    {
        $this->payrollPaymentId = $id;
        $payrollPayment = PayrollPayment::findOrFail($id);

        $this->payment_date = $payrollPayment->payment_date;
        $this->amount = $payrollPayment->amount;
        $this->voucher = $payrollPayment->voucher;
        Flux::modal('edit-payment')->show();
    }

    protected $rules = [
        'payment_date' => 'required',
        'amount' => 'required',
    ];

    public function updatePayment()
    {   
        $this->validate();
        DB::beginTransaction();
        try {
            $payrollPayment = PayrollPayment::findOrFail($this->payrollPaymentId);
            $payroll = Payroll::find($payrollPayment->payroll_id);
            if ($payroll) {
                $payroll->due_salary += $payrollPayment->amount;
                switch (true) {
                    case $payroll->due_salary == 0:
                        $payroll->status = 'Paid';
                        break;
                    case $payroll->due_salary == $payroll->net_salary:
                        $payroll->status = 'Unpaid';
                        break;
                    default:
                        $payroll->status = 'Partial';
                }
                $payroll->save();
            }



            $payrollPayment->payment_date = $this->payment_date;
            $payrollPayment->amount = $this->amount;
            $payrollPayment->voucher = $this->voucher;
            $payrollPayment->save();

            $payroll->due_salary -= $this->amount;
            $payroll->save();

            DB::commit();

            Flux::modal('edit-payment')->close();
            $this->dispatch('refreshPaymentManager');
            $this->reset();
            Flux::toast('Payroll Payment updated successfully.');
            session()->flash('success', 'Payroll Payment updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error updating Payroll Payment: {$e->getMessage()}");
            Flux::toast($e->getMessage(), 'error');
            return;
        }
    }
}
