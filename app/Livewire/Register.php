<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{

    #[Validate('required|min:5')]
    public $name ;
    #[Validate('required')]
    public $email ;
    #[Validate('required')]
    public $password ;
    public function save()
    {dd($this);
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);


        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->string('password')),
        ]);
    }

    public function render()
    {
        return view('livewire.register');
    }
    public $showRegisterModal = false;

protected $listeners = ['openRegisterModal'];

public function openRegisterModal()
{
    $this->showRegisterModal = true;
}
}
