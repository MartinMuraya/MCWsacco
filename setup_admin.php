<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

$user = User::firstOrCreate(
    ['email' => 'admin@mwsacco.co.ke'], 
    ['name' => 'System Admin', 'password' => Hash::make('password')]
);

$role = Role::firstOrCreate(['name' => 'super_admin']);
if (!$user->hasRole('super_admin')) {
    $user->assignRole($role);
}

echo "Admin created!\n";
