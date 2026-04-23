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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique(); // for URL like /lucknow
            $table->boolean('is_registered')->default(true); // show on registration
            $table->boolean('is_popular')->default(false);   // popular listing
            $table->boolean('is_launching')->default(false); // show in homepage dropdown
            $table->string('image')->nullable();            // for popular cities
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
