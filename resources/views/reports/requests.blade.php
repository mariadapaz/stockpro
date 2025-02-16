@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Relatório de Solicitações</h1>

    <form method="GET" action="{{ route('requests.report') }}">
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="product_id">Produto:</label>
                <select name="product_id" id="product_id" class="form-control">
                    <option value="all">Todos</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control">
                    <option value="all">Todos</option>
                    <option value="pending">Pendente</option>
                    <option value="approved">Aprovado</option>
                    <option value="rejected">Rejeitado</option>
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
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('requests.export', request()->all()) }}" class="btn btn-success">Exportar para PDF</a>
        </div>
    </form>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Setor</th>
                <th>Status</th>
                <th>Solicitado Por</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $request)
                <tr>
                    <td>{{ $request->product->name ?? 'Produto não encontrado' }}</td>
                    <td>{{ $request->sector }}</td>
                    <td>{{ ucfirst($request->status) }}</td>
                    <td>{{ $request->user->name ?? 'Usuário não encontrado' }}</td>
                    <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $requests->links() }} <!-- Paginação -->
</div>
@endsection
