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
        Schema::create('person_medical_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained(
                table: 'people', indexName: 'med_info_person_id'
            );
            $table->decimal('height',5,2);
            $table->decimal('weight',5,2);
            $table->enum('blood_type', ['A+', 'B+', 'AB+', 'O+','A-', 'B-', 'AB-', 'O-']);
            $table->boolean('is_pwd')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_medical_infos');
    }
};
