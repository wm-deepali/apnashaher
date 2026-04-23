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
        Schema::create('institutes', function (Blueprint $table) {
             $table->id();
            $table->string('name');
            $table->string('listing_id')->nullable();
            $table->string('country')->default('India');
            $table->string('state_id');
            $table->string('city_id');
            $table->string('mobile')->unique();
            $table->boolean('mobile_verified')->default(false);
            $table->string('category_id')->nullable();
            $table->string('subcategory_id')->nullable();
            $table->text('description')->nullable();
            $table->string('whatsapp')->nullable();
            $table->boolean('gst_invoice')->default(false);
            $table->string('gstin')->nullable();
            $table->string('business_name')->nullable();
            $table->text('billing_address')->nullable();
            $table->string('invoice_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institutes');
    }
};
