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
            $table->string('owner_name')->nullable()->after('mobile_verified');
            $table->string('designation')->nullable()->after('owner_name');
            $table->string('owner_email')->nullable()->unique()->after('designation');
            $table->string('established_year')->nullable()->after('owner_email');
            $table->longText('detailed_information')->nullable()->after('established_year');
            $table->string('website')->nullable()->after('detailed_information');
            $table->string('facebook_url')->nullable()->after('website');
            $table->string('instagram_url')->nullable()->after('facebook_url');
            $table->string('youtube_url')->nullable()->after('instagram_url');
            $table->string('twitter_url')->nullable()->after('youtube_url');
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
