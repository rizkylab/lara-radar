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
        Schema::create('subdomains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domain_id')->constrained()->cascadeOnDelete();
            $table->string('subdomain');
            $table->string('ip_address')->nullable();
            $table->integer('status_code')->nullable();
            $table->string('title')->nullable();
            $table->string('server')->nullable();
            $table->integer('content_length')->nullable();
            $table->string('screenshot_path')->nullable();
            $table->boolean('is_monitored')->default(true);
            $table->timestamp('last_scanned_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subdomains');
    }
};
