<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductRequestController extends Controller
{
    // Exibe o histórico de solicitações de produtos
    public function index()
    {
        $requests = ProductRequest::where('user_id', auth()->id())->get();
        return view('product_requests.index', compact('requests'));
    }

    // Exibe o formulário de criação de solicitação
    public function create()
    {
        $products = Product::all();
        return view('product_requests.create', compact('products'));
    }

    // Armazena a solicitação de produto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'sector' => 'required|string|max:255',
        ]);

        $productRequest = new ProductRequest();
        $productRequest->user_id = auth()->user()->id;
        $productRequest->product_id = $validated['product_id'];
        $productRequest->sector = $validated['sector'];
        $productRequest->status = 'pending';
        $productRequest->save();

        return redirect()->route('product_requests.index')->with('success', 'Solicitação realizada com sucesso!');
    }

    // Exibe o relatório de solicitações
    public function report(Request $request)
    {
        $products = Product::all();
        $query = ProductRequest::with('product', 'user');

        if (!empty($request->product_id) && $request->product_id !== 'all') {
            $query->where('product_id', $request->product_id);
        }

        if (!empty($request->status) && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if (!empty($request->date_from) && !empty($request->date_to)) {
            $query->whereBetween('created_at', [
                $request->date_from . ' 00:00:00',
                $request->date_to . ' 23:59:59'
            ]);
        }

        $requests = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('reports.requests', compact('requests', 'products'));
    }

    // Exporta o relatório de solicitações em PDF
    public function export(Request $request)
    {
        $query = ProductRequest::with('product', 'user');

        if (!empty($request->product_id) && $request->product_id !== 'all') {
            $query->where('product_id', $request->product_id);
        }

        if (!empty($request->status) && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if (!empty($request->date_from) && !empty($request->date_to)) {
            $query->whereBetween('created_at', [
                $request->date_from . ' 00:00:00',
                $request->date_to . ' 23:59:59'
            ]);
        }

        $requests = $query->orderBy('created_at', 'desc')->get();

        if ($requests->isEmpty()) {
            return back()->with('error', 'Não há solicitações para gerar o relatório.');
        }

        $pdf = Pdf::loadView('reports.requests_pdf', compact('requests'));
        return $pdf->download('relatorio_solicitacoes.pdf');
    }

    public function adminApproveRequests()
{
    $requests = ProductRequest::where('status', 'pending')->get();
    return view('admin.product_requests', compact('requests'));
}

public function updateStatus(Request $request, $id)
{
    $productRequest = ProductRequest::findOrFail($id);
    $productRequest->status = $request->status;
    $productRequest->save();

    return redirect()->route('admin.product_requests.index')->with('success', 'Status atualizado com sucesso.');
}


    // Exibe o dashboard com solicitações do usuário
    public function dashboard()
    {
        $requests = ProductRequest::where('user_id', Auth::id())->get();
        return view('dashboard', compact('requests'));
    }
    
    // Exibe os dados para o gráfico de solicitações
public function chartData()
{
    // Contagem das solicitações agrupadas por status
    $statusCounts = ProductRequest::selectRaw('status, count(*) as total')
                                  ->groupBy('status')
                                  ->pluck('total', 'status')
                                  ->toArray();

    // Ou você pode agrupar por produto se desejar
    // $productCounts = ProductRequest::selectRaw('product_id, count(*) as total')
    //                                ->groupBy('product_id')
    //                                ->pluck('total', 'product_id')
    //                                ->toArray();

    // Preparando os dados para o gráfico
    return response()->json([
        'labels' => array_keys($statusCounts),  // Exemplo: ["Pendente", "Aprovado"]
        'data' => array_values($statusCounts),  // Exemplo: [10, 5]
    ]);
}

}
