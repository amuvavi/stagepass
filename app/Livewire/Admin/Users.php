<?php
namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $editUserId = null;
    public $name;
    public $email;
    public $role;

    protected $listeners = [
        'delete-user' => 'deleteUser',
        'edit-user' => 'editUser',
    ];

    public function editUser(int $id)
    {
        $user = User::findOrFail($id);

        $this->editUserId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|in:user,admin',
        ]);

        $user = User::findOrFail($this->editUserId);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ]);

        $this->dispatch('user-updated', message: 'User updated successfully.');
        $this->resetForm();
    }

   public function deleteUser(array $data)
{
    $id = $data['id'] ?? null;

    if ($id) {
        $user = User::findOrFail($id); 
        $user->delete();

        $this->dispatch('user-deleted', message: 'User deleted.');
    }
}

    public function resetForm()
    {
        $this->reset(['editUserId', 'name', 'email', 'role']);
    }


    public function render()
    {
        return view('livewire.admin.users');
    }
}
