@vite('resources/js/app.js')
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="theme-color" content="#ffffff">
    @vite('resources/sass/app.scss')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <img src="{{ asset('icons/logo.png') }}" alt="Minha Logo" class="sidebar-brand-full">
        <img src="{{ asset('icons/mini-logo.png') }}" alt="Minha Logo Mini" class="sidebar-brand-narrow" width="46" height="46">
    </div>
    <ul class="nav">
        <!-- Dashboard Links -->
        @auth
            @if (auth()->user()->type == 'administrador')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">
                        <i class="fas fa-cogs me-2"></i>
                        Gerenciar Produtos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('suppliers.index') }}">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-industry') }}"></use>
                        </svg>
                        Fornecedores
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                        </svg>
                        Gerenciar Usuários
                    </a>
                </li>
                <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.product_requests.index') }}">
        <svg class="icon me-2">
            <use xlink:href="{{ asset('icons/coreui.svg#cil-list') }}"></use>
        </svg>
        Solicitações de Produtos
    </a>
</li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('stock.report') }}">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-clipboard') }}"></use>
                        </svg>
                        Relatório de Estoque
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('movements.index') }}">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-clipboard') }}"></use>
                        </svg>
                        Relatório de Movimentação de Produtos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('requests.report') }}">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-clipboard') }}"></use>
                        </svg>
                        Relatório de Solicitações
                    </a>
                </li>
            @elseif (auth()->user()->type == 'operador')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('materials.index') }}">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-history') }}"></use>
                        </svg>
                        Histórico de Movimentações
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('materials.create') }}">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-swap-horizontal') }}"></use>
                        </svg>
                        Movimentar Produtos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('stock.report') }}">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-clipboard') }}"></use>
                        </svg>
                        Relatório de Estoque
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('movements.index') }}">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-clipboard') }}"></use>
                        </svg>
                        Relatório de Movimentação de Produtos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('requests.report') }}">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-clipboard') }}"></use>
                        </svg>
                        Relatório de Solicitações
                    </a>
                </li>
            @elseif (auth()->user()->type == 'comum')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('product_requests.create') }}">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-plus') }}"></use>
                        </svg>
                        Nova Solicitação
                    </a>
                </li>
            @endif
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <svg class="icon me-2">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-home') }}"></use>
                    </svg>
                    Dashboard
                </a>
            </li>
        @endauth
    </ul>
</div>

<div class="wrapper d-flex flex-column min-vh-100 bg-light">
<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <!-- Botão de Menu para Sidebar -->
        <button class="header-toggler px-md-0 me-md-3" type="button"
                onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-menu') }}"></use>
            </svg>
        </button>
        <a class="header-brand d-md-none" href="#">
        <img src="{{ asset('icons/logo.png') }}" alt="Minha Logo">
        </a>

        <!-- Links do Dashboard (dependendo do tipo de usuário) -->
        <ul class="header-nav d-none d-md-flex">
            @auth
                @if (auth()->user()->type == 'administrador')
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                @elseif (auth()->user()->type == 'operador')
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                @elseif (auth()->user()->type == 'comum')
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                @endif
            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Dashboard</a></li>
            @endauth
        </ul>

        <!-- Campo de busca antes do nome do usuário -->
        <form class="d-flex ms-3" action="{{ route('search.index') }}" method="GET">
            <select class="form-select form-select-sm me-2" name="type" required>
                <option value="produto">Produto</option>
                <option value="fornecedor">Fornecedor</option>
                <option value="solicitacao">Solicitação</option>
            </select>
            <input class="form-control form-control-sm" type="text" name="search" placeholder="Buscar..." aria-label="Buscar">
            <button class="btn btn-outline-secondary btn-sm ms-2" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>

        <!-- Menu ário (nome, cargo e logout) -->
        <ul class="header-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                        </svg>
                        {{ __('Meu perfil') }}
                    </a>
                    <a class="dropdown-item" href="#">
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-briefcase') }}"></use>
                        </svg>
                        Cargo: {{ Auth::user()->type }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); this.closest('form').submit();">
                            <svg class="icon me-2">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-account-logout') }}"></use>
                            </svg>
                            {{ __('Logout') }}
                        </a>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</header>

    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            @yield('content')
        </div>
    </div>

    <footer class="footer">
        <div><a href="#">StockPro </a><a href="">Sistema para almoxarifado</a> &copy; 2025</div>
    </footer>
</div>

<script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
</body>
</html>
