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
        Schema::create('institute_timings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institute_id');
            $table->string('day'); // Monday, Tuesday etc
            $table->time('open_time')->nullable();
            $table->time('close_time')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();

            $table->foreign('institute_id')
                  ->references('id')
                  ->on('institutes')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institute_timings');
    }
};
