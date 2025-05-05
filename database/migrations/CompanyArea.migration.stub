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
        Schema::create('company_areas', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('description',150)->nullable();
            $table->foreignId('company_id')->constrained(
                table: 'company_profiles', indexName: 'company_areas_company_id'
            );
            $table->foreignId('headed_by')->constrained(
                table: 'people', indexName: 'company_areas_headed_by'
            )->nullable();
            $table->unsignedMediumInteger('city_id')->nullable();
                $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_areas');
    }
};
