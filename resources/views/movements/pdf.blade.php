<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Movimentações</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Relatório de Movimentações de Produtos</h1>

    <table>
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
</body>
</html>
