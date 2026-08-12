<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UserManager extends Component
{
    use WithPagination;

    public $search = '';

    public function toggleAdminRole(User $user)
    {
        // Don't allow removing own admin role
        if ($user->id === auth()->id()) {
            $this->dispatch('notify', ['message' => 'You cannot remove your own admin role', 'type' => 'error']);
            return;
        }

        if ($user->hasRole('admin')) {
            $user->removeRole('admin');
            $user->assignRole('user'); // Ensure they fall back to basic user
        } else {
            $user->assignRole('admin');
        }

        $this->dispatch('notify', ['message' => 'User role updated successfully!', 'type' => 'success']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.admin.user-manager', [
            'users' => $users
        ]);
    }
}
