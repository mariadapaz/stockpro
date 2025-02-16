@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Solicitações de Produto - Aprovação/Rejeição</h1>

    <div class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Produto</th>
                    <th scope="col">Setor</th>
                    <th scope="col">Solicitante</th>
                    <th scope="col">Data da Solicitação</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->product->name }}</td>
                        <td>{{ $request->sector }}</td>
                        <td>{{ $request->user->name }}</td>
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
                                <form action="{{ route('admin.product_requests.updateStatus', $request->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="status" value="approved" class="btn btn-success btn-sm">Aprovar</button>
                                    <button type="submit" name="status" value="rejected" class="btn btn-danger btn-sm">Rejeitar</button>
                                </form>
                            @else
                                <span class="text-muted">Não disponível</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
