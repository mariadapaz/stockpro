<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\User;
use App\Policies\ProductPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registre quaisquer serviços de aplicativo.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Registre os serviços de autenticação e outras políticas de autorização.
     *
     * @return void
     */
    public function boot()
    {
        // Registrando a política de produtos
        Gate::policy(Product::class, ProductPolicy::class);
        Gate::policy(User::class, UserPolicy::class);  
        
    }
}
