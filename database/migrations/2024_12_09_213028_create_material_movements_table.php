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
        Schema::create('material_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // Referência ao material
            $table->unsignedBigInteger('user_id'); // Referência ao usuário que fez a movimentação
            $table->integer('quantity'); // Quantidade movimentada
            $table->enum('type', ['entrada', 'saida']); // Tipo de movimentação
            $table->string('reason'); // Motivo da movimentação
            $table->timestamps();
    
            // Relacionamento com a tabela de materiais (caso exista)
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_movements');
    }
};
