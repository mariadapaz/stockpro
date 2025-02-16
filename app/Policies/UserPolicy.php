<?php
namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determina se o usuário pode visualizar a lista de usuários.
     */
    public function viewAny(User $user)
    {
        return $user->type === 'administrador';
    }

    /**
     * Determina se o usuário pode editar outro usuário.
     */
    public function update(User $user)
    {
        return $user->type === 'administrador';
    }

    /**
     * Determina se o usuário pode excluir outro usuário.
     */
    public function delete(User $user)
    {
        return $user->type === 'administrador';
    }
}
