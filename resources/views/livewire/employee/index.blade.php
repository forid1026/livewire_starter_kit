<div>
    <div class="my-3">
        <flux:modal.trigger name="create-employee">
            <flux:button>Create Employee</flux:button>
        </flux:modal.trigger>
    </div>

    <livewire:employee.form />
    <livewire:employee.form-edit />
    <flux:modal name="delete-employee" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete employee?</flux:heading>

                <flux:text class="mt-2">
                    <p>You're about to delete this employee.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button type="submit" wire:click="destroyEmployee" variant="danger">Delete Employee</flux:button>
            </div>
        </div>
    </flux:modal>

    <livewire:employee.form-view />


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
                        Designation
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Salary
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $key => $employee)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $key + 1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $employee->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $employee->designation }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $employee->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $employee->basic_salary }}
                        </td>
                        <td class="px-6 py-4">
                            <flux:button size="sm" wire:click="edit({{ $employee->id }})">Edit</flux:button>
                            <flux:button size="sm" wire:click="view({{ $employee->id }})">View</flux:button>
                            <flux:button size="sm" variant="danger" wire:click="delete({{ $employee->id }})">Delete
                            </flux:button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $employees->links() }}
    </div>

</div>
