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
        Schema::create('worker_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('worker_name');
            $table->string('status');
            $table->timestamp('last_heartbeat_at')->nullable();
            $table->string('current_job')->nullable();
            $table->integer('queue_size')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worker_statuses');
    }
};
