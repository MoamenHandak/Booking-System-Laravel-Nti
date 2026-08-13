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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();

            $table->foreignId('city_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('name');
            $table->text('description')->nullable();
            $table->string('address')->nullable();

            // صورة الفندق
            $table->string('image')->nullable();

            $table->decimal('rating', 3, 2)->default(0);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};