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
        Schema::table('package_features', function (Blueprint $table) {
            $table->string('courses_programs')->nullable()->after('support_type');
            $table->boolean('profile_performance_insight')->default(0)->after('courses_programs');
            $table->boolean('featured_in_category_listings')->default(0)->after('profile_performance_insight');
            $table->boolean('promotional_banner_placement')->default(0)->after('featured_in_category_listings');
            $table->boolean('preferred_institute_badge')->default(0)->after('promotional_banner_placement');
            $table->boolean(' ai_profile_description_generator')->default(0)->after('preferred_institute_badge');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('package_features', function (Blueprint $table) {
            //
        });
    }
};
