<?php

namespace App\Livewire\PayrollManager;

use App\Models\Allowance;
use App\Models\Deduction;
use App\Models\Employee;
use App\Models\Payroll;
use Flux\Flux;
use Livewire\Component;

class Create extends Component
{
    public $employee_id, $month, $year, $basic_salary;
    public $payrollId, $total_allowance = 0, $total_deduction = 0, $net_salary = 0, $due_salary;

    // When any of the properties changes, recalculate the net salary
    public function updated($propertyName)
    {
        $this->calculateNetSalary();
    }

    // When the employee_id changes, update the basic salary and recalculate the net salary
    public function updatedEmployeeId()
    {
        $employee = Employee::find($this->employee_id);
        $this->basic_salary = $employee->basic_salary ?? 0;
        $this->calculateNetSalary();
    }


    // Calculate the net salary
    // This method is called whenever the user changes any of the properties
    // It calculates the total allowance and total deduction, and then subtracts the total deduction from the basic salary plus total allowance
    public function calculateNetSalary()
    {
        // Get all the deductions for the current payroll
        $deduction = Deduction::where('payroll_id', $this->payrollId)->get();
        // Get all the allowances for the current payroll
        $allowance = Allowance::where('payroll_id', $this->payrollId)->get();
        // Calculate the total deduction
        $this->total_deduction = $deduction->sum('amount');
        // Calculate the total allowance
        $this->total_allowance = $allowance->sum('amount');
        // Calculate the net salary
        $this->net_salary = ($this->basic_salary + $this->total_allowance) - $this->total_deduction;
        // Set the due salary to the net salary
        $this->due_salary = $this->net_salary;
    }

    protected $rules = [
        'employee_id' => 'required',
        'month' => 'required',
        'year' => 'required',
    ];
    public function savePayroll()
    {

        $this->validate();

        $payroll = Payroll::create([
            'employee_id' => $this->employee_id,
            'month' => $this->month,
            'year' => $this->year,
            'basic_salary' => $this->basic_salary,
            'allowance' => $this->total_allowance,
            'deduction' => $this->total_deduction,
            'due_salary' => $this->due_salary,
            'net_salary' => $this->net_salary,
        ]);

  
        // Close the modal
        Flux::modal('create-payroll')->close();

        $this->reset();
        session()->flash('success', 'Payroll generated successfully.');
        $this->dispatch('refreshPayrolls');
    }

    public function render()
    {
        return view('livewire.payroll-manager.create', [
            'employees' => Employee::all(),
        ]);
    }
}
