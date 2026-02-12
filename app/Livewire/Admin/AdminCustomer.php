<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin')]
#[Title('Customers')]
class AdminCustomer extends Component
{
    use WithPagination;

    public $search = '';
    public $role = '';
    public $status = '';
    public $active = '';

    public $showModal = false;
    public $selectedUser = null;

    protected $queryString = ['search', 'role', 'status', 'active'];

    public function view($id)
    {
        $this->selectedUser = User::findOrFail($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedUser = null;
    }

    public function render()
    {
        $customers = User::query()
            ->where('role', '!=', 'ADMIN')
            ->when(
                $this->search,
                fn($q) =>
                $q->where(function ($qq) {
                    $qq->where('name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%")
                        ->orWhere('phone', 'like', "%{$this->search}%");
                })
            )
            ->when($this->role, fn($q) => $q->where('role', $this->role))
            ->when($this->status, fn($q) => $q->where('apply_status', $this->status))
            ->when($this->active !== '', fn($q) => $q->where('is_active', $this->active))
            ->latest()
            ->paginate(10);

        return view('livewire.admin.admin-customer', compact('customers'));
    }
}
