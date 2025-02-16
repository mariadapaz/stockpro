@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Painel do Operador</h1>
        <p>Bem-vindo ao painel do operador!</p>
    </div>
    <!-- Links para Criar e Editar Produtos -->
    <div class="mt-4">
            <a href="{{ route('materials.create') }}" class="btn btn-primary">Registar movimentações de Produto</a>
            <a href="{{ route('materials.index') }}" class="btn btn-primary">Ver Movimentações</a>
        </div>
@endsection
