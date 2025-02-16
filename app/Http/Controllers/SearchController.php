<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRequest;
use App\Models\Supplier;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Validation\Rule;

class SearchController extends Controller
{
    public function index(HttpRequest $request)
    {
        // Validação dos parâmetros de busca
        $request->validate([
            'search' => 'nullable|string|max:255',
            'type' => ['required', Rule::in(['produto', 'fornecedor', 'solicitacao'])],
            'filter' => 'nullable|string|max:255', // Filtro adicional
        ]);

        $query = $request->get('search');
        $type = $request->get('type');
        $filter = $request->get('filter');

        $results = [];

        if ($type == 'produto') {
            $results = Product::query()
                ->when($query, function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                      ->orWhere('category', 'LIKE', "%{$query}%");
                })
                ->when($filter, function ($q) use ($filter) {
                    // Exemplo de filtro adicional para produtos
                    $q->where('category', $filter);
                })
                ->paginate(10); // Paginação
        } elseif ($type == 'fornecedor') {
            $results = Supplier::query()
                ->when($query, function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                      ->orWhere('cnpj', 'LIKE', "%{$query}%");
                })
                ->when($filter, function ($q) use ($filter) {
                    // Exemplo de filtro adicional para fornecedores
                    $q->where('cnpj', $filter);
                })
                ->paginate(10); // Paginação
        } elseif ($type == 'solicitacao') {
            $results = ProductRequest::query()
                ->when($query, function ($q) use ($query) {
                    $q->where('status', 'LIKE', "%{$query}%")
                      ->orWhere('sector', 'LIKE', "%{$query}%");
                })
                ->when($filter, function ($q) use ($filter) {
                    // Exemplo de filtro adicional para solicitações
                    $q->where('status', $filter);
                })
                ->paginate(10); // Paginação
        }

        return view('search.results', compact('results', 'type'));
    }
}

