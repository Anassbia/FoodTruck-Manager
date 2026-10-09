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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id_order');
            $table->date('date_order');
            $table->string('paiement_type');
            $table->integer('quantity');
            
            // Foreign keys
            $table->foreignId('id_menu')->constrained('menus')->onDelete('cascade');
            $table->foreignId('id_client')->constrained('clients')->onDelete('cascade');
            
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
