<?php

use App\Http\Controllers\MovementController;
use App\Http\Controllers\ProductRequestController;
use App\Http\Controllers\StockReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialMovementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Middleware\CheckUserType;

// Redireciona '/' para a rota home
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Autenticação (login, registro, etc.)
Auth::routes();

// Rota para o dashboard principal (home)
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/movements/chart-data', [MaterialMovementController::class, 'chartData'])->name('movements.chartData');
Route::get('requests/chart-data', [ProductRequestController::class, 'chartData'])->name('requests.chartData');
Route::get('/stock/chart-data', [StockReportController::class, 'chartData'])->name('stock.chartData');


// Agrupa rotas que exigem autenticação
Route::middleware('auth')->group(function () {
    // Rota estática para "About"
    Route::view('about', 'about')->name('about');

    // Rotas de perfil (todos os usuários autenticados)
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    // 📌 **Grupo compartilhado para Administrador e Operador**
    Route::middleware([CheckUserType::class . ':administrador,operador'])->group(function () {
        // Movimentações de materiais (compartilhado entre administradores e operadores)
        Route::get('/movements', [MovementController::class, 'index'])->name('movements.index');
        Route::get('/movements/export', [MovementController::class, 'export'])->name('movements.export');

        // Relatório de estoque atual (compartilhado entre administradores e operadores)
        Route::get('/relatorio-estoque', [StockReportController::class, 'index'])->name('stock.report');
        Route::get('/relatorio-estoque/exportar', [StockReportController::class, 'export'])->name('stock.report.export');

        // Relatório de solicitações de materiais (compartilhado entre administradores e operadores)
        Route::get('/requests/report', [ProductRequestController::class, 'report'])->name('requests.report');
        Route::get('/requests/export', [ProductRequestController::class, 'export'])->name('requests.export');
    });

    // Rotas específicas para administradores
    Route::middleware([CheckUserType::class . ':administrador'])->group(function (): void {
        Route::resource('products', ProductController::class);
        Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

        // Rotas de fornecedores
        Route::resource('suppliers', SupplierController::class)->except(['show']);

        // Rota para gerenciar usuários
        Route::resource('users', UserController::class)->except(['create', 'store']);

        // Rota para atualizar o status da solicitação
        //Route::post('/update-request-status/{productRequest}', [ProductRequestController::class, 'updateStatus'])->name('update_request_status');

        Route::get('/admin/product-requests', [ProductRequestController::class, 'adminApproveRequests'])->name('admin.product_requests.index');
        Route::put('/admin/product-requests/{productRequest}', [ProductRequestController::class, 'updateStatus'])->name('admin.product_requests.updateStatus');
    });

    // Rotas específicas para operadores
    Route::middleware([CheckUserType::class . ':operador'])->group(function () {
        // Rotas de movimentação de materiais
        Route::resource('materials', MaterialMovementController::class)->only(['index', 'create', 'store']);
    });

    Route::middleware([CheckUserType::class . ':comum'])->group(function () {
        Route::get('/product-requests', [ProductRequestController::class, 'index'])->name('product_requests.index');
        Route::get('/product-requests/create', [ProductRequestController::class, 'create'])->name('product_requests.create');
        Route::post('/product-requests', [ProductRequestController::class, 'store'])->name('product_requests.store');
    });
    

    // 📌 **Rotas de busca**
    Route::get('/search', [SearchController::class, 'index'])->name('search.index');
});
