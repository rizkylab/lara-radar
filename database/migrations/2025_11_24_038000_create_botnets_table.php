<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('botnets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('ip_address');
            $table->string('botnet_name')->nullable();
            $table->string('malware_family')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('first_seen')->nullable();
            $table->timestamp('last_seen')->nullable();
            $table->string('status')->default('active'); // active, inactive, remediated
            $table->timestamps();
            
            $table->index('company_id');
            $table->index('ip_address');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('botnets');
    }
};
