<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vulnerabilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subdomain_id')->nullable();
            $table->unsignedBigInteger('domain_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('severity'); // critical, high, medium, low, info
            $table->decimal('cvss_score', 3, 1)->nullable();
            $table->string('cve_id')->nullable();
            $table->string('cwe_id')->nullable();
            $table->string('status')->default('open'); // open, onhold, closed, false_positive
            $table->text('remediation')->nullable();
            $table->json('references')->nullable();
            $table->string('scanner')->nullable(); // nuclei, custom, manual
            $table->timestamps();
            
            $table->index('subdomain_id');
            $table->index('domain_id');
            $table->index('severity');
            $table->index('status');
            $table->index('cve_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vulnerabilities');
    }
};
