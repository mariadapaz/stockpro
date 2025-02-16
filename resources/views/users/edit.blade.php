@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Usuário</h2>
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nome:</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label>Tipo de Usuário:</label>
            <select name="type" class="form-control">
                <option value="administrador" {{ $user->type == 'administrador' ? 'selected' : '' }}>Administrador</option>
                <option value="operador" {{ $user->type == 'operador' ? 'selected' : '' }}>Operador</option>
                <option value="comum" {{ $user->type == 'comum' ? 'selected' : '' }}>Comum</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection
