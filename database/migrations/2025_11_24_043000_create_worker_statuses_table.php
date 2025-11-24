<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('worker_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('worker_name');
            $table->string('worker_type'); // subdomain, port, vuln, tech, screenshot, darkweb
            $table->string('status'); // online, offline, busy, error
            $table->string('version')->nullable();
            $table->integer('jobs_processed')->default(0);
            $table->integer('jobs_failed')->default(0);
            $table->timestamp('last_heartbeat')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->index('worker_name');
            $table->index('worker_type');
            $table->index('status');
            $table->index('last_heartbeat');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worker_statuses');
    }
};
