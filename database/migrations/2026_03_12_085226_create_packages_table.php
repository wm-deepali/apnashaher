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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('title')->nullable();

            $table->decimal('mrp',10,2)->nullable();
            $table->enum('discount_type',['flat','percentage'])->nullable();
            $table->decimal('discount_value',10,2)->nullable();
            $table->decimal('offered_price',10,2)->nullable();

            $table->boolean('is_popular')->default(0);

            $table->integer('validity_days')->default(30);

            $table->unsignedBigInteger('include_package_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
