@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Movimentação de Material</h1>
    
    <form action="{{ route('materials.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="product_id">Produto</label>
        <select name="product_id" id="product_id" class="form-control" required>
            <option value="">Selecione um produto</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option> <!-- Produto listado pelo nome -->
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="quantity">Quantidade</label>
        <input type="number" name="quantity" id="quantity" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="type">Tipo de Movimentação</label>
        <select name="type" id="type" class="form-control" required>
            <option value="entrada">Entrada</option>
            <option value="saida">Saída</option>
        </select>
    </div>

    <div class="form-group">
        <label for="reason">Motivo</label>
        <input type="text" name="reason" id="reason" class="form-control" required>
    </div>
 <br>
    <button type="submit" class="btn btn-primary">Registrar Movimentação</button>
</form>

</div>
@endsection
