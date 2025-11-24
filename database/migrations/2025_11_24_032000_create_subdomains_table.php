<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subdomains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('domain_id');
            $table->string('subdomain');
            $table->string('ip_address')->nullable();
            $table->string('status_code')->nullable();
            $table->boolean('is_alive')->default(false);
            $table->string('screenshot_path')->nullable();
            $table->json('dns_records')->nullable();
            $table->timestamps();
            
            $table->index('domain_id');
            $table->index('is_alive');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subdomains');
    }
};
