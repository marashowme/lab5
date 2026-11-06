<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('filter', function (Blueprint $table) {
            $table->id('filter_id');
            $table->string('filter_name', 100);
            $table->text('filter_description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('filter');
    }
};
