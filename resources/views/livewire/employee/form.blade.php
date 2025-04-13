<div class="grid grid-cols-2 gap-4">
    <flux:modal name="create-employee" class="md:w-[600px]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create Employee</flux:heading>
                <flux:text class="mt-2">Make employees  personal details.</flux:text>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <flux:input label="Name" wire:model="name" placeholder="Employee Name" />
                <flux:input label="Designation" wire:model="designation" placeholder="Employee Designation" />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <flux:input label="Email" wire:model="email" placeholder="Employee Email" />
                <flux:input label="Phone" wire:model="phone" placeholder="Employee Phone" />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <flux:input type="date" label="Joining Date" wire:model="joining_date" placeholder="Joining Date" />
                <flux:input label="Basic Salary" wire:model="basic_salary" placeholder="Employee Basic Salary" />
            </div>

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" wire:click="createEmployee" variant="primary">Save</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
