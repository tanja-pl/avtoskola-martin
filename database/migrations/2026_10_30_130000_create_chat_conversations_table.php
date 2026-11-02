<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_conversations', function (Blueprint $table) {
            $table->id();
            $table->uuid('token')->unique();
            $table->string('visitor_name', 80)->nullable();
            $table->string('visitor_phone', 20)->nullable();
            $table->boolean('contact_provided')->default(false);
            $table->boolean('enrollment_interest')->default(false);
            $table->string('interest_level', 10)->default('low');
            $table->timestamp('last_message_at')->nullable();
            $table->timestamps();

            $table->index('visitor_name');
            $table->index('visitor_phone');
            $table->index('contact_provided');
            $table->index('enrollment_interest');
            $table->index('last_message_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_conversations');
    }
};
