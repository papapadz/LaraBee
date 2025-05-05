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
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('business_name',100);
            $table->string('business_description',255)->nullable();
            $table->unsignedMediumInteger('city_id');
                $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->string('business_classification',255)->nullable();
            $table->enum('business_scope',['National','Regional','City/Municipality','Barangay'])->nullable();
            $table->foreignId('business_type_id')->constrained(
                table: 'business_types', indexName: 'company_profile_business_type_id'
            );
            $table->string('street',20)->nullable();
            $table->string('building_number',20)->nullable();
            $table->string('barangay',50)->nullable();
            $table->string('zip',10)->nullable();
            $table->date('date_started')->nullable();
            $table->date('date_ended')->nullable();
            $table->boolean('is_government')->default(false);
            $table->unsignedBigInteger('created_by')->nullable();
                $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
    }
};
