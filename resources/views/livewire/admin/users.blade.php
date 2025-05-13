<div>
    <!-- Flash Message -->
     <x-flash event="user-deleted" type="success" />
    <x-flash event="user-updated" type="success" />

    <!-- Edit User Form -->
    @if ($editUserId)
        <div class="p-4 mb-6 border rounded">
            <h2 class="mb-2 text-lg font-bold">Edit User</h2>

            <div class="space-y-3">
                <input type="text" wire:model.live="name" placeholder="Name" class="w-full p-2 border rounded" />
                <input type="email" wire:model.live="email" placeholder="Email" class="w-full p-2 border rounded" />
                <select wire:model.live="role" class="w-full p-2 border rounded">
                    <option value="">Select role</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>

                <div class="flex gap-3">
                    <button wire:click="updateUser"
                        class="px-4 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700">Update</button>
                    <button wire:click="resetForm"
                        class="px-4 py-2 text-black bg-gray-200 rounded hover:bg-gray-300">Cancel</button>
                </div>
            </div>
        </div>
    @endif

    <!-- DataTable -->
    @livewire('admin.users-table')
</div>
