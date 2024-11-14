<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sorts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('planted', 8, 0)->default(0);
            $table->decimal('collected', 8, 0)->default(0);
            $table->decimal('ordered', 8, 0)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sorts');
    }
};
