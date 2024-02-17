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
        Schema::create('cars', function (Blueprint $table) {
            $table->id(); // This automatically creates an auto-incrementing primary key column 'id'
            $table->string('title', 100);
            $table->longText('description');
            $table->boolean('published')->default(false)->comment("Published = 1, Not published = 0");
            $table->string('image', 100);
            $table->integer('price');
            $table->integer('Luggage');
            $table->integer('Doors');
            $table->integer('Passenger');
            $table->foreignId('category_id')->constrained('categories');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
