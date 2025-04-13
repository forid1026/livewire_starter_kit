<?php

namespace App\Livewire\PayrollManager;

use App\Models\Employee;
use App\Models\Payroll;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $payrollId, $employee_id, $month, $year, $basic_salary, $allowances = [], $deductions = [];
    public $total_allowance = 0, $total_deduction = 0, $net_salary = 0;
    public function render()
    {
        return view('livewire.payroll-manager.edit', [
            'employees' => Employee::all(),
        ]);
    }

    #[On('editPayroll')]
    public function editPayroll($id)
    {
        $this->payrollId = $id;
        $payroll = Payroll::findOrFail($id);

        $this->employee_id = $payroll->employee_id;
        $this->month = $payroll->month;
        $this->year = $payroll->year;
        $this->basic_salary = $payroll->basic_salary;
        $this->allowances = $payroll->allowances;
        $this->deductions = $payroll->deductions;
        Flux::modal('edit-payroll')->show();
    }

    public function updated($propertyName)
    {
        $this->calculateNetSalary();
    }

    public function updatedEmployeeId()
    {
        $employee = Employee::find($this->employee_id);
        $this->basic_salary = $employee->basic_salary ?? 0;
        $this->calculateNetSalary();
    }

    public function addAllowance()
    {
        $this->allowances[] = ['type' => '', 'amount' => 0];
    }

    public function addDeduction()
    {
        $this->deductions[] = ['type' => '', 'amount' => 0];
    }

    public function calculateNetSalary()
    {
        $this->total_allowance = collect($this->allowances)->sum('amount');
        $this->total_deduction = collect($this->deductions)->sum('amount');
        $this->net_salary = ($this->basic_salary + $this->total_allowance) - $this->total_deduction;
    }

    public function updatePayroll()
    {
        $payroll = Payroll::findOrFail($this->payrollId)->update([
            'employee_id' => $this->employee_id,
            'month' => $this->month,
            'year' => $this->year,
            'basic_salary' => $this->basic_salary,
            'allowance' => $this->total_allowance,
            'deduction' => $this->total_deduction,
            'net_salary' => $this->net_salary,
        ]);

        foreach ($this->allowances as $allowance) {
            $payroll->allowances()->create($allowance);
        }

        foreach ($this->deductions as $deduction) {
            $payroll->deductions()->create($deduction);
        }


        // Close the modal
        Flux::modal('edit-payroll')->close();

        $this->reset();
        session()->flash('success', 'Payroll updated successfully.');
        $this->dispatch('refreshPayrolls');
     
    }
}
