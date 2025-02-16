<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Estoque</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Relatório de Estoque Atual</h1>

    <table>
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
</body>
</html>
