<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pii_exposures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('type'); // email, phone, ssn, credit_card, etc
            $table->text('value'); // encrypted
            $table->string('source');
            $table->text('context')->nullable();
            $table->string('severity'); // critical, high, medium, low
            $table->string('status')->default('open'); // open, acknowledged, remediated
            $table->timestamp('discovered_at')->nullable();
            $table->timestamps();
            
            $table->index('company_id');
            $table->index('type');
            $table->index('severity');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pii_exposures');
    }
};
