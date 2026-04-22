<?php

namespace App\Services;

use App\Models\LoanApplication;
use App\Models\Loan;
use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;

class LoanService
{
    private LoanCalculatorService $calculator;
    private JournalEntryService $journal;
    private AccountService $accountService;

    public function __construct(LoanCalculatorService $calculator, JournalEntryService $journal, AccountService $accountService)
    {
        $this->calculator = $calculator;
        $this->journal = $journal;
        $this->accountService = $accountService;
    }

    public function approveApplication(LoanApplication $application, $approverId): void
    {
        if ($application->status !== 'under_review') {
            throw new Exception("Application must be under review to be approved.");
        }

        $application->update([
            'status' => 'approved',
            'approved_by' => $approverId,
            'approved_at' => now(),
        ]);
    }

    public function disburseLoan(LoanApplication $application, $disburserId, $paymentMethod, $reference = null): Loan
    {
        if ($application->status !== 'approved') {
            throw new Exception("Application must be approved to be disbursed.");
        }

        return DB::transaction(function () use ($application, $disburserId, $paymentMethod, $reference) {
            // Create Loan Account for tracking
            $loanAccount = $this->accountService->createAccount($application->member, 'loan', 'Loan - ' . $application->loanProduct->name);

            // Generate Loan Number
            $year = date('Y');
            $lastLoan = Loan::where('loan_number', 'like', "L-{$year}-%")->orderBy('id', 'desc')->first();
            $sequence = $lastLoan ? ((int) substr($lastLoan->loan_number, -4)) + 1 : 1;
            $loanNumber = "L-{$year}-" . str_pad($sequence, 4, '0', STR_PAD_LEFT);

            // Create Loan Record
            $loan = Loan::create([
                'loan_number' => $loanNumber,
                'loan_application_id' => $application->id,
                'member_id' => $application->member_id,
                'loan_product_id' => $application->loan_product_id,
                'principal' => $application->amount_requested,
                'interest_rate' => $application->interest_rate_used,
                'period_months' => $application->period_months,
                'monthly_payment' => 0, // Calculated below
                'total_interest' => 0,  // Calculated below
                'total_payable' => 0,   // Calculated below
                'outstanding_balance' => 0, // Calculated below
                'disbursed_at' => now(),
                'disbursed_by' => $disburserId,
                'status' => 'active',
                'account_id' => $loanAccount->id,
            ]);

            $application->update(['status' => 'disbursed']);

            // Calculate Schedules
            $this->calculator->generateRepaymentSchedule($loan, now());

            // Post Journal Entry for Disbursement
            // Debit Loan Account (Asset increase)
            // Credit Operating Account/Bank (Asset decrease)
            // Note: We need a default Operating/Bank account. Assuming ID 1 is Bank for now.
            $bankAccountId = 1; // TO DO: Retrieve from config/settings

            $this->journal->post(
                'loan_disbursement',
                "Disbursement for Loan #{$loan->loan_number}",
                [
                    ['account_id' => $loanAccount->id, 'debit' => $loan->principal, 'credit' => 0, 'description' => 'Loan Principal'],
                    ['account_id' => $bankAccountId, 'debit' => 0, 'credit' => $loan->principal, 'description' => 'Bank Output'],
                ],
                $disburserId
            );

            // TODO: Post processing and insurance fees if > 0

            return $loan;
        });
    }
}
