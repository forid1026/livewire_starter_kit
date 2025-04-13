<?php

namespace App\Livewire\PayrollManager;

use App\Models\Employee;
use App\Models\Payroll;
use Livewire\Component;
use Livewire\Attributes\On;
use Flux\Flux;

class View extends Component
{

    public $payrollId, $employee_id, $month, $year, $basic_salary, $allowances = [], $deductions = [];
    public $total_allowance = 0, $total_deduction = 0, $net_salary = 0;
    public function render()
    {
        return view('livewire.payroll-manager.view',
        [
            'employees' => Employee::all(),
        ]);
    }

    
    #[On('viewPayroll')]
    public function viewPayroll($id)
    {
        $this->payrollId = $id;
        $payroll = Payroll::findOrFail($id);

        $this->employee_id = $payroll->employee->name;
        $this->month = $payroll->month;
        $this->year = $payroll->year;
        $this->basic_salary = $payroll->basic_salary;
        $this->allowances = $payroll->allowances;
        $this->deductions = $payroll->deductions;
        $this->net_salary = $payroll->net_salary;
        Flux::modal('view-payroll')->show();
    }


}
