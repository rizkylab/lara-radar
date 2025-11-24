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
        Schema::create('cves', function (Blueprint $table) {
            $table->id();
            $table->string('cve_id')->unique();
            $table->text('description')->nullable();
            $table->decimal('cvss_score', 3, 1)->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('last_modified_at')->nullable();
            $table->json('references')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cves');
    }
};
