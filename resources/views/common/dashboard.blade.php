@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Painel do Usuário Comum</h1>
    <p>Bem-vindo ao painel de solicitações de produtos!</p>

    <!-- Link para Criar Solicitação de Produto -->
    <div class="mt-4">
        <a href="{{ route('product_requests.create') }}" class="btn btn-primary">Criar Solicitação de Produto</a>
    </div>

    <!-- Histórico de Solicitações -->
    <div class="mt-4">
        <h3>Histórico de Solicitações</h3>
        <p>Aqui você pode acompanhar o status das solicitações feitas.</p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Produto</th>
                    <th scope="col">Setor</th>
                    <th scope="col">Data da Solicitação</th>
                    <th scope="col">Status</th>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
