<?php

namespace App\Livewire\Employee;
use Flux\Flux;
use App\Models\Employee;
use Livewire\Component;

class Form extends Component
{
    public $name, $email, $phone, $joining_date, $basic_salary, $designation;

    public function render()
    {
        return view('livewire.employee.form');
    }

    protected $rules = [
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'joining_date' => 'required',
        'basic_salary' => 'required',
        'designation' => 'required',
    ];

    /**
     * Create a new employee and reset the form fields.
     */
    public function createEmployee(): void
    {
        // Validate the form fields
        $this->validate();

        // Create a new employee
        Employee::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'joining_date' => $this->joining_date,
            'basic_salary' => $this->basic_salary,
            'designation' => $this->designation,
            'created_at' => now()
        ]);

        // Reset the form fields
        $this->reset(['name', 'email', 'phone', 'joining_date', 'basic_salary', 'designation']);

        // Close the modal
        Flux::modal('create-employee')->close();

        // Dispatch an event to refresh the employees list
        $this->dispatch('refreshEmployees')->to('employee.index');
    }
}
