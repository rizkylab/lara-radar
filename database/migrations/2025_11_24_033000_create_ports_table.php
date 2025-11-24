<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subdomain_id');
            $table->integer('port_number');
            $table->string('protocol')->default('tcp');
            $table->string('service')->nullable();
            $table->string('version')->nullable();
            $table->string('state')->default('open'); // open, closed, filtered
            $table->text('banner')->nullable();
            $table->timestamps();
            
            $table->index('subdomain_id');
            $table->index('port_number');
            $table->index('state');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ports');
    }
};
