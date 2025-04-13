<flux:modal name="view-payroll" class="md:w-[600px]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">View Payroll </flux:heading>
        </div>

        <flux:input label="Name" wire:model="employee_id" placeholder="Name" aria-readonly="" readonly />
        <flux:input label="Month" wire:model="month" placeholder="Month" aria-readonly="" readonly />
        <flux:input label="Year" wire:model="year" placeholder="Year" aria-readonly="" readonly />
        <flux:input type="number" label="Basic Salary" wire:model="basic_salary" placeholder="Basic Salary" aria-readonly="" readonly />

        <div>
            <flux:heading size="lg">Allowances: {{ $total_allowance }}</flux:heading>
        </div>
        <div>
            <flux:heading size="lg">Deduction: {{ $total_deduction }}</flux:heading>
        </div>
        <flux:heading size="lg">Net Salary: {{ $net_salary }} </flux:heading>
    </div>
</flux:modal>
