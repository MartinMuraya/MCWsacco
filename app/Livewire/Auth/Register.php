<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Services\AccountService;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ];

    public function register(AccountService $accountService)
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $memberRole = Role::firstOrCreate(['name' => 'member']);
        $user->assignRole($memberRole);

        $member = Member::create([
            'user_id' => $user->id,
            'member_number' => 'MWS-' . date('Y') . '-' . str_pad($user->id, 4, '0', STR_PAD_LEFT),
            'status' => 'pending',
            'registration_date' => now(),
        ]);

        $accountService->setupDefaultAccounts($member);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('components.layouts.app');
    }
}
