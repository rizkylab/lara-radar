<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('category'); // vulnerability, darkweb, botnet, pii, cve
            $table->string('severity'); // critical, high, medium, low, info
            $table->string('status')->default('open'); // open, onhold, closed
            $table->morphs('alertable'); // polymorphic relation
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            
            $table->index('company_id');
            $table->index('user_id');
            $table->index('category');
            $table->index('severity');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alerts');
    }
};
