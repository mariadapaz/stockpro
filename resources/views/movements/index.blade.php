@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Relatório de Movimentações de Produtos</h1>
    
    <form method="GET" action="{{ route('movements.index') }}">
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="product_id">Produto:</label>
                <select name="product_id" id="product_id" class="form-control">
                    <option value="all">Todos</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="date_from">De:</label>
                <input type="date" name="date_from" id="date_from" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="date_to">Até:</label>
                <input type="date" name="date_to" id="date_to" class="form-control">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <form method="GET" action="{{ route('movements.export') }}">
    <input type="hidden" name="product_id" value="{{ request('product_id') }}">
    <input type="hidden" name="date_from" value="{{ request('date_from') }}">
    <input type="hidden" name="date_to" value="{{ request('date_to') }}">
    <button type="submit" class="btn btn-success mb-3">Exportar para PDF</button>
</form>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Tipo</th>
                <th>Usuário</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movements as $movement)
                <tr>
                    <td>{{ $movement->product->name ?? 'Produto não encontrado' }}</td>
                    <td>{{ $movement->quantity }}</td>
                    <td>{{ ucfirst($movement->type) }}</td>
                    <td>{{ $movement->user->name ?? 'Usuário não encontrado' }}</td>
                    <td>{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
