<?php

namespace App\Livewire\PayrollManager;

use App\Models\Payroll;
use App\Models\PayrollPayment;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class Payment extends Component
{
    public $payrollId, $amount, $voucher, $payment_date;

    public function render()
    {
        return view('livewire.payroll-manager.payment');
    }

    #[On('paymentPayroll')]
    public function paymentPayroll($id)
    {
        $this->payrollId = $id;
        Flux::modal('create-payment')->show();
    }

    protected $rules = [
        'amount' => 'required',
        'payment_date' => 'required',
    ];


    public function savePayment()
    {
        $this->validate();
        DB::beginTransaction();
        try {

            $payroll = Payroll::find($this->payrollId);
            if ($this->amount <= $payroll->due_salary) {
                $payment = new PayrollPayment();
                $payment->payroll_id = $this->payrollId;
                $payment->amount = $this->amount;
                $payment->voucher = $this->voucher;
                $payment->payment_date = $this->payment_date;
                $payment->save();

                $payroll->due_salary -= $this->amount;
                if ($payroll->due_salary == 0) {
                    $payroll->status = 'Paid';
                }
                $payroll->save();

                DB::commit(); // Missing in original code
                Flux::modal('create-payment')->close();
                $this->dispatch('refreshPayrolls');
                $this->reset();
                Flux::toast('Payment added successfully.');
                session()->flash('success', 'Payment added successfully.');
            } else {
                DB::rollBack();
                Flux::toast('Payment amount cannot be greater than due salary', 'error');
                session()->flash('error', 'Payment amount cannot be greater than due salary');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error saving payment: " . $e->getMessage()); // Fix log usage
            Flux::toast('Error saving payment', 'error');
            session()->flash('error', 'Error saving payment' . $e->getMessage());
        }
    }
}
