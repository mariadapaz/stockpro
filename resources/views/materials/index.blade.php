@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Movimentações de Materiais</h1>
    <a href="{{ route('materials.create') }}" class="btn btn-primary">Registrar Movimentação</a>
    
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Material</th>
                <th>Quantidade</th>
                <th>Tipo</th>
                <th>Motivo</th>
                <th>Data</th>
                <th>Responsável</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movements as $movement)
                <tr>
                    <td>{{ $movement->product->name }}</td>
                    <td>{{ $movement->quantity }}</td>
                    <td>{{ ucfirst($movement->type) }}</td>
                    <td>{{ $movement->reason }}</td>
                    <td>{{ $movement->created_at}}</td>
                    <td>{{ $movement->user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
@endsection
