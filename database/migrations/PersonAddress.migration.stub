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
        Schema::create('person_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained(
                table: 'people', indexName: 'address_person_id'
            );
            $table->unsignedMediumInteger('city_id');
                $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->string('house_number',50)->nullable();
            $table->string('street',50)->nullable();
            $table->string('village',100)->nullable();
            $table->string('barangay',100);
            $table->string('zip',10);
            $table->boolean('is_residential_address')->default(true);
            $table->year('year_started')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_addresses');
    }
};
