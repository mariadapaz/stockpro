<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Solicitações</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Relatório de Solicitações de Materiais</h1>

    <table>
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
</body>
</html>
