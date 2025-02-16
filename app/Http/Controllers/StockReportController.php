<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StockReportController extends Controller
{
    // Exibe o relatório na tela
    public function index()
    {
        // Recupera todos os produtos com a quantidade em estoque
        $products = Product::orderBy('name', 'asc')->paginate(10);
        return view('reports.stock', compact('products'));
    }

    // Gera um PDF do relatório de estoque
    public function export()
{
    // Buscar TODOS os produtos, sem paginação
    $products = Product::orderBy('name', 'asc')->get();

    // Verifica se há produtos antes de gerar o PDF
    if ($products->isEmpty()) {
        return back()->with('error', 'Não há produtos em estoque para gerar o relatório.');
    }

    // Gera o PDF com todos os produtos
    $pdf = Pdf::loadView('reports.stock_pdf', compact('products'));

    return $pdf->download('relatorio_estoque.pdf');
}

// Adicione no StockReportController
public function chartData()
{
    // Obtém os produtos e suas quantidades em estoque
    $products = Product::all();
    
    // Organiza os dados para o gráfico (você pode adicionar categorias ou dividir por tipo de produto se necessário)
    $labels = $products->pluck('name'); // Nomes dos produtos
    $quantities = $products->pluck('currentQuantity'); // Quantidades em estoque
    

    return response()->json([
        'labels' => $labels,
        'quantities' => $quantities,
    ]);
}



}

