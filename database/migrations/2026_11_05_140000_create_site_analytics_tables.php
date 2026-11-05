<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_site_stats', function (Blueprint $table) {
            $table->id();
            $table->date('visited_on')->unique();
            $table->unsignedInteger('page_views')->default(0);
            $table->unsignedInteger('unique_visitors')->default(0);
            $table->timestamps();
        });

        Schema::create('daily_category_stats', function (Blueprint $table) {
            $table->id();
            $table->date('visited_on');
            $table->string('category', 32);
            $table->unsignedInteger('visits')->default(0);
            $table->timestamps();

            $table->unique(['visited_on', 'category']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_category_stats');
        Schema::dropIfExists('daily_site_stats');
    }
};
