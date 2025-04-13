<?php

namespace App\Livewire\Employee;

use App\Models\Employee;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;

class FormEdit extends Component
{
    public $employeeId , $name, $email, $phone, $joining_date, $basic_salary, $designation;
   
    public function render()
    {
        return view('livewire.employee.form-edit');
    }

    #[On('editEmployee')]
    public  function editEmployee($employeeId)
    {
        $employee = Employee::find($employeeId);

        $this->employeeId = $employee->id;
        $this->name = $employee->name;
        $this->email = $employee->email;
        $this->phone = $employee->phone;
        $this->joining_date = $employee->joining_date;
        $this->basic_salary = $employee->basic_salary;
        $this->designation = $employee->designation;

        Flux::modal('edit-employee')->show();

    }

    protected $rules = [
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'joining_date' => 'required',
        'basic_salary' => 'required',
        'designation' => 'required',
    ];
    public function updateEmployee()
    {
        $employee = Employee::find($this->employeeId);

        $this->validate();
        $employee->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'joining_date' => $this->joining_date,
            'basic_salary' => $this->basic_salary,
            'designation' => $this->designation,
            'updated_at' => now()
        ]);

        Flux::toast('Employee updated successfully.');
        Flux::modal('edit-employee')->close();

        $this->dispatch('refreshEmployees')->to('employee.index');
    }
}
