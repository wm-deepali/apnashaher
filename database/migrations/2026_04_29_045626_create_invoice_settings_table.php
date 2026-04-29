<?php

// database/migrations/xxxx_xx_xx_create_invoice_settings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('invoice_settings', function (Blueprint $table) {
            $table->id();

            // 🔹 Company Info
            $table->string('company_name');
            $table->string('company_logo')->nullable();
            $table->text('company_address');
            $table->string('company_phone')->nullable();
            $table->string('company_gstin')->nullable();

            // 🔥 NEW (important for GST logic)
            $table->unsignedBigInteger('company_state')->nullable();
            $table->unsignedBigInteger('company_city')->nullable();
            $table->string('company_pincode')->nullable();

            // 🔹 Invoice Settings
            $table->string('invoice_prefix')->default('INV');
            $table->bigInteger('invoice_serial')->default(1);
            $table->boolean('random_invoice')->default(false);
            $table->integer('random_length')->nullable();
            $table->text('terms_conditions')->nullable();

            // 🔹 GST Settings
            $table->decimal('cgst', 5, 2)->default(9);
            $table->decimal('sgst', 5, 2)->default(9);
            $table->decimal('igst', 5, 2)->default(18);
            $table->boolean('gst_enabled')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice_settings');
    }
};