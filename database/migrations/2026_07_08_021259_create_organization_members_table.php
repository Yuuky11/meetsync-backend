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
    Schema::create('organization_members', function (Blueprint $table) {

        $table->uuid('id')->primary();

        $table->foreignUuid('organization_id')
            ->constrained('organizations')
            ->cascadeOnDelete();

        $table->foreignUuid('identity_id')
            ->constrained('identities')
            ->cascadeOnDelete();

        $table->enum('role', [
            'OWNER',
            'ADMIN',
            'MEMBER'
        ])->default('MEMBER');

        $table->timestamps();

        $table->softDeletes();

        $table->unique([
            'organization_id',
            'identity_id'
        ]);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_members');
    }
};
