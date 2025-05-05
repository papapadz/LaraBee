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
        Schema::create('person_certifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained(
                table: 'people', indexName: 'person_certification_person_id'
            );
            $table->foreignId('certification_id')->constrained(
                table: 'professional_certifications', indexName: 'person_certification_certification_id'
            );
            $table->string('license_no',20)->nullable();
            $table->decimal('rating',5,2)->nullable();
            $table->unsignedMediumInteger('city_id');
                $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->date('conferment_date');
            $table->date('expiry_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_certifications');
    }
};
