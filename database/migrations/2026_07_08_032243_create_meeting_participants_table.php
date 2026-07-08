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
    Schema::create('meeting_participants', function (Blueprint $table) {

        $table->uuid('id')->primary();

        $table->foreignUuid('meeting_id')
            ->constrained('meetings')
            ->cascadeOnDelete();

        $table->foreignUuid('identity_id')
            ->constrained('identities')
            ->cascadeOnDelete();

        $table->enum('role', [
            'HOST',
            'MODERATOR',
            'PARTICIPANT'
        ])->default('PARTICIPANT');

        $table->enum('invitation_status', [
            'INVITED',
            'ACCEPTED',
            'DECLINED'
        ])->default('INVITED');

        $table->timestamps();

        $table->softDeletes();

        $table->unique([
            'meeting_id',
            'identity_id'
        ]);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_participants');
    }
};
