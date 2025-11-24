<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tech_stacks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subdomain_id');
            $table->string('technology');
            $table->string('category')->nullable(); // web-server, framework, cms, etc
            $table->string('version')->nullable();
            $table->string('confidence')->nullable();
            $table->timestamps();
            
            $table->index('subdomain_id');
            $table->index('technology');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tech_stacks');
    }
};
