<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRequestsTable extends Migration
{
    public function up()
    {
        // Exclui a tabela caso ela já exista
        Schema::dropIfExists('product_requests');
        
        // Cria a tabela novamente com a coluna 'user_id'
        Schema::create('product_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Produto solicitado
            $table->string('sector'); // Setor para o qual o produto foi solicitado
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Status da solicitação
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Usuário que fez a solicitação
            $table->timestamps(); // Data de solicitação
        });
    }

    public function down()
    {
        // Remove a tabela no rollback
        Schema::dropIfExists('product_requests');
    }
}
