<div>
    <flux:modal name="edit-post" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update Post</flux:heading>
                <flux:text class="mt-2">Make posts to your personal details.</flux:text>
            </div>

            <flux:input label="Title" wire:model="title" placeholder="Post Title" />

            <flux:textarea label="Description" wire:model="description" placeholder="Enter description..." />

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" wire:click="updatePost" variant="primary">Update</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
