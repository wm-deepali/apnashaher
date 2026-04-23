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
        Schema::create('package_features', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('package_id');

            $table->boolean('apnashaher_listing')->default(0);

            $table->enum('search_visibility',[
                'limited',
                'improved',
                'top'
            ])->default('limited');

            $table->enum('contact_display',[
                'basic',
                'full'
            ])->default('basic');

            $table->boolean('call_whatsapp_button')->default(0);

            $table->enum('profile_editing',[
                'basic',
                'advance'
            ])->default('basic');

            $table->boolean('verified_badge')->default(0);

            $table->boolean('custom_profile_url')->default(0);

            $table->enum('support_type',[
                'Email Support Only',
                'Call & WhatsApp Support',
                'Priority Support (Call, WhatsApp & Email)'
            ])->default('Email Support Only');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_features');
    }
};
