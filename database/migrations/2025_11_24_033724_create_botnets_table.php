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
        Schema::create('botnets', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->string('botnet_name')->nullable();
            $table->timestamp('last_seen_at')->nullable();
            $table->string('status')->nullable();
            $table->string('country')->nullable();
            $table->string('asn')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('botnets');
    }
};
