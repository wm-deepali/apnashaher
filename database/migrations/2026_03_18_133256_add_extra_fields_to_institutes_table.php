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
        Schema::table('institutes', function (Blueprint $table) {
            $table->string('registration_number')->nullable()->after('registration_complete');
            $table->string('zipcode')->nullable()->after('registration_number');
            $table->string('logo')->nullable()->after('zipcode');
            $table->string('linkedin_url')->nullable()->after('logo');
            $table->string('google_url')->nullable()->after('linkedin_url');
            $table->integer('rating')->default(0)->after('google_url');
            $table->integer('views')->default(0)->after('rating');
            $table->bigInteger('total_clicks')->default(0)->after('views');
            $table->bigInteger('total_calls')->default(0)->after('total_clicks');
            $table->bigInteger('whatsApp_connect')->default(0)->after('total_calls');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('institutes', function (Blueprint $table) {
            //
        });
    }
};
