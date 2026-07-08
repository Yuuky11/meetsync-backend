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
    Schema::create('attendances', function (Blueprint $table) {

        $table->uuid('id')->primary();

        $table->foreignUuid('meeting_participant_id')
            ->constrained('meeting_participants')
            ->cascadeOnDelete();

        $table->timestamp('check_in_at');

        $table->enum('attendance_status', [
            'PRESENT',
            'LATE',
            'ABSENT'
        ]);

        $table->text('notes')->nullable();

        $table->timestamps();

        $table->softDeletes();

        $table->unique('meeting_participant_id');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
