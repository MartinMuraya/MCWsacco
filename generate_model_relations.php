<?php
$modelsPath = __DIR__ . '/app/Models/';

$relations = [
    'User' => [
        'public function member() { return $this->hasOne(Member::class); }',
        'public function auditLogs() { return $this->hasMany(AuditLog::class); }'
    ],
    'Member' => [
        'public function user() { return $this->belongsTo(User::class); }',
        'public function accounts() { return $this->hasMany(Account::class); }',
        'public function contributions() { return $this->hasMany(Contribution::class); }',
        'public function loanApplications() { return $this->hasMany(LoanApplication::class); }',
        'public function loans() { return $this->hasMany(Loan::class); }',
        'public function guarantees() { return $this->hasMany(LoanGuarantor::class, \'guarantor_member_id\'); }',
        'public function shareCapitals() { return $this->hasMany(ShareCapital::class); }',
        'public function documents() { return $this->hasMany(MemberDocument::class); }'
    ],
    'Account' => [
        'public function member() { return $this->belongsTo(Member::class); }',
        'public function transactions() { return $this->hasMany(Transaction::class); }',
        'public function journalLines() { return $this->hasMany(JournalLine::class); }'
    ],
    'JournalEntry' => [
        'public function lines() { return $this->hasMany(JournalLine::class); }',
        'public function transactions() { return $this->hasMany(Transaction::class); }',
        'public function contributions() { return $this->hasMany(Contribution::class); }',
        'public function loanRepayments() { return $this->hasMany(LoanRepayment::class); }',
        'public function postedBy() { return $this->belongsTo(User::class, \'posted_by\'); }',
        'public function reversedBy() { return $this->belongsTo(User::class, \'reversed_by\'); }'
    ],
    'JournalLine' => [
        'public function journalEntry() { return $this->belongsTo(JournalEntry::class); }',
        'public function account() { return $this->belongsTo(Account::class); }'
    ],
    'Transaction' => [
        'public function member() { return $this->belongsTo(Member::class); }',
        'public function account() { return $this->belongsTo(Account::class); }',
        'public function journalEntry() { return $this->belongsTo(JournalEntry::class); }',
        'public function recordedBy() { return $this->belongsTo(User::class, \'recorded_by\'); }'
    ],
    'Contribution' => [
        'public function member() { return $this->belongsTo(Member::class); }',
        'public function journalEntry() { return $this->belongsTo(JournalEntry::class); }',
        'public function recordedBy() { return $this->belongsTo(User::class, \'recorded_by\'); }'
    ],
    'ShareCapital' => [
        'public function member() { return $this->belongsTo(Member::class); }',
        'public function recordedBy() { return $this->belongsTo(User::class, \'recorded_by\'); }'
    ],
    'LoanProduct' => [
        'public function applications() { return $this->hasMany(LoanApplication::class); }',
        'public function loans() { return $this->hasMany(Loan::class); }'
    ],
    'LoanApplication' => [
        'public function member() { return $this->belongsTo(Member::class); }',
        'public function loanProduct() { return $this->belongsTo(LoanProduct::class); }',
        'public function guarantors() { return $this->hasMany(LoanGuarantor::class); }',
        'public function loan() { return $this->hasOne(Loan::class); }',
        'public function reviewedBy() { return $this->belongsTo(User::class, \'reviewed_by\'); }',
        'public function approvedBy() { return $this->belongsTo(User::class, \'approved_by\'); }'
    ],
    'LoanGuarantor' => [
        'public function loanApplication() { return $this->belongsTo(LoanApplication::class); }',
        'public function member() { return $this->belongsTo(Member::class, \'guarantor_member_id\'); }'
    ],
    'Loan' => [
        'public function application() { return $this->belongsTo(LoanApplication::class, \'loan_application_id\'); }',
        'public function member() { return $this->belongsTo(Member::class); }',
        'public function loanProduct() { return $this->belongsTo(LoanProduct::class); }',
        'public function repaymentSchedules() { return $this->hasMany(LoanRepaymentSchedule::class); }',
        'public function repayments() { return $this->hasMany(LoanRepayment::class); }',
        'public function penalties() { return $this->hasMany(LoanPenalty::class); }',
        'public function account() { return $this->belongsTo(Account::class); }',
        'public function disbursedBy() { return $this->belongsTo(User::class, \'disbursed_by\'); }'
    ],
    'LoanRepaymentSchedule' => [
        'public function loan() { return $this->belongsTo(Loan::class); }',
        'public function repayments() { return $this->hasMany(LoanRepayment::class, \'repayment_schedule_id\'); }',
        'public function penalties() { return $this->hasMany(LoanPenalty::class, \'repayment_schedule_id\'); }'
    ],
    'LoanRepayment' => [
        'public function loan() { return $this->belongsTo(Loan::class); }',
        'public function schedule() { return $this->belongsTo(LoanRepaymentSchedule::class, \'repayment_schedule_id\'); }',
        'public function journalEntry() { return $this->belongsTo(JournalEntry::class); }',
        'public function recordedBy() { return $this->belongsTo(User::class, \'recorded_by\'); }'
    ],
    'LoanPenalty' => [
        'public function loan() { return $this->belongsTo(Loan::class); }',
        'public function schedule() { return $this->belongsTo(LoanRepaymentSchedule::class, \'repayment_schedule_id\'); }',
        'public function waivedBy() { return $this->belongsTo(User::class, \'waived_by\'); }'
    ],
    'Hostel' => [
        'public function rooms() { return $this->hasMany(Room::class); }',
        'public function images() { return $this->hasMany(HostelImage::class); }'
    ],
    'Room' => [
        'public function hostel() { return $this->belongsTo(Hostel::class); }',
        'public function bookings() { return $this->hasMany(HostelBooking::class); }',
        'public function waitlists() { return $this->hasMany(HostelWaitlist::class); }',
        'public function images() { return $this->hasMany(RoomImage::class); }'
    ],
    'HostelBooking' => [
        'public function room() { return $this->belongsTo(Room::class); }',
        'public function confirmedBy() { return $this->belongsTo(User::class, \'confirmed_by\'); }'
    ],
    'HostelWaitlist' => [
        'public function room() { return $this->belongsTo(Room::class); }'
    ],
    'HostelImage' => [
        'public function hostel() { return $this->belongsTo(Hostel::class); }'
    ],
    'RoomImage' => [
        'public function room() { return $this->belongsTo(Room::class); }'
    ],
    'MemberDocument' => [
        'public function member() { return $this->belongsTo(Member::class); }',
        'public function uploadedBy() { return $this->belongsTo(User::class, \'uploaded_by\'); }'
    ],
    'Announcement' => [
        'public function publishedBy() { return $this->belongsTo(User::class, \'published_by\'); }'
    ],
    'SmsLog' => [
        'public function createdBy() { return $this->belongsTo(User::class, \'created_by\'); }'
    ],
    'AuditLog' => [
        'public function user() { return $this->belongsTo(User::class); }'
    ]
];

foreach ($relations as $modelName => $methods) {
    $file = $modelsPath . $modelName . '.php';
    if (!file_exists($file)) {
        echo "Warning: Model $modelName not found.\n";
        continue;
    }

    $content = file_get_contents($file);
    
    if (strpos($content, 'public function ' . strtok($methods[0], '(')) !== false) {
        echo "Skipping $modelName (already has methods).\n";
        continue;
    }

    $methodsString = "";
    foreach ($methods as $method) {
        $methodsString .= "    " . $method . "\n\n";
    }

    $content = preg_replace('/\}\s*$/', "\n" . $methodsString . "}", $content);
    
    if (in_array($modelName, ['User', 'Member', 'LoanApplication'])) {
        if (strpos($content, 'use Illuminate\Database\Eloquent\SoftDeletes;') === false) {
            $content = preg_replace('/(use Illuminate\\\\Database\\\\Eloquent\\\\Model;)/', "$1\nuse Illuminate\\Database\\Eloquent\\SoftDeletes;", $content);
            $content = preg_replace('/(use HasFactory;)/', "use HasFactory, SoftDeletes;", $content);
        }
    }

    file_put_contents($file, $content);
    echo "Added relations to $modelName\n";
}
echo "Done.";
