<?php

namespace App\Livewire\Employee;

use App\Models\Employee;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    public $employeeId;
    #[On('refreshEmployees')]

    public function render()
    {
        return view(
            'livewire.employee.index',
            [
                'employees' => Employee::latest()->paginate(5)
            ]
        );
    }

    public function edit($id)
    {
        $this->dispatch('editEmployee', $id);
    }

    public function delete($id)
    {
        $this->employeeId = $id;
        Flux::modal('delete-employee')->show();
    }

    public function destroyEmployee()
    {
        Employee::find($this->employeeId)->delete();
        Flux::modal('delete-employee')->close();
        $this->dispatch('refreshEmployees')->to('employee.index');
        Flux::toast('Employee deleted successfully.');
    }

    public function view($id)
    {
        $this->employeeId = $id;
        $this->dispatch('viewEmployee', $id);
    }
}
