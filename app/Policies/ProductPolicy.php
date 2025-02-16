<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine se o usuário pode criar um produto.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->type === 'administrador'; // Somente administradores podem criar produtos
    }

    /**
     * Determine se o usuário pode editar o produto.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return bool
     */
    public function update(User $user, Product $product)
    {
        return $user->type === 'administrador'; // Somente administradores podem editar produtos
    }

    /**
     * Determine se o usuário pode excluir o produto.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return bool
     */
    public function delete(User $user, Product $product)
    {
        return $user->type === 'administrador'; // Somente administradores podem excluir produtos
    }
}
