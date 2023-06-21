@extends('layouts.app')
@section('title', 'Crear Reporte Ventas')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Reporte</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!--Contenido- Formulario-->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default color-palette-box">
                <div class="card-body">
                    <div class="col-12">
                        <div class="col-12 col-xxl-6">
                            <div class="mb-8">
                                <h2 class="mb-2">Ecommerce Dashboard</h2>
                                <h5 class="text-700 fw-semi-bold">Here’s what’s going on at your business right now</h5>
                            </div>
                            <div class="row align-items-center g-4">
                                <div class="col-12 col-md-auto">
                                    <div class="d-flex align-items-center"><img src="/imagen/objetivo.png" alt=""
                                            height="46" width="46">
                                        <div class="ms-3">
                                            <h4 class="mb-0">$50.000</h4>
                                            <p class="text-800 fs--1 mb-0">Meta Donación</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto">
                                    <div class="d-flex align-items-center"><img src="/imagen/ventas.png" alt=""
                                            height="46" width="46">
                                        <div class="ms-3">
                                            <h4 class="mb-0">${{ number_format($total_ventas) }}</h4>
                                            <p class="text-800 fs--1 mb-0">Ventas totales</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto">
                                    <div class="d-flex align-items-center"><img src="/imagen/donacion.png" alt=""
                                            height="46" width="46">
                                        <div class="ms-3">
                                            <h4 class="mb-0">${{ number_format($donacionEstimada) }}</h4>
                                            <p class="text-800 fs--1 mb-0">Donacion Estimada</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto">
                                    <div class="d-flex align-items-center"><img src="/imagen/descuento.png" alt=""
                                            height="46" width="46">
                                        <div class="ms-3">
                                            <h4 class="mb-0">%{{ $porcentajeCumplimiento }}</h4>
                                            <p class="text-800 fs--1 mb-0">Donacion</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="bg-200 mb-6 mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Ventas x día</h3>
                                    <canvas id="salesChart" style="height: 320px;"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <h3>Restaurantes por Ventas Acumuladas</h3>
                                    <canvas id="topCompaniesChart" style="height: 320px;"></canvas>
                                </div>


                            </div>
                        </div>
                        <hr class="bg-200 mb-6 mt-4">

                        <div class="col-12 col-xxl-6">
                            <div class="mb-8">
                                <h2 class="mb-2">Ecommerce Dashboard</h2>
                                <h5 class="text-700 fw-semi-bold">Here’s what’s going on at your business right now</h5>
                            </div>
                            <div class="row align-items-center g-4">
                                <div class="col-12 col-md-auto">
                                    <div class="d-flex align-items-center"><img src="/imagen/orden.png" alt=""
                                            height="46" width="46">
                                        <div class="ms-3">
                                            <h4 class="mb-0">${{ number_format($pedido_anticipado) }}</h4>
                                            <p class="text-800 fs--1 mb-0">Pedidos anticipados</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="bg-200 mb-6 mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Ventas x día</h3>
                                    <canvas id="salesChart" style="height: 320px;"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <h3>Top 10 Compañías por Ventas Acumuladas</h3>
                                    <canvas id="topCompaniesChart" style="height: 320px;"></canvas>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

@section('js')
    <script>
        var labels = {!! json_encode($fecha) !!};
        var data = {!! json_encode($total_amount) !!};

        var ctx = document.getElementById('salesChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar', // Cambia el tipo de gráfico a "bar"
            data: {
                labels: labels,
                datasets: [{
                    label: 'Ventas',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 203, 0.8)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var companyLabels = {!! json_encode($companyLabels) !!};
        var totalAmounts = {!! json_encode($totalAmounts) !!};

        var topCompaniesChartCtx = document.getElementById('topCompaniesChart').getContext('2d');
        var topCompaniesChart = new Chart(topCompaniesChartCtx, {
            type: 'horizontalBar',
            data: {
                labels: companyLabels,
                datasets: [{
                    label: 'Ventas Acumuladas',
                    data: totalAmounts,
                    backgroundColor: 'rgba(255, 192, 203, 1)', // Color rosa sólido
                    borderColor: 'rgba(255, 105, 180, 1)', // Color rosa para el borde
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Top 10 Compañías por Ventas Acumuladas'
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
