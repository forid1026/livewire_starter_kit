<flux:modal name="create-payroll" style="width: 600px;">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Create Payroll</flux:heading>
            <flux:text class="mt-2">Make employees payroll.</flux:text>
        </div>

        @error('employee_id')   
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
        @enderror
        <flux:select size="sm" placeholder="Choose Employee..." wire:model="employee_id">
            <flux:select.option value="">Select Employee</flux:select.option>
            @foreach ($employees as $emp)
                <flux:select.option value="{{ $emp->id }}">{{ $emp->name }} </flux:select.option>
            @endforeach
        </flux:select>

        @error('month')   
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
        @enderror
        <flux:select size="sm" placeholder="Choose Month..." wire:model="month">
            <flux:select.option value="">Select Month</flux:select.option>
            <flux:select.option value="January">January</flux:select.option>
            <flux:select.option value="February">February</flux:select.option>
            <flux:select.option value="March">March</flux:select.option>
            <flux:select.option value="April">April</flux:select.option>
            <flux:select.option value="May">May</flux:select.option>
            <flux:select.option value="June">June</flux:select.option>
            <flux:select.option value="July">July</flux:select.option>
            <flux:select.option value="August">August</flux:select.option>
            <flux:select.option value="September">September</flux:select.option>
            <flux:select.option value="October">October</flux:select.option>
            <flux:select.option value="November">November</flux:select.option>
            <flux:select.option value="December">December</flux:select.option>
        </flux:select>

        @error('year')   
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
        @enderror
        <flux:select size="sm" placeholder="Choose Year..." wire:model="year">
            <flux:select.option value="">Select Year</flux:select.option>
            @for ($i = date('Y'); $i >= date('Y') - 10; $i--)
                <flux:select.option value="{{ $i }}">{{ $i }}</flux:select.option>
            @endfor
        </flux:select>
       

        <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700"
            wire:click="savePayroll">
            Save Payroll
        </button>
    </div>
</flux:modal>
