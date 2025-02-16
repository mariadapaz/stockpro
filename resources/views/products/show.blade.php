<!-- resources/views/products/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes do Produto: {{ $product->name }}</h1>

    <div class="row">
        <div class="col-md-6">
            <p><strong>Nome:</strong> {{ $product->name }}</p>
            <p><strong>Descrição:</strong> {{ $product->description }}</p>
            <p><strong>Categoria:</strong> {{ $product->category }}</p>
            <p><strong>Quantidade Atual:</strong> {{ $product->currentQuantity() }}</p>
            <p><strong>Quantidade Mínima:</strong> {{ $product->min_quantity }}</p>

            @if ($product->image)
                <img src="{{ Storage::url($product->image) }}" alt="Imagem do Produto" width="200" class="img-fluid">
            @endif
        </div>
    </div>
    <br>
    <a href="{{ route('products.index') }}" class="btn btn-primary">Voltar para a lista de produtos</a>
</div>
@endsection
