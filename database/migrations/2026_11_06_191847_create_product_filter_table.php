<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_filter', function (Blueprint $table) {
            $table->foreignId('product_id')
                ->constrained('products', 'id')
                ->cascadeOnDelete();

            $table->foreignId('filter_id')
                ->constrained('filter', 'filter_id')
                ->cascadeOnDelete();

            $table->primary(['product_id', 'filter_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_filter');
    }
};
