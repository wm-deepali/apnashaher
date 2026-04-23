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
        Schema::create('institute_course_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on('packages')->onDelete('cascade');
            $table->string('name');
            $table->longText('detailed_information')->nullable();
            $table->string('duration')->nullable();
            $table->enum('mode',['Online','Offline','Both (Hybrid)']);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institute_course_programs');
    }
};
