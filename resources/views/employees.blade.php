<x-layouts.app :title="__('Employees')">
    <flux:heading size="xl" level="1">{{ __('Employees') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Manage your employees') }}</flux:subheading>
    <flux:separator variant="subtle" />

    <livewire:employee.index />
</x-layouts.app>
