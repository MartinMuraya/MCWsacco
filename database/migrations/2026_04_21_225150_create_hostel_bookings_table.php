<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hostel_bookings', function (Blueprint $table) {
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hostel_bookings');
    }
};
