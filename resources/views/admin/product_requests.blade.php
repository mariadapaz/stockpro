@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Painel do Administrador - Aprovar Solicitações</h1>
    <p>Aqui você pode aprovar ou rejeitar solicitações de produtos.</p>

    <!-- Lista de Solicitações Pendentes -->
    <div class="mt-4">
        <h3>Solicitações Pendentes</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Usuário</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Setor</th>
                    <th scope="col">Data da Solicitação</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->user->name }}</td>
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
                                <form action="{{ route('admin.product_requests.updateStatus', $request->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-success btn-sm">Aprovar</button>
                                </form>

                                <form action="{{ route('admin.product_requests.updateStatus', $request->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-danger btn-sm">Rejeitar</button>
                                </form>
                            @else
                                <span class="text-muted">Já processada</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
