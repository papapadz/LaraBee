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
        Schema::create('payroll_items', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('description',150);
            $table->foreignId('reference')->nullable()->constrained(
                table: 'mandatory_employment_memberships', indexName: 'payroll_items_reference_mandatory_employment_memberships'
            );
            $table->decimal('percentage',3,3)->default(0);
            $table->decimal('amount',8,2)->default(0);
            $table->boolean('is_deduction');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_items');
    }
};
