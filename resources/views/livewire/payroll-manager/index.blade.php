<div>
    <div class="my-3">
        <flux:modal.trigger name="create-payroll">
            <flux:button>Create Payroll</flux:button>
        </flux:modal.trigger>
    </div>
    @if (session()->has('success'))
        <div class="mt-4 text-green-600 font-semibold">
            {{ session('success') }}
        </div>
    @endif
    <livewire:payroll-manager.create />
    <flux:modal name="delete-payroll" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete Payroll?</flux:heading>

                <flux:text class="mt-2">
                    <p>You're about to delete this payroll.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button type="submit" wire:click="destroyEmployee" variant="danger">Delete Payroll</flux:button>
            </div>
        </div>
    </flux:modal>

    <livewire:payroll-manager.edit />


    <div class="relative overflow-x-auto mt-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Sl
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Basic Salary
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Allowance
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Advance
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Deduction
                    </th>
                    <th>
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payrolls as $key => $payroll)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $key + 1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $payroll->employee->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $payroll->month }}, {{ $payroll->year }}
                        </td> 
                        </td>
                        <td class="px-6 py-4">
                            {{ $payroll->basic_salary }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $payroll->allowance }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $payroll->advance }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $payroll->deduction }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $payroll->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <flux:button size="sm" wire:click="edit({{ $payroll->id }})">Edit</flux:button>
                            <flux:button size="sm" wire:click="view({{ $payroll->id }})">View</flux:button>
                            <flux:button size="sm" wire:click="payment({{ $payroll->id }})">Payment
                            </flux:button>
                            <flux:button size="sm" variant="danger" wire:click="delete({{ $payroll->id }})">Delete
                            </flux:button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $payrolls->links() }}
    </div>

</div>
