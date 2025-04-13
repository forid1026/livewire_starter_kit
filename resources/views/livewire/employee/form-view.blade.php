<div class="grid grid-cols-2 gap-4">
    <flux:modal name="view-employee" class="md:w-[600px]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">View Employee Details</flux:heading>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <flux:input label="Name" wire:model="name" placeholder="Employee Name" aria-readonly="" readonly />
                <flux:input label="Designation" wire:model="designation"  placeholder="Employee Designation" aria-readonly="" readonly  />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <flux:input label="Email" wire:model="email" placeholder="Employee Email" aria-readonly="" readonly  />
                <flux:input label="Phone" wire:model="phone" placeholder="Employee Phone" aria-readonly="" readonly  />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <flux:input type="date" label="Joining Date" wire:model="joining_date" placeholder="Joining Date" aria-readonly="" readonly  />
                <flux:input label="Basic Salary" wire:model="basic_salary" placeholder="Employee Basic Salary" aria-readonly="" readonly  />
            </div>
        </div>
    </flux:modal>
</div>
