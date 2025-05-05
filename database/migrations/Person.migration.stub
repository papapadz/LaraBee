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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('middle_name',100)->nullable();
            $table->string('name_extension',10)->nullable();
            $table->date('birth_date');
            $table->string('birth_place',100);
            $table->enum('civil_status',['Single','Married','Widowed','Separated'])->default('Single');
            $table->enum('gender',['Male','Female']);
            $table->unsignedMediumInteger('citizenship_id');
                $table->foreign('citizenship_id')->references('id')->on('countries')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
