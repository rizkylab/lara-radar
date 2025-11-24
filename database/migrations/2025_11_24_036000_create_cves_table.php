<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cves', function (Blueprint $table) {
            $table->id();
            $table->string('cve_id')->unique();
            $table->text('description');
            $table->decimal('cvss_v3_score', 3, 1)->nullable();
            $table->string('cvss_v3_vector')->nullable();
            $table->string('severity'); // critical, high, medium, low
            $table->json('affected_products')->nullable();
            $table->json('references')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('modified_at')->nullable();
            $table->boolean('is_trending')->default(false);
            $table->integer('trending_score')->default(0);
            $table->timestamps();
            
            $table->index('severity');
            $table->index('is_trending');
            $table->index('published_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cves');
    }
};
