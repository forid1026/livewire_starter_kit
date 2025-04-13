<?php

namespace App\Livewire\Payroll;

use App\Models\Payroll;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.payroll.index',
            [
                'payrolls' => Payroll::latest()->paginate(5)
            ]);
    }
}
