<?php

namespace App\Livewire\PayrollManager;

use App\Models\Employee;
use App\Models\Payroll;
use Flux\Flux;
use Livewire\Component;

class Create extends Component
{
    public $employee_id, $month, $year, $basic_salary, $allowances = [], $deductions = [];
    public $total_allowance = 0, $total_deduction = 0, $net_salary = 0;

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
        $this->total_allowance = collect($this->allowances)->sum('amount');
        $this->total_deduction = collect($this->deductions)->sum('amount');
        $this->net_salary = ($this->basic_salary + $this->total_allowance) - $this->total_deduction;
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
            'due_salary' => $this->net_salary,
            'net_salary' => $this->net_salary,
        ]);

        foreach ($this->allowances as $allowance) {
            $payroll->allowances()->create($allowance);
        }

        foreach ($this->deductions as $deduction) {
            $payroll->deductions()->create($deduction);
        }


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
