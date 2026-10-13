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
        Schema::create('counseling_records', function (Blueprint $table) {
            $table->id();

            $table->foreignId('appointment_id')
                ->unique()
                ->constrained('appointments')
                ->restrictOnDelete();

            $table->date('session_date');
            $table->text('notes');
            $table->text('outcome')->nullable();
            $table->date('follow_up_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counseling_records');
    }
};
