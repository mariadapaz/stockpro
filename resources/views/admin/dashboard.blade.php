@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Painel Administrativo</h1>
        <p>Bem-vindo ao painel administrativo!</p>

        <!-- Exibição das solicitações -->
         <h3>Solicitações:</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Setor</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->product->name }}</td>
                        <td>{{ $request->sector }}</td>
                        <td>{{ $request->created_at->format('d/m/Y') }}</td>
                        <td>
                            @if($request->status == 'pending')
                                <span class="badge bg-warning">Pendente</span>
                            @elseif($request->status == 'approved')
                                <span class="badge bg-success">Aprovada</span>
                            @elseif($request->status == 'rejected')
                                <span class="badge bg-danger">Rejeitada</span>
                            @endif
                        </td>
                        <td>
                            @if($request->status == 'pending')
                                <!-- Formulário de Aprovação -->
                                <form action="{{ route('admin.update_request_status', $request) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-success">Aprovar</button>
                                </form>

                                <!-- Formulário de Rejeição -->
                                <form action="{{ route('admin.update_request_status', $request) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-danger">Rejeitar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Links para Criar e Editar Produtos -->
        <div class="mt-4">
            <a href="{{ route('products.create') }}" class="btn btn-primary">Criar Produto</a>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Ver Produtos</a>
            <a href="{{ route('suppliers.create') }}" class="btn btn-primary">Cadastrar Fornecedor</a>
            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Ver Fornecedores</a>
            <a href="{{ route('movements.index') }}" class="btn btn-secondary">Gerar Relatório</a>
            <a href="{{ route('stock.report') }}" class="btn btn-info">Relatório de Estoque</a>
            <a href="{{ route('requests.report') }}" class="btn btn-info">Relatório de Solicitações</a>
            <a href="{{ route('users.index') }}" class="btn btn-warning">Gerenciar Usuários</a>

        </div>
    </div>
@endsection
