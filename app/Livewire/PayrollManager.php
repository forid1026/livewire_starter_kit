<?php

// app/Livewire/PayrollManager.php
namespace App\Livewire;

use App\Models\Employee;
use App\Models\Payroll;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component; 


class PayrollManager extends Component
{
    public $payrollId;
    public function render()
    {
        return view('livewire.payroll-manager', [                                   
            'payrolls' => Payroll::latest()->paginate(5)
        ]);
    }


    public function edit($id)
    {
        $this->dispatch('editPayroll', $id);
    }

    public function view($id)
    {
        $this->payrollId = $id;
        $this->dispatch('viewPayroll', $id);
    }

    public function delete($id)
    {
        $this->payrollId = $id;
        Flux::modal('delete-payroll')->show();
    }

    public function deletePayroll()
    {
        Payroll::find($this->payrollId)->delete();
        Flux::modal('delete-payroll')->close();
        $this->dispatch('refreshPayrolls');
        Flux::toast('Payroll deleted successfully.');
    }
}
                                                                                                                                                                                                                                                                                                        