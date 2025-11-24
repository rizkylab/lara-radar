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
        Schema::create('vulnerabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domain_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subdomain_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('severity'); // critical, high, medium, low, info
            $table->text('description')->nullable();
            $table->decimal('cvss_score', 3, 1)->nullable();
            $table->string('cve_id')->nullable();
            $table->string('status')->default('open'); // open, closed, ignored
            $table->text('remediation')->nullable();
            $table->text('proof_of_concept')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vulnerabilities');
    }
};
