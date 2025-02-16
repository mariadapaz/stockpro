@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Relatório de Estoque Atual</h1>

    <table class="table table-bordered">
    <thead>
        <tr>
            <th>Produto</th>
            <th>Quantidade em Estoque</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->current_quantity }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


    <div class="card-footer d-flex justify-content-center">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>

    <a href="{{ route('stock.report.export') }}" class="btn btn-primary mt-3">Baixar Relatório em PDF</a>
</div>
@endsection
