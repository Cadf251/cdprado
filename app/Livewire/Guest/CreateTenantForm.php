<?php

namespace App\Livewire\Guest;

use App\Models\Tenant;
use App\Services\TenantService;
use Livewire\Component;

class CreateTenantForm extends Component
{
    public $name;
    public $email;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'email' => 'required|email|unique:users,email',
    ];

    public function save()
    {
        $this->validate();

        $service = new TenantService();
        $service->register($this->name, $this->email);
    }

    public function render()
    {
        return view('components.guest.⚡create-tenant-form');
    }
}
