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
    Schema::create('sessions', function (Blueprint $table) {

        $table->uuid('id')->primary();

        $table->foreignUuid('identity_id')
            ->constrained('identities')
            ->cascadeOnDelete();

        $table->foreignUuid('device_id')
            ->constrained('devices')
            ->cascadeOnDelete();

        $table->timestamp('expires_at');

        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
