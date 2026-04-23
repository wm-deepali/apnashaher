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
        Schema::create('institute_plans', function (Blueprint $table) {
            $table->id();

            // Reference to the institute
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();

            // Reference to a plan table (if you have a plans master table)
            $table->unsignedBigInteger('plan_id');

            // Plan price (double allows decimals)
            $table->double('price', 10, 2); // 10 digits total, 2 after decimal

            $table->date('start_date')->nullable();
            $table->date('expiry_date')->nullable();

            $table->timestamps();

            $table->foreign('plan_id')->references('id')->on('packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institute_plans');
    }
};
