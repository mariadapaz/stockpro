<!-- resources/views/search/results.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container-lg">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="mb-4">Resultados da Busca</h1>

                @if($results->isEmpty())
                    <div class="alert alert-info" role="alert">
                        Nenhum resultado encontrado para a sua busca.
                    </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            <strong>Resultados para "{{ request('search') }}"</strong>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped mb-0">
                                    <thead>
                                        <tr>
                                            @if($type == 'produto')
                                                <th>Nome</th>
                                                <th>Categoria</th>
                                                <th>Ações</th>
                                            @elseif($type == 'fornecedor')
                                                <th>Nome</th>
                                                <th>CNPJ</th>
                                                <th>Ações</th>
                                            @elseif($type == 'solicitacao')
                                                <th>Status</th>
                                                <th>Setor</th>
                                                <th>Ações</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($results as $result)
                                            <tr>
                                                @if($type == 'produto')
                                                    <td>{{ $result->name }}</td>
                                                    <td>{{ $result->category }}</td>
                                                    <td>
                                                        <a href="{{ route('products.show', $result->id) }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-eye"></i> Ver Detalhes
                                                        </a>
                                                    </td>
                                                @elseif($type == 'fornecedor')
                                                    <td>{{ $result->name }}</td>
                                                    <td>{{ $result->cnpj }}</td>
                                                    <td>
                                                        <a href="{{ route('suppliers.index', $result->id) }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-eye"></i> Ver Detalhes
                                                        </a>
                                                    </td>
                                                @elseif($type == 'solicitacao')
                                                    <td>{{ $result->status }}</td>
                                                    <td>{{ $result->sector }}</td>
                                                    <td>
                                                        <a href="{{ route('product_requests.index', $result->id) }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-eye"></i> Ver Detalhes
                                                        </a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <!-- Paginação -->
                            {{ $results->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection