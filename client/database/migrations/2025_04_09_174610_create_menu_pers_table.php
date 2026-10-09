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
        Schema::create('menu_pers', function (Blueprint $table) {
            $table->bigIncrements('id_menuPers');
            $table->string('name');
            $table->date('date_order');
            $table->string('paiement_type');
            $table->decimal('price', 8, 2);
            $table->integer('quantity');
            // Foreign key to clients
            $table->foreignId('id_client')->constrained('clients')->onDelete('cascade');
            $table->foreignId('id_truck')->constrained('truck')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_pers');
    }
};
