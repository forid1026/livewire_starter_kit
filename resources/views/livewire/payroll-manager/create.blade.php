<flux:modal name="create-payroll" class="md:w-[600px]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Create Payroll</flux:heading>
            <flux:text class="mt-2">Make employees payroll.</flux:text>
        </div>

        <flux:select size="sm" placeholder="Choose industry..." wire:model="employee_id">
            @foreach ($employees as $emp)
                <flux:select.option value="{{ $emp->id }}">{{ $emp->name }} </flux:select.option>
            @endforeach
        </flux:select>

        <flux:input label="Month" wire:model="month" placeholder="Month" />
        <flux:input label="Year" wire:model="year" placeholder="Year" />
        <flux:input type="number" label="Basic Salary" wire:model="basic_salary" placeholder="Basic Salary" />

        <div>
            <flux:heading size="lg">Allowances</flux:heading>
            <div class="space-y-2">
                @foreach ($allowances as $index => $item)
                    <div class="grid grid-cols-2 gap-4">
                        <flux:input type="text" wire:model="allowances.{{ $index }}.type" placeholder="Type"
                            class="border-gray-300 rounded-md shadow-sm" />
                        <flux:input type="number" wire:model="allowances.{{ $index }}.amount"
                            placeholder="Amount" class="border-gray-300 rounded-md shadow-sm" />
                    </div>
                @endforeach
            </div>
            <button type="button" wire:click="addAllowance" class="mt-2 text-sm text-blue-600 hover:underline">+ Add
                Allowance</button>
        </div>

        <div>
            <flux:heading size="lg">Deductions </flux:heading>
            <div class="space-y-2">
                @foreach ($deductions as $index => $item)
                    <div class="grid grid-cols-2 gap-4">
                        <flux:input type="text" wire:model="deductions.{{ $index }}.type" placeholder="Type"
                            class="border-gray-300 rounded-md shadow-sm" />
                        <flux:input type="number" wire:model="deductions.{{ $index }}.amount"
                            placeholder="Amount" class="border-gray-300 rounded-md shadow-sm" />
                    </div>
                @endforeach
            </div>
            <button type="button" wire:click="addDeduction" class="mt-2 text-sm text-blue-600 hover:underline">+ Add
                Deduction</button>
        </div>

        <div class="bg-gray-100 p-4 rounded-md">
            <flux:heading size="lg">Net Salary: {{ $net_salary }} </flux:heading>
        </div>

        <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700" wire:click="savePayroll">
            Save Payroll
        </button>
    </div>
</flux:modal>
