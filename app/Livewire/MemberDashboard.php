<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MemberDashboard extends Component
{
    public function render()
    {
        $user = Auth::user();
        $member = $user ? $user->member : null;
        
        $accounts = $member ? $member->accounts : collect([]);
        $loans = $member ? $member->loans()->whereIn('status', ['active', 'defaulted'])->get() : collect([]);
        $bookings = $member ? \App\Models\HostelBooking::where('student_email', $user->email)->get() : collect([]);

        // Calculate totals
        $totalSavings = $accounts->where('account_type', 'savings')->sum('balance');
        $totalShares = $accounts->where('account_type', 'share_capital')->sum('balance');
        $activeLoanBalance = $loans->sum('outstanding_balance');

        return view('livewire.member-dashboard', [
            'member' => $member,
            'accounts' => $accounts,
            'loans' => $loans,
            'bookings' => $bookings,
            'totalSavings' => $totalSavings,
            'totalShares' => $totalShares,
            'activeLoanBalance' => $activeLoanBalance,
        ]);
    }
}
