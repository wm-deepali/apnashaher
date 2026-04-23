<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_openings', function (Blueprint $table) {

            $table->id();

            $table->string('job_title');

            $table->string('slug')->unique();

            $table->enum('employment_type',['part_time','full_time','freelancing']);

            $table->string('job_location')->nullable();


            // Salary Fields

            $table->enum('salary_type',['fixed','range'])->default('fixed');

            $table->decimal('salary_fixed',10,2)->nullable();

            $table->decimal('salary_from',10,2)->nullable();

            $table->decimal('salary_to',10,2)->nullable();

            $table->enum('salary_duration',['per_month','per_year'])->default('per_month');


            $table->text('overview')->nullable();

            $table->longText('job_description')->nullable();

            $table->longText('eligibility_criteria')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_openings');
    }
};