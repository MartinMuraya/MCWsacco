<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Member;
use App\Models\LoanProduct;
use App\Models\Hostel;
use App\Models\Room;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Services\AccountService;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(AccountService $accountService): void
    {
        // 1. Roles & Permissions
        $adminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $memberRole = Role::firstOrCreate(['name' => 'member']);

        // 2. Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@mwsacco.co.ke'],
            ['name' => 'System Admin', 'password' => Hash::make('password')]
        );
        if (!$admin->hasRole('super_admin')) {
            $admin->assignRole($adminRole);
        }

        // 3. Loan Products
        $loanProducts = [
            [
                'name' => 'Emergency Loan',
                'interest_rate' => 12.00,
                'interest_type' => 'straight_line',
                'max_amount' => 50000,
                'max_period_months' => 6,
                'requires_guarantors' => true,
                'max_guarantors' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Development Loan',
                'interest_rate' => 10.50,
                'interest_type' => 'reducing_balance',
                'max_amount' => 500000,
                'max_period_months' => 36,
                'requires_guarantors' => true,
                'max_guarantors' => 3,
                'is_active' => true,
            ]
        ];

        foreach ($loanProducts as $product) {
            LoanProduct::firstOrCreate(['name' => $product['name']], $product);
        }

        // 4. Hostels & Rooms
        $hostel = Hostel::firstOrCreate(
            ['name' => 'Sunrise Women\'s Annex'],
            [
                'location' => 'Main Campus Drive',
                'description' => 'Premium hostel for students',
                'is_active' => true,
            ]
        );

        for ($i = 1; $i <= 5; $i++) {
            Room::firstOrCreate(
                ['hostel_id' => $hostel->id, 'room_number' => 'A' . str_pad($i, 2, '0', STR_PAD_LEFT)],
                [
                    'room_type' => 'double',
                    'capacity' => 2,
                    'price_per_semester' => 15000,
                    'is_active' => true,
                ]
            );
        }

        // 5. Test Member
        $memberUser = User::firstOrCreate(
            ['email' => 'jane@example.com'],
            ['name' => 'Jane Doe', 'password' => Hash::make('password')]
        );
        
        if (!$memberUser->hasRole('member')) {
            $memberUser->assignRole($memberRole);
        }

        $member = Member::firstOrCreate(
            ['user_id' => $memberUser->id],
            [
                'member_number' => 'MWS-2026-0001',
                'status' => 'active',
                'registration_date' => now()
            ]
        );

        // Setup accounts for member if they don't have any
        if ($member->accounts()->count() == 0) {
            $accountService->setupDefaultAccounts($member);
            
            // Give them some fake savings
            $savings = $member->accounts()->where('account_type', 'savings')->first();
            if ($savings) {
                $savings->update(['balance' => 45000]);
            }
            
            $shares = $member->accounts()->where('account_type', 'share_capital')->first();
            if ($shares) {
                $shares->update(['balance' => 10000]);
            }
        }
    }
}
