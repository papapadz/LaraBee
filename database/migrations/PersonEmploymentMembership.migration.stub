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
        Schema::create('person_employment_memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained(
                table: 'people', indexName: 'person_employment_memberships_person_id'
            );
            $table->foreignId('mandatory_membership_id')->constrained(
                table: 'mandatory_employment_memberships', indexName: 'person_employment_memberships_mandatory_membership_id'
            );
            $table->string('num',50);
            $table->date('start_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_employment_memberships');
    }
};
