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
        Schema::create('catstocks', function (Blueprint $table) {
            $table->bigIncrements('id_catstock');
            $table->foreignId('id_stock')->constrained('stocks')->onDelete('cascade');
            $table->foreignId('id_categorie')->constrained('categories')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catstocks');
    }
};
