<?php

namespace App\Livewire\Employee;

use App\Models\Employee;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    #[On('refreshEmployees')]
    public function render()
    {
        return view('livewire.employee.index',
    [
        'employees' => Employee::latest()->get()
    ]);
    }
}
