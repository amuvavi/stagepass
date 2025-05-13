
<div x-data>
    <button
        @click="$dispatch('edit-user', { id: @json($user->id) })"
        class="text-blue-600 hover:underline text-sm"
    >
        Edit
    </button>

    <button
        @click="
            if (confirm('Are you sure you want to delete this user?')) {
                $dispatch('delete-user', { id: @json($user->id) });
            }
        "
        class="text-red-600 hover:underline text-sm"
    >
        Delete  
    </button>
</div>
</div>
