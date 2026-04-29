<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            // relations
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('institute_id');

            // invoice info
            $table->string('invoice_number')->unique();
            $table->string('invoice_type'); // Tax Invoice / Sale Invoice

            // company snapshot
            $table->string('company_name');
            $table->text('company_address');
            $table->string('company_gstin')->nullable();
            
            // customer snapshot
            $table->string('customer_name')->nullable();
            $table->text('billing_address')->nullable();
            $table->string('customer_gstin')->nullable();
            $table->string('billing_email')->nullable();

            // pricing
            $table->decimal('base_amount', 10, 2);
            $table->decimal('cgst', 10, 2)->default(0);
            $table->decimal('sgst', 10, 2)->default(0);
            $table->decimal('igst', 10, 2)->default(0);
            $table->decimal('total', 10, 2);

            // meta
            $table->text('terms_conditions')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invocies');
    }
};
