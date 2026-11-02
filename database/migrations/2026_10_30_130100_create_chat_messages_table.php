<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained('chat_conversations')->cascadeOnDelete();
            $table->text('visitor_message');
            $table->text('assistant_response');
            $table->string('visitor_name', 80)->nullable();
            $table->string('visitor_phone', 20)->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index(['conversation_id', 'created_at']);
            $table->index('visitor_name');
            $table->index('visitor_phone');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};
