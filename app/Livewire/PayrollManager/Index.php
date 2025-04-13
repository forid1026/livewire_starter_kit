<?php

namespace App\Livewire\PayrollManager;

use App\Models\Payroll;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $payrollId;
    // Listen for 'refreshPayrolls' event
    #[On('refreshPayrolls')]
    public function refreshPayrolls()
    {
        // Optionally reset pagination
        $this->resetPage();

        // Optionally, you can force the component to refresh
        $this->dispatch('$refresh');
    }

    public function render()
    {
        return view(
            'livewire.payroll-manager.index',
            [
                'payrolls' => Payroll::latest()->paginate(5)
            ]
        );
    }

    #[On('editPayroll')]
    public function editPayroll($id)
    {
        $this->payrollId = $id;
        Flux::modal('edit-payroll')->show();
    }
}
