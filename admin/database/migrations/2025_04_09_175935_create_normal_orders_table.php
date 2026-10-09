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
        Schema::create('normal_orders', function (Blueprint $table) {
            $table->bigIncrements('id_NO'); // Primary key
            $table->date('date_order');
            $table->integer('quantity');
            $table->string('paiement_type');

            // Foreign key to trucks table
            $table->foreignId('id_menu')->constrained('menus')->onDelete('cascade');
            $table->foreignId('id_truck')->constrained('trucks')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('normal_orders');
    }
};
