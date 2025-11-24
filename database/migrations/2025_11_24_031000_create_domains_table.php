<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('user_id');
            $table->string('domain');
            $table->string('status')->default('pending'); // pending, scanning, completed, failed
            $table->integer('subdomain_count')->default(0);
            $table->integer('vulnerability_count')->default(0);
            $table->integer('port_count')->default(0);
            $table->timestamp('last_scanned_at')->nullable();
            $table->json('scan_config')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('company_id');
            $table->index('user_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};
