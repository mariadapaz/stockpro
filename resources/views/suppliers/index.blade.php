@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('Fornecedores') }}</h5>
                    <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
                        <i class="cil-plus"></i> {{ __('Adicionar Fornecedor') }}
                    </a>
                </div>

                <div class="card-body">
                    @if($suppliers->isEmpty())
                        <div class="alert alert-info d-flex align-items-center">
                            <i class="cil-info pr-2"></i>
                            {{ __('Nenhum fornecedor cadastrado.') }}
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('Nome') }}</th>
                                        <th>{{ __('CNPJ') }}</th>
                                        <th>{{ __('Telefone') }}</th>
                                        <th>{{ __('E-mail') }}</th>
                                        <th>{{ __('Endereço') }}</th>
                                        <th class="text-center">{{ __('Ações') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suppliers as $supplier)
                                        <tr>
                                            <td>{{ $supplier->name }}</td>
                                            <td>{{ $supplier->cnpj }}</td>
                                            <td>{{ $supplier->phone }}</td>
                                            <td>{{ $supplier->email }}</td>
                                            <td>{{ $supplier->address }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="cil-pencil"></i> {{ __('Editar') }}
                                                </a>
                                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline">
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
                            {{ $suppliers->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
