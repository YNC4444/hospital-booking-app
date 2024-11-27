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
            // Drop the foreign key constraint
            $table->dropForeign(['patient_id']);

            // Make the patient_id column nullable
            $table->unsignedBigInteger('patient_id')->nullable()->change();

            // Add the foreign key constraint back
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['patient_id']);

            // Make the patient_id column not nullable
            $table->unsignedBigInteger('patient_id')->nullable(false)->change();

            // Add the foreign key constraint back
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
    }
};
