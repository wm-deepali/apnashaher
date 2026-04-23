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
        Schema::create('galleries', function (Blueprint $table) {
             $table->id();
              $table->unsignedBigInteger('institute_id');
            $table->string('image');
            $table->enum('status', ['active','inactive'])->default('active');
            $table->timestamps();
            $table->foreign('institute_id')->references('id')->on('institutes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
