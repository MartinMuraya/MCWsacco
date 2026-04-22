<?php

namespace App\Services;

use App\Models\Loan;
use App\Models\LoanRepaymentSchedule;
use Carbon\Carbon;

class LoanCalculatorService
{
    /**
     * Generate repayment schedule for a loan using reducing balance or straight line.
     *
     * @param Loan $loan
     * @param Carbon $startDate
     * @return void
     */
    public function generateRepaymentSchedule(Loan $loan, Carbon $startDate): void
    {
        $loan->repaymentSchedules()->delete(); // Clear existing if regenerating

        $principal = $loan->principal;
        $rate = $loan->interest_rate / 100;
        $months = $loan->period_months;
        $type = $loan->loanProduct->interest_type;

        if ($type === 'straight_line') {
            $this->generateStraightLine($loan, $principal, $rate, $months, $startDate);
        } else {
            $this->generateReducingBalance($loan, $principal, $rate, $months, $startDate);
        }
    }

    private function generateStraightLine(Loan $loan, $principal, $rate, $months, Carbon $startDate)
    {
        $totalInterest = $principal * $rate * ($months / 12);
        $totalPayable = $principal + $totalInterest;
        $monthlyPayment = $totalPayable / $months;
        
        $monthlyPrincipal = $principal / $months;
        $monthlyInterest = $totalInterest / $months;

        $balance = $totalPayable;

        for ($i = 1; $i <= $months; $i++) {
            $dueDate = $startDate->copy()->addMonths($i);
            $balance -= $monthlyPayment;

            LoanRepaymentSchedule::create([
                'loan_id' => $loan->id,
                'installment_number' => $i,
                'due_date' => $dueDate,
                'principal_due' => round($monthlyPrincipal, 2),
                'interest_due' => round($monthlyInterest, 2),
                'total_due' => round($monthlyPayment, 2),
                'balance_after' => round(max(0, $balance), 2),
                'status' => 'pending'
            ]);
        }

        $loan->update([
            'monthly_payment' => round($monthlyPayment, 2),
            'total_interest' => round($totalInterest, 2),
            'total_payable' => round($totalPayable, 2),
            'outstanding_balance' => round($totalPayable, 2),
        ]);
    }

    private function generateReducingBalance(Loan $loan, $principal, $rate, $months, Carbon $startDate)
    {
        // Monthly interest rate
        $monthlyRate = $rate / 12;
        
        // EMI Formula: P * r * (1+r)^n / ((1+r)^n - 1)
        if ($monthlyRate > 0) {
            $emi = $principal * $monthlyRate * pow(1 + $monthlyRate, $months) / (pow(1 + $monthlyRate, $months) - 1);
        } else {
            $emi = $principal / $months;
        }

        $balance = $principal;
        $totalInterest = 0;

        for ($i = 1; $i <= $months; $i++) {
            $dueDate = $startDate->copy()->addMonths($i);
            
            $interestForMonth = $balance * $monthlyRate;
            $principalForMonth = $emi - $interestForMonth;
            
            // Adjust last month for rounding
            if ($i == $months) {
                $principalForMonth = $balance;
                $emi = $principalForMonth + $interestForMonth;
            }

            $balance -= $principalForMonth;
            $totalInterest += $interestForMonth;

            LoanRepaymentSchedule::create([
                'loan_id' => $loan->id,
                'installment_number' => $i,
                'due_date' => $dueDate,
                'principal_due' => round($principalForMonth, 2),
                'interest_due' => round($interestForMonth, 2),
                'total_due' => round($emi, 2),
                'balance_after' => round(max(0, $balance), 2), // This is principal balance
                'status' => 'pending'
            ]);
        }

        $totalPayable = $principal + $totalInterest;

        $loan->update([
            'monthly_payment' => round($emi, 2),
            'total_interest' => round($totalInterest, 2),
            'total_payable' => round($totalPayable, 2),
            'outstanding_balance' => round($totalPayable, 2), // Depends on SACCO policy if outstanding is principal or total
        ]);
    }
}
