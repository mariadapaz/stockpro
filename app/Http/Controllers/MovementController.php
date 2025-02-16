<?php

namespace App\Http\Controllers;

use App\Models\MaterialMovement;
use App\Models\Movement;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class MovementController extends Controller
{
   
    public function index(Request $request)
{
    $products = Product::all();
    $query = MaterialMovement::with('product', 'user');

    if (!empty($request->product_id) && $request->product_id !== 'all') {
        $query->where('product_id', $request->product_id);
    }

    if (!empty($request->date_from) && !empty($request->date_to)) {
        $query->whereBetween('created_at', [
            $request->date_from . ' 00:00:00',
            $request->date_to . ' 23:59:59'
        ]);
    }

    $movements = $query->orderBy('created_at', 'desc')->get();

    return view('movements.index', compact('movements', 'products'));
}


public function export(Request $request)
{
    $query = MaterialMovement::with('product', 'user');

    // Verifique se o filtro do produto foi aplicado
    if (!empty($request->product_id) && $request->product_id !== 'all') {
        $query->where('product_id', $request->product_id);
    }

    // Verifique se as datas foram fornecidas antes de tentar adicionar o filtro
    if ($request->has('date_from') && $request->has('date_to') && $request->date_from && $request->date_to) {
        // Aplique o filtro apenas se as duas datas forem fornecidas
        $query->whereBetween('created_at', [
            $request->date_from . ' 00:00:00',
            $request->date_to . ' 23:59:59'
        ]);
    }

    // Execute a consulta com os filtros aplicados
    $movements = $query->orderBy('created_at', 'desc')->get();

    // Verifique se há movimentos para exportar
    if ($movements->isEmpty()) {
        return back()->with('error', 'Não há dados para exportar.');
    }

    // Gerar o PDF com os movimentos encontrados
    $pdf = Pdf::loadView('movements.pdf', compact('movements'));

    return $pdf->download('relatorio_movimentacoes.pdf');
}


}
