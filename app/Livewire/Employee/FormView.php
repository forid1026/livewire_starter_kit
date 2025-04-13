<?php

namespace App\Livewire\Employee;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Employee;
use Flux\Flux;

class FormView extends Component
{
    public $employeeId, $name, $email, $phone, $joining_date, $basic_salary, $designation;

    public function render()
    {
        return view('livewire.employee.form-view');
    }


    #[On('viewEmployee')]
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

        Flux::modal('view-employee')->show();

    }
}
