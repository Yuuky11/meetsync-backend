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
    Schema::create('organizations', function (Blueprint $table) {

        $table->uuid('id')->primary();

        $table->foreignUuid('owner_identity_id')
            ->constrained('identities')
            ->cascadeOnDelete();

        $table->string('name', 150);

        $table->string('slug', 150)->unique();

        $table->text('description')->nullable();

        $table->string('logo_url')->nullable();

        $table->enum('status', [
            'ACTIVE',
            'INACTIVE'
        ])->default('ACTIVE');

        $table->timestamps();

        $table->softDeletes();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
