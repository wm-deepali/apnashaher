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
        Schema::create('institute_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institute_id');
            $table->string('name');
            $table->string('mobile');
            $table->tinyInteger('rating');
            $table->text('review');
            $table->boolean('mobile_verified')->default(false);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('otp')->nullable();
            $table->timestamps();

            $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('cascade');
            $table->unique(['institute_id', 'mobile']); // ensures one review per mobile per institute
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institute_reviews');
    }
};
