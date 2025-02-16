<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class); // Protege a listagem
        $users = User::paginate();
        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user); // Protege a edição
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $user->update($request->all());
        return redirect()->route('users.index')->with('success', 'Usuário atualizado!');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user); // Protege a exclusão
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário removido!');
    }
}
