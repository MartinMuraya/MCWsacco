<?php

namespace App\Services;

use App\Models\JournalEntry;
use App\Models\JournalLine;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Str;

class JournalEntryService
{
    /**
     * Post a new journal entry
     *
     * @param string $type
     * @param string $description
     * @param array $lines [['account_id' => X, 'debit' => Y, 'credit' => Z]]
     * @param int|null $userId
     * @return JournalEntry
     * @throws Exception
     */
    public function post(string $type, string $description, array $lines, $userId = null): JournalEntry
    {
        // 1. Validate double entry principle
        $totalDebit = 0;
        $totalCredit = 0;

        foreach ($lines as $line) {
            $totalDebit += (float) ($line['debit'] ?? 0);
            $totalCredit += (float) ($line['credit'] ?? 0);
        }

        // Use precise comparison for floating point numbers
        if (abs($totalDebit - $totalCredit) > 0.0001) {
            throw new Exception("Journal entry unbalanced. Debits: {$totalDebit}, Credits: {$totalCredit}");
        }

        if ($totalDebit <= 0) {
            throw new Exception("Journal entry must have a value greater than zero.");
        }

        return DB::transaction(function () use ($type, $description, $lines, $totalDebit, $userId) {
            // 2. Create the Journal Entry
            $entry = JournalEntry::create([
                'reference_number' => $this->generateReferenceNumber(),
                'entry_type' => $type,
                'description' => $description,
                'total_amount' => $totalDebit,
                'status' => 'posted',
                'posted_by' => $userId,
                'posted_at' => now(),
            ]);

            // 3. Process Lines and Update Account Balances
            foreach ($lines as $line) {
                $debit = (float) ($line['debit'] ?? 0);
                $credit = (float) ($line['credit'] ?? 0);
                
                if ($debit == 0 && $credit == 0) continue;

                $account = Account::findOrFail($line['account_id']);

                JournalLine::create([
                    'journal_entry_id' => $entry->id,
                    'account_id' => $account->id,
                    'debit' => $debit,
                    'credit' => $credit,
                    'description' => $line['description'] ?? null,
                ]);

                // 4. Update Account Balance
                // Normal balance rules:
                // Assets & Expenses increase with Debit
                // Liabilities, Equity & Income increase with Credit
                // To keep it simple, we use a single balance column. 
                // Savings/Shares (Liability/Equity) -> Credit increases balance, Debit decreases.
                // Loans (Asset) -> Debit increases loan balance, Credit decreases loan balance.
                
                if ($account->account_type === 'loan') {
                    // For loans: Debit increases what they owe, Credit decreases what they owe.
                    $account->balance = $account->balance + $debit - $credit;
                } else {
                    // For savings/shares (Liability to SACCO): Credit increases balance, Debit decreases.
                    $account->balance = $account->balance + $credit - $debit;
                }
                
                $account->save();
            }

            return $entry;
        });
    }

    private function generateReferenceNumber(): string
    {
        $prefix = 'JRN-' . date('Ymd') . '-';
        $lastEntry = JournalEntry::where('reference_number', 'like', $prefix . '%')->orderBy('id', 'desc')->first();
        
        if (!$lastEntry) {
            return $prefix . '0001';
        }
        
        $lastSequence = (int) substr($lastEntry->reference_number, -4);
        return $prefix . str_pad($lastSequence + 1, 4, '0', STR_PAD_LEFT);
    }
}
