<div>
    <flux:heading size="xl" level="1">{{ __('Payroll Payment List') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Manage your employees all the payments') }}</flux:subheading>
    <flux:separator variant="subtle" />

    <flux:button class="mt-3" :href="route('payroll.manager')" wire:navigate>Payroll List</flux:button>

    <flux:button class="mt-3" :href="route('payroll.payment.list')" wire:navigate>Add Payment</flux:button>

    @if (session()->has('success'))
        <div class="mt-4 text-green-600 font-semibold mb-4">
            {{ session('success') }}
        </div>
    @endif

    <livewire:payroll-payment.edit />
    <flux:modal name="delete-payment" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete payment?</flux:heading>

                <flux:text class="mt-2">
                    <p>You're about to delete this payment.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="danger" wire:click="deletePayment">Delete payment</flux:button>
            </div>
        </div>
    </flux:modal>

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
                        Paid
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (count($payrollPayments) > 0)
                    @foreach ($payrollPayments as $key => $payroll)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $key + 1 }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $payroll->payroll->employee->name ?? null }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $payroll->payment_date }}
                            </td>
                            </td>
                            <td class="px-6 py-4">
                                {{ $payroll->amount }}
                            </td>
                            <td class="px-6 py-4">
                                <flux:button size="sm" wire:click="edit({{ $payroll->id }})">Edit</flux:button>
                                <flux:button size="sm" variant="danger" wire:click="delete({{ $payroll->id }})">
                                    Delete
                                </flux:button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <td colspan="5" class="px-6 py-4 text-center">
                            No data found.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{ $payrollPayments->links() }}
    </div>
</div>
