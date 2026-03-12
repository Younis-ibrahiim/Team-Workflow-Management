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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            $table->enum('role', ['admin', 'manager', 'member'])->default('member');
            $table->string('token', 64)->unique();// Unique token for the registration link
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
            // Indexing for performance during the "Accept" lookup
            $table->index(['email', 'token']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
