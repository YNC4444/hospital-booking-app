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
        Schema::table('appointments', function (Blueprint $table) {
            // constrained requires each provider id to be a valid id in the providers table
            // incorrect column order in database: fix was to put constrained() at the end and switch order of date and provider_id
            $table->date('date')->after('patient_id');
            $table->foreignId('provider_id')->after('patient_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['provider_id']);
            $table->dropColumn('provider_id');
            $table->dropColumn('date');
        });
    }
};
