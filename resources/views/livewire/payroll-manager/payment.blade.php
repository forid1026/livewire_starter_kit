<flux:modal name="create-payment" class="md:w-[600px]" style="width: 600px">
    <div class="space-y-6">
        <div>
            @if (session()->has('success'))
                <div class="mt-4 text-green-600 font-semibold mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="mt-4 text-red-600 font-semibold mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <flux:heading size="lg">Create Payment</flux:heading>
            <flux:text class="mt-2">Make employees payment.</flux:text>
        </div>

        <flux:input type="date" label="Date" wire:model="payment_date" placeholder="Payment Date" />
        <flux:input type="number" label="Payment Amount" wire:model="amount" placeholder="Payment Amount" />
        <flux:input type="text" label="Voucher" wire:model="voucher" placeholder="Payment Voucher" />

        <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700"
            wire:click="savePayment">
            Save Payment
        </button>
    </div>
</flux:modal>
