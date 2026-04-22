<?php

namespace App\Services;

use App\Models\Member;
use App\Models\Account;
use Illuminate\Support\Str;

class AccountService
{
    /**
     * Create a new account for a member
     *
     * @param Member|null $member
     * @param string $type ('savings', 'loan', 'share_capital', 'penalty', 'interest', 'operating')
     * @param string $name
     * @return Account
     */
    public function createAccount(?Member $member, string $type, string $name): Account
    {
        $accountNumber = $this->generateAccountNumber($type, $member);

        return Account::create([
            'account_number' => $accountNumber,
            'account_type' => $type,
            'member_id' => $member ? $member->id : null,
            'name' => $name,
            'balance' => 0,
            'is_active' => true,
        ]);
    }

    /**
     * Setup default accounts for a new member
     *
     * @param Member $member
     * @return void
     */
    public function setupDefaultAccounts(Member $member): void
    {
        $defaults = config('sacco.default_accounts', [
            'share_capital' => 'Share Capital Account',
            'savings' => 'Main Savings Account'
        ]);

        foreach ($defaults as $type => $name) {
            // Only create if type matches enum or handle mapping
            if (in_array($type, ['savings', 'share_capital'])) {
                $this->createAccount($member, $type, $name);
            }
        }
    }

    private function generateAccountNumber(string $type, ?Member $member): string
    {
        // Format: [TYPE]-[MEMBER_NO]-[RANDOM] or sequential
        $prefix = match($type) {
            'savings' => 'SAV',
            'loan' => 'LON',
            'share_capital' => 'SHR',
            'penalty' => 'PEN',
            'interest' => 'INT',
            'operating' => 'OPR',
            default => 'ACC'
        };

        $memberSegment = $member ? $member->member_number : '0000';
        $random = strtoupper(Str::random(4));

        return "{$prefix}-{$memberSegment}-{$random}";
    }
}
