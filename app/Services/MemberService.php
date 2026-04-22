<?php

namespace App\Services;

use App\Models\Member;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MemberService
{
    private AccountService $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     * Register a new member and setup accounts
     */
    public function registerMember(array $data, $userId = null): Member
    {
        return DB::transaction(function () use ($data, $userId) {
            // Generate Member Number: MWS-[YEAR]-[SEQUENCE]
            $year = date('Y');
            $lastMember = Member::where('member_number', 'like', "MWS-{$year}-%")->orderBy('id', 'desc')->first();
            $sequence = $lastMember ? ((int) substr($lastMember->member_number, -4)) + 1 : 1;
            $memberNumber = "MWS-{$year}-" . str_pad($sequence, 4, '0', STR_PAD_LEFT);

            $member = Member::create([
                'user_id' => $data['user_id'] ?? null,
                'member_number' => $memberNumber,
                'gender' => $data['gender'] ?? null,
                'dob' => $data['dob'] ?? null,
                'county' => $data['county'] ?? null,
                'sub_county' => $data['sub_county'] ?? null,
                'village' => $data['village'] ?? null,
                'next_of_kin_name' => $data['next_of_kin_name'] ?? null,
                'next_of_kin_phone' => $data['next_of_kin_phone'] ?? null,
                'next_of_kin_relationship' => $data['next_of_kin_relationship'] ?? null,
                'occupation' => $data['occupation'] ?? null,
                'employer' => $data['employer'] ?? null,
                'monthly_income' => $data['monthly_income'] ?? null,
                'status' => 'pending',
                'registration_date' => now(),
            ]);

            // Setup default accounts (Savings, Share Capital)
            $this->accountService->setupDefaultAccounts($member);

            return $member;
        });
    }

    public function approveMember(Member $member, $approverId): void
    {
        $member->update([
            'status' => 'active',
            'approved_by' => $approverId,
            'approved_at' => now(),
        ]);
    }
}
