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
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id_employee');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('cin')->unique();
            $table->string('phone');
            $table->binary('image')->nullable();
            $table->date('birthday');
            $table->decimal('salary', 10, 2);
            $table->tinyInteger('status')->default(1);
            $table->foreignId('id_job')->constrained('jobs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
