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
        Schema::create('loan_products', function (Blueprint $table) {
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_products');
    }
};
