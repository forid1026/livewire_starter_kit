<?php

namespace App\Livewire\PayrollManager;

use App\Models\Allowance;
use App\Models\Deduction;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\PayrollPayment;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $payrollId, $employee_id, $month, $year, $basic_salary;
    public $due_salary, $paid_amount, $total_allowance = 0, $total_deduction = 0, $net_salary = 0;
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



    public function calculateNetSalary()
    {
        // Get all the deductions for the current payroll
        $deduction = Deduction::where('payroll_id', $this->payrollId)->get();
        // Get all the allowances for the current payroll
        $allowance = Allowance::where('payroll_id', $this->payrollId)->get();
        $paid = PayrollPayment::where('payroll_id', $this->payrollId)->get();
        // Calculate the total deduction
        $this->total_deduction = $deduction->sum('amount');
        // Calculate the total allowance
        $this->total_allowance = $allowance->sum('amount');
        // Calculate the paid amount
        $this->paid_amount = $paid->sum('amount');
        // Calculate the net salary
        $this->net_salary = ($this->basic_salary + $this->total_allowance) - $this->total_deduction - $this->paid_amount;
        // Set the due salary to the net salary
        $this->due_salary = $this->net_salary;
    }

    protected $rules = [
        'employee_id' => 'required',
        'month' => 'required',
        'year' => 'required',
    ];
    public function updatePayroll()
    {
        $this->validate();

        $this->calculateNetSalary(); // 👈 recalculate before update

        $payroll = Payroll::findOrFail($this->payrollId)->update([
            'employee_id' => $this->employee_id,
            'month' => $this->month,
            'year' => $this->year,
            'basic_salary' => $this->basic_salary,
            'allowance' => $this->total_allowance,
            'deduction' => $this->total_deduction,
            'net_salary' => $this->net_salary,
        ]);



        // Close the modal
        Flux::modal('edit-payroll')->close();

        $this->reset();
        session()->flash('success', 'Payroll updated successfully.');
        $this->dispatch('refreshPayrolls');
    }
}
