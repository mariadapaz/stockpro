@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Dashboard Card -->
        <div class="card shadow-lg mb-4">
            <div class="card-header bg-primary text-white">
                <h4>{{ __('Dashboard') }}</h4>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ __('Bem vindo ao painel inicial!') }}</h5>
                <p class="card-text">{{ __('Aqui você gerenciar sua conta, realizar relatorios, e mais.') }}</p>
                
                <div class="row">
                    <!-- Manage Profile Card -->
                    <div class="col-md-4 mb-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <svg class="icon icon-xl text-primary mb-3">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                                </svg>
                                <h5 class="card-title">{{ __('Manage Profile') }}</h5>
                                <p class="card-text">{{ __('Update your personal information, password, and settings.') }}</p>
                                <a href="{{ route('profile.show') }}" class="btn btn-outline-primary">{{ __('Go to Profile') }}</a>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Area Card (Only visible for admin users) -->
                    @if(auth()->user()->user_type === 'administrador')
                        <div class="col-md-4 mb-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <svg class="icon icon-xl text-danger mb-3">
                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-settings') }}"></use>
                                    </svg>
                                    <h5 class="card-title">{{ __('Admin Area') }}</h5>
                                    <p class="card-text">{{ __('Manage system settings, user roles, and more.') }}</p>
                                    <a href="{{ route('dashboard') }}" class="btn btn-outline-danger">{{ __('Go to Admin Area') }}</a>
                                </div>
                            </div>
                        </div>

                        <!-- Example of Graph Section for Admins -->
                        <div class="col-md-8 mb-4">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h5>{{ __('Sales Overview') }}</h5>
                                </div>
                                <div class="card-body">
                                    <p>{{ __('Visualize the sales data over the past months.') }}</p>

                                    <!-- CoreUI Chart -->
                                    <div id="admin-chart" style="height: 300px;">
                                        <canvas id="coreui-chart"></canvas>
                                    </div>
                                    <!-- Placeholder for CoreUI Chart -->
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <!-- Gráfico de Movimentações de Produtos -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5>Movimentações de Produtos</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="movementsChart" width="300" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- Gráfico de Solicitações -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5>Solicitações de Produtos</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="requestsChart" width="300" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico de Estoque Atual ocupando todo o espaço -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5>Estoque Atual</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="stockChart" width="400" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Gráfico de Movimentações de Produtos
            fetch("{{ route('movements.chartData') }}")
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('movementsChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels, 
                            datasets: [
                                {
                                    label: 'Entradas',
                                    data: data.entradas,  
                                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Saídas',
                                    data: data.saidas,  
                                    backgroundColor: 'rgba(255, 99, 132, 0.7)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error("Erro ao carregar os dados:", error));

            // Gráfico de Solicitações
            fetch("{{ route('requests.chartData') }}")
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('requestsChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'pie', // Tipo de gráfico: pie para um gráfico circular
                        data: {
                            labels: data.labels, // Status das solicitações
                            datasets: [{
                                label: 'Solicitações',
                                data: data.data, // Quantidade das solicitações por status
                                backgroundColor: ['rgba(75, 192, 192, 0.7)', 'rgba(255, 99, 132, 0.7)', 'rgba(255, 159, 64, 0.7)'], // Cores para cada status
                                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 159, 64, 1)'], // Cor das bordas
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.raw + ' solicitações'; // Exibe a quantidade no tooltip
                                        }
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error("Erro ao carregar os dados de solicitações:", error));

            // Gráfico de Estoque Atual
            fetch("{{ route('stock.chartData') }}")
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('stockChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',  // Tipo de gráfico: barra
                        data: {
                            labels: data.labels, // Produtos
                            datasets: [{
                                label: 'Quantidade em Estoque',
                                data: data.quantities,  // Quantidades em estoque
                                backgroundColor: 'rgba(54, 162, 235, 0.7)', // Cor de fundo
                                borderColor: 'rgba(54, 162, 235, 1)', // Cor da borda
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error("Erro ao carregar os dados de estoque:", error));
        });
    </script>
@endsection
