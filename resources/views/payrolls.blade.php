<x-layouts.app :title="__('Payrolls')">
    <flux:heading size="xl" level="1">{{ __('Payrolls') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Manage your employees payrolls') }}</flux:subheading>
    <flux:separator variant="subtle" />

    <livewire:payroll.index />
</x-layouts.app>
