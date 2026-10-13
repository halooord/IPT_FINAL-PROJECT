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
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('counseling_record_id')
                ->constrained('counseling_records')
                ->restrictOnDelete();

            $table->string('referral_type');
            $table->string('destination');
            $table->text('reason');
            $table->string('status')->default('pending');
            $table->date('referral_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
