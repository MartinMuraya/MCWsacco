<?php
$files = glob(__DIR__ . '/database/migrations/*_create_*.php');
$schemas = [
    'users' => <<<'PHP'
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('member_number')->unique()->nullable();
            $table->string('national_id')->unique()->nullable();
            $table->string('profile_photo_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
PHP,
    'members' => <<<'PHP'
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('member_number')->unique();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('county')->nullable();
            $table->string('sub_county')->nullable();
            $table->string('village')->nullable();
            $table->string('next_of_kin_name')->nullable();
            $table->string('next_of_kin_phone')->nullable();
            $table->string('next_of_kin_relationship')->nullable();
            $table->string('occupation')->nullable();
            $table->string('employer')->nullable();
            $table->decimal('monthly_income', 10, 2)->nullable();
            $table->enum('status', ['pending', 'active', 'suspended', 'deceased'])->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->boolean('registration_fee_paid')->default(false);
            $table->date('registration_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
PHP,
    'accounts' => <<<'PHP'
            $table->id();
            $table->string('account_number')->unique();
            $table->enum('account_type', ['savings', 'loan', 'share_capital', 'penalty', 'interest', 'operating']);
            $table->foreignId('member_id')->nullable()->constrained('members')->cascadeOnDelete();
            $table->string('name');
            $table->decimal('balance', 15, 4)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
PHP,
    'journal_entries' => <<<'PHP'
            $table->id();
            $table->string('reference_number')->unique();
            $table->enum('entry_type', ['contribution', 'loan_disbursement', 'repayment', 'penalty', 'adjustment', 'fee']);
            $table->string('description');
            $table->decimal('total_amount', 15, 4);
            $table->enum('status', ['draft', 'posted', 'reversed'])->default('draft');
            $table->foreignId('posted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('posted_at')->nullable();
            $table->foreignId('reversed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reversed_at')->nullable();
            $table->string('reversal_reason')->nullable();
            $table->timestamps();
PHP,
    'journal_lines' => <<<'PHP'
            $table->id();
            $table->foreignId('journal_entry_id')->constrained('journal_entries')->cascadeOnDelete();
            $table->foreignId('account_id')->constrained('accounts')->cascadeOnDelete();
            $table->decimal('debit', 15, 4)->default(0);
            $table->decimal('credit', 15, 4)->default(0);
            $table->string('description')->nullable();
            $table->timestamps();
PHP,
    'transactions' => <<<'PHP'
            $table->id();
            $table->string('transaction_code')->unique();
            $table->foreignId('member_id')->constrained('members')->cascadeOnDelete();
            $table->foreignId('account_id')->constrained('accounts')->cascadeOnDelete();
            $table->foreignId('journal_entry_id')->constrained('journal_entries')->cascadeOnDelete();
            $table->enum('transaction_type', ['debit', 'credit']);
            $table->decimal('amount', 15, 4);
            $table->decimal('balance_before', 15, 4);
            $table->decimal('balance_after', 15, 4);
            $table->string('description')->nullable();
            $table->enum('payment_method', ['cash', 'mpesa', 'bank_transfer', 'cheque'])->nullable();
            $table->string('reference')->nullable();
            $table->foreignId('recorded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
PHP,
    'contributions' => <<<'PHP'
            $table->id();
            $table->foreignId('member_id')->constrained('members')->cascadeOnDelete();
            $table->integer('period_month');
            $table->integer('period_year');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['cash', 'mpesa', 'bank_transfer', 'cheque'])->nullable();
            $table->string('reference')->nullable();
            $table->foreignId('recorded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('journal_entry_id')->nullable()->constrained('journal_entries')->nullOnDelete();
            $table->enum('status', ['pending', 'confirmed'])->default('pending');
            $table->timestamps();
PHP,
    'share_capitals' => <<<'PHP'
            $table->id();
            $table->foreignId('member_id')->constrained('members')->cascadeOnDelete();
            $table->integer('shares_count');
            $table->decimal('amount_per_share', 10, 2);
            $table->decimal('total_value', 10, 2);
            $table->foreignId('recorded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
PHP,
    'loan_products' => <<<'PHP'
            $table->id();
            $table->string('name');
            $table->enum('interest_type', ['reducing_balance', 'straight_line']);
            $table->decimal('interest_rate', 5, 2);
            $table->decimal('min_amount', 12, 2)->default(0);
            $table->decimal('max_amount', 12, 2);
            $table->integer('min_period_months')->default(1);
            $table->integer('max_period_months');
            $table->decimal('processing_fee_percent', 5, 2)->default(0);
            $table->decimal('insurance_fee_percent', 5, 2)->default(0);
            $table->boolean('requires_guarantors')->default(true);
            $table->integer('max_guarantors')->default(3);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
PHP,
    'loan_applications' => <<<'PHP'
            $table->id();
            $table->string('application_number')->unique();
            $table->foreignId('member_id')->constrained('members')->cascadeOnDelete();
            $table->foreignId('loan_product_id')->constrained('loan_products')->cascadeOnDelete();
            $table->decimal('amount_requested', 12, 2);
            $table->integer('period_months');
            $table->string('purpose')->nullable();
            $table->enum('interest_type', ['reducing_balance', 'straight_line']);
            $table->decimal('interest_rate_used', 5, 2);
            $table->decimal('processing_fee', 10, 2)->default(0);
            $table->decimal('insurance_fee', 10, 2)->default(0);
            $table->enum('status', ['draft', 'pending_physical_verification', 'under_review', 'approved', 'rejected', 'disbursed', 'closed', 'defaulted'])->default('draft');
            $table->timestamp('submitted_at')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->text('review_notes')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->string('pdf_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
PHP,
    'loan_guarantors' => <<<'PHP'
            $table->id();
            $table->foreignId('loan_application_id')->constrained('loan_applications')->cascadeOnDelete();
            $table->foreignId('guarantor_member_id')->constrained('members')->cascadeOnDelete();
            $table->enum('status', ['pending', 'accepted', 'declined'])->default('pending');
            $table->string('guarantor_signature_path')->nullable();
            $table->timestamp('agreed_at')->nullable();
            $table->timestamps();
PHP,
    'loans' => <<<'PHP'
            $table->id();
            $table->string('loan_number')->unique();
            $table->foreignId('loan_application_id')->constrained('loan_applications')->cascadeOnDelete();
            $table->foreignId('member_id')->constrained('members')->cascadeOnDelete();
            $table->foreignId('loan_product_id')->constrained('loan_products')->cascadeOnDelete();
            $table->decimal('principal', 12, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->integer('period_months');
            $table->decimal('monthly_payment', 12, 2);
            $table->decimal('total_interest', 12, 2);
            $table->decimal('total_payable', 12, 2);
            $table->decimal('outstanding_balance', 12, 2);
            $table->timestamp('disbursed_at')->nullable();
            $table->foreignId('disbursed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status', ['active', 'closed', 'defaulted', 'written_off'])->default('active');
            $table->foreignId('account_id')->nullable()->constrained('accounts')->nullOnDelete();
            $table->timestamps();
PHP,
    'loan_repayment_schedules' => <<<'PHP'
            $table->id();
            $table->foreignId('loan_id')->constrained('loans')->cascadeOnDelete();
            $table->integer('installment_number');
            $table->date('due_date');
            $table->decimal('principal_due', 12, 2);
            $table->decimal('interest_due', 12, 2);
            $table->decimal('total_due', 12, 2);
            $table->decimal('principal_paid', 12, 2)->default(0);
            $table->decimal('interest_paid', 12, 2)->default(0);
            $table->decimal('total_paid', 12, 2)->default(0);
            $table->decimal('balance_after', 12, 2);
            $table->enum('status', ['pending', 'partial', 'paid', 'overdue'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
PHP,
    'loan_repayments' => <<<'PHP'
            $table->id();
            $table->foreignId('loan_id')->constrained('loans')->cascadeOnDelete();
            $table->foreignId('repayment_schedule_id')->nullable()->constrained('loan_repayment_schedules')->nullOnDelete();
            $table->decimal('amount', 12, 2);
            $table->enum('payment_method', ['cash', 'mpesa', 'bank_transfer', 'cheque'])->nullable();
            $table->string('reference')->nullable();
            $table->foreignId('recorded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('journal_entry_id')->nullable()->constrained('journal_entries')->nullOnDelete();
            $table->timestamps();
PHP,
    'loan_penalties' => <<<'PHP'
            $table->id();
            $table->foreignId('loan_id')->constrained('loans')->cascadeOnDelete();
            $table->foreignId('repayment_schedule_id')->constrained('loan_repayment_schedules')->cascadeOnDelete();
            $table->decimal('penalty_amount', 10, 2);
            $table->string('reason')->nullable();
            $table->boolean('waived')->default(false);
            $table->foreignId('waived_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
PHP,
    'hostels' => <<<'PHP'
            $table->id();
            $table->string('name');
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->string('contact_phone')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
PHP,
    'rooms' => <<<'PHP'
            $table->id();
            $table->foreignId('hostel_id')->constrained('hostels')->cascadeOnDelete();
            $table->string('room_number');
            $table->enum('room_type', ['single', 'double', 'triple', 'self_contained']);
            $table->string('floor')->nullable();
            $table->integer('capacity');
            $table->decimal('price_per_semester', 10, 2);
            $table->json('amenities')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
PHP,
    'hostel_bookings' => <<<'PHP'
            $table->id();
            $table->string('booking_reference')->unique();
            $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();
            $table->string('student_name');
            $table->string('student_phone');
            $table->string('student_email')->nullable();
            $table->string('student_id_number')->nullable();
            $table->string('university_registration_number')->nullable();
            $table->string('intake_period');
            $table->string('academic_year');
            $table->date('check_in_date')->nullable();
            $table->date('check_out_date')->nullable();
            $table->enum('status', ['waitlisted', 'reserved', 'confirmed', 'cancelled', 'checked_in', 'checked_out'])->default('reserved');
            $table->enum('payment_status', ['unpaid', 'partial', 'paid'])->default('unpaid');
            $table->decimal('amount_due', 10, 2);
            $table->decimal('amount_paid', 10, 2)->default(0);
            $table->string('payment_reference')->nullable();
            $table->foreignId('confirmed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
PHP,
    'hostel_waitlists' => <<<'PHP'
            $table->id();
            $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();
            $table->string('student_name');
            $table->string('student_phone');
            $table->string('student_email')->nullable();
            $table->string('intake_period');
            $table->integer('position')->default(0);
            $table->boolean('notified')->default(false);
            $table->timestamps();
PHP,
    'university_intakes' => <<<'PHP'
            $table->id();
            $table->string('university_name');
            $table->string('intake_label');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
PHP,
    'hostel_images' => <<<'PHP'
            $table->id();
            $table->foreignId('hostel_id')->constrained('hostels')->cascadeOnDelete();
            $table->string('image_path');
            $table->string('caption')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_cover')->default(false);
            $table->timestamps();
PHP,
    'room_images' => <<<'PHP'
            $table->id();
            $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();
            $table->string('image_path');
            $table->string('caption')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_cover')->default(false);
            $table->timestamps();
PHP,
    'member_documents' => <<<'PHP'
            $table->id();
            $table->foreignId('member_id')->constrained('members')->cascadeOnDelete();
            $table->enum('document_type', ['national_id', 'passport_photo', 'next_of_kin_id', 'guarantor_id', 'other']);
            $table->string('file_path');
            $table->string('file_name')->nullable();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
PHP,
    'ad_banners' => <<<'PHP'
            $table->id();
            $table->string('title');
            $table->string('image_path');
            $table->string('link_url')->nullable();
            $table->enum('target_audience', ['all', 'students', 'members'])->default('all');
            $table->boolean('is_active')->default(true);
            $table->timestamp('display_start')->nullable();
            $table->timestamp('display_end')->nullable();
            $table->integer('priority')->default(0);
            $table->timestamps();
PHP,
    'announcements' => <<<'PHP'
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->enum('type', ['general', 'loan', 'hostel', 'urgent'])->default('general');
            $table->string('target_role')->nullable();
            $table->boolean('is_published')->default(false);
            $table->foreignId('published_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
PHP,
    'sms_logs' => <<<'PHP'
            $table->id();
            $table->string('recipient_phone');
            $table->text('message_body');
            $table->enum('status', ['queued', 'sent', 'failed'])->default('queued');
            $table->json('provider_response')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
PHP,
    'audit_logs' => <<<'PHP'
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action');
            $table->string('model_type')->nullable();
            $table->string('model_id')->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
PHP,
];

foreach ($files as $file) {
    if (strpos($file, '0001_01_01_000001') !== false || strpos($file, '0001_01_01_000002') !== false || strpos($file, 'create_permission_tables') !== false) {
        continue;
    }

    preg_match('/create_(.*)_table/', $file, $matches);
    if (!isset($matches[1])) continue;
    $table = $matches[1];
    
    if (isset($schemas[$table])) {
        $content = file_get_contents($file);
        
        // Match the Schema::create block up to the closing brackets.
        // We capture group 1 (the start), and group 3 (the end).
        $content = preg_replace('/(Schema::create\([\'"]' . preg_quote($table) . '[\'"],\s*function\s*\(Blueprint\s*\$table\)\s*\{)([\s\S]*?)(\}\);)/', "$1\n" . $schemas[$table] . "\n        $3", $content);
        
        file_put_contents($file, $content);
        echo "Updated $table migration\n";
    }
}
