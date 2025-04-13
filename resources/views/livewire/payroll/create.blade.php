<div class="grid grid-cols-2 gap-4">
    <flux:modal name="create-payroll" class="md:w-[600px]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Create Employee</flux:heading>
                <flux:text class="mt-2">Make employees personal details.</flux:text>
            </div>

            <flux:select size="sm" placeholder="Choose industry...">
                <flux:select.option>Photography</flux:select.option>
            </flux:select>
            <flux:input label="Basic Salary" wire:model="basic_salary" placeholder="Basic Salary" />
            <flux:input label="Allowance" wire:model="allowance" placeholder="Allowance" />
            <flux:input label="Advance" wire:model="advance" placeholder="Advance" />
            <flux:input label="Deduction" wire:model="deduction" placeholder="Deduction" />
            <flux:input label="Net Salary" wire:model="net_salary" placeholder="Net Salary" />


            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" wire:click="createEmployee" variant="primary">Save</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
