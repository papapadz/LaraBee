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
        Schema::create('person_education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained(
                table: 'people', indexName: 'person_education_person_id'
            );
            $table->foreignId('education_type_id')->constrained(
                table: 'education_types', indexName: 'person_education_type_id'
            );
            $table->string('school_name',100);
            $table->string('course_name',100)->nullable();
            $table->unsignedMediumInteger('city_id');
                $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->year('year_started');
            $table->year('year_ended')->nullable();
            $table->string('units_earned',20)->nullable();
            $table->string('academic_awards',50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_education');
    }
};
