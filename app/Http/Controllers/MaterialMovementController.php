<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaterialMovement; // Modelo para a movimentação de materiais
use App\Models\Product; // Importando o modelo Product para usá-lo no controlador
use Illuminate\Support\Facades\DB;


class MaterialMovementController extends Controller
{
    // Exibe a listagem de movimentações
    public function index()
{
    // Recupera todas as movimentações de produtos ordenadas por data de criação
    $movements = MaterialMovement::orderBy('created_at', 'desc')->get();

    return view('materials.index', compact('movements'));
    }


    // Exibe o formulário para criar uma nova movimentação
    public function create()
    {
        // Recupera todos os produtos disponíveis para a movimentação
        $products = Product::all(); // Garante que o modelo 'Product' é acessado corretamente
        return view('materials.create', compact('products')); // Passa os produtos para a view
    }

    // Armazena uma nova movimentação no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id', // 'product_id' com validação de existência na tabela 'products'
            'quantity' => 'required|integer',
            'type' => 'required|in:entrada,saida',
            'reason' => 'required|string|max:255',
        ]);

        // Criação de um novo movimento de produto
        $movement = new MaterialMovement();
        $movement->product_id = $request->product_id; // Associando o 'product_id'
        $movement->quantity = $request->quantity;
        $movement->type = $request->type; // Entrada ou saída
        $movement->reason = $request->reason;
        $movement->user_id = auth()->id(); // Usuário responsável pela movimentação
        $movement->save();

        return redirect()->route('materials.index')->with('success', 'Movimentação registrada com sucesso!');
    }

        public function chartData()
    {
        $movements = DB::table('material_movements')
        ->selectRaw('EXTRACT(MONTH FROM created_at) as month, EXTRACT(YEAR FROM created_at) as year, type, SUM(quantity) as total_quantity')
        ->groupBy('year', 'month', 'type')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();
    
    
        $labels = [];
        $entradas = [];
        $saidas = [];
    
        foreach ($movements as $movement) {
            $label = "{$movement->month}/{$movement->year}";
    
            if (!in_array($label, $labels)) {
                $labels[] = $label;
            }
    
            if ($movement->type === 'entrada') {
                $entradas[] = $movement->total_quantity;
            } else {
                $saidas[] = $movement->total_quantity;
            }
        }
    
        return response()->json([
            'labels' => $labels,
            'entradas' => $entradas,
            'saidas' => $saidas,
        ]);
    }
}
