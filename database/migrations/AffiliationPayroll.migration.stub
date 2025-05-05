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
        Schema::create('affiliation_payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('affiliation_id')->constrained(
                table: 'person_affiliations', indexName: 'affiliation_payrolls_affiliation_id'
            );
            $table->foreignId('payroll_item_id')->constrained(
                table: 'payroll_items', indexName: 'affiliation_payrolls_payroll_item_id'
            );
            $table->decimal('amount',8,2);
            $table->foreignId('payroll_generations_id')->constrained(
                table: 'payroll_generations', indexName: 'affiliation_payrolls_payroll_generations_id'
            );
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliation_payrolls');
    }
};
