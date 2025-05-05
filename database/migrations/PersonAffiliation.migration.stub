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
        Schema::create('person_affiliations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained(
                table: 'people', indexName: 'person_affiliation_person_id'
            );
            $table->foreignId('company_area_id')->constrained(
                table: 'company_areas', indexName: 'person_affiliation_company_area_id'
            );
            $table->foreignId('position_id')->constrained(
                table: 'positions', indexName: 'person_affiliation_position_id'
            );
            $table->enum('affiliation_level',['Rank and File','Supervisory','Managerial','Executive']);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->foreignId('affiliation_status')->constrained(
                table: 'employment_statuses', indexName: 'person_affiliation_affiliation_status_id'
            );
            $table->string('employee_id',20);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_affiliations');
    }
};
