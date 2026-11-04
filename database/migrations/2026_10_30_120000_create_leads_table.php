<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80);
            $table->string('phone', 40);
            $table->string('question', 240)->nullable();
            $table->string('ip_hash', 64)->nullable();
            $table->string('source', 40)->default('chat');
            $table->timestamps();
            $table->index(['phone', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
