<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_filter', function (Blueprint $table) {
            $table->foreignId('blog_id')
                ->constrained('blog', 'blog_id')
                ->cascadeOnDelete();

            $table->foreignId('filter_id')
                ->constrained('filter', 'filter_id')
                ->cascadeOnDelete();

            $table->primary(['blog_id', 'filter_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_filter');
    }
};
