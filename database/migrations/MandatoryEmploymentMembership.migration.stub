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
        Schema::create('mandatory_employment_memberships', function (Blueprint $table) {
            $table->id();
            $table->string('membership_name',100);
            $table->string('membership_slug',10);
            $table->string('description',150);
            $table->unsignedMediumInteger('country_id');
                $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mandatory_employment_memberships');
    }
};
