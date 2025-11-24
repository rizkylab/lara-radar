<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('darkweb_credentials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('email');
            $table->string('password_hash')->nullable();
            $table->string('password_plain')->nullable(); // encrypted
            $table->string('source'); // paste site, breach db, etc
            $table->string('breach_name')->nullable();
            $table->timestamp('breach_date')->nullable();
            $table->string('status')->default('open'); // open, acknowledged, remediated
            $table->integer('password_strength')->nullable(); // 0-100
            $table->timestamps();
            
            $table->index('company_id');
            $table->index('email');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('darkweb_credentials');
    }
};
