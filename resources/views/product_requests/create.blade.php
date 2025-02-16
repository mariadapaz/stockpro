@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Criar Solicitação de Produto</h1>

    <form action="{{ route('product_requests.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="product_id">Produto</label>
            <select name="product_id" id="product_id" class="form-control" required>
                <option value="">Selecione o Produto</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="sector">Setor</label>
            <input type="text" name="sector" id="sector" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Solicitar Produto</button>
    </form>
</div>
@endsection
