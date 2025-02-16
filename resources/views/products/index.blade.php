@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Card principal -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('Produtos') }}</h5>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        <i class="cil-plus"></i> {{ __('Adicionar Produto') }}
                    </a>
                </div>

                <div class="card-body">
                    @if($products->isEmpty())
                        <div class="alert alert-info d-flex align-items-center">
                            <i class="cil-info pr-2"></i>
                            {{ __('Nenhum produto cadastrado.') }}
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('Nome') }}</th>
                                        <th>{{ __('Categoria') }}</th>
                                        <th>{{ __('Quantidade Mínima') }}</th>
                                        <th>{{ __('Imagem') }}</th>
                                        <th class="text-center">{{ __('Ações') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->category }}</td>
                                            <td>{{ $product->min_quantity }}</td>
                                            <td>
                                                @if ($product->image)
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" width="50" height="50">
                                                @else
                                                    <span class="text-muted">{{ __('Sem imagem') }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm">
                                                    <i class="cil-magnifying-glass"></i> {{ __('Detalhes') }}
                                                </a>
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="cil-pencil"></i> {{ __('Editar') }}
                                                </a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="cil-trash"></i> {{ __('Excluir') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginação -->
                        <div class="card-footer d-flex justify-content-center">
                            {{ $products->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
