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
    Schema::create('identities', function (Blueprint $table) {

        $table->uuid('id')->primary();

        $table->string('full_name',150);

        $table->string('email',150)->unique();

        $table->string('phone',20)->unique();

        $table->string('photo_url')->nullable();

        $table->enum('status',[
            'ACTIVE',
            'INACTIVE',
            'SUSPENDED'
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
        Schema::dropIfExists('identities');
    }
};
