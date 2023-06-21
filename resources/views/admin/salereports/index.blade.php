@extends('layouts.app')
@section('title', 'Listar Reporte venta')
@section('content')
    @if (Session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (Session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (Session('edit'))
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            {{ session('edit') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lista de Reportes Ventas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Lista de Reportes Ventas</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.salereports.create') }}" title="Crear Reportes Ventas" class="new-mas"><i class="fas fa-plus"></i></a>
                            <div class="card-tools">
                                <div class="input-group input-group-sm buq-salereports">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Buscar Reporte de Ventas">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-3">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr class="text-center">
                                        <th>Fecha del Reporte</th>
                                        <th>Metodos de pago</th>
                                        <th>Total Vendido</th>
                                        <th>Empresa</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($salereports as $salereport)
                                        <tr class="text-center">
                                            <td>{{ $salereport['fecha'] }}</td>
                                            <td>
                                                @foreach ($salereport['payment_methods'] as $metodos)
                                                    {{ $metodos['name'] }}
                                                @endforeach
                                            </td>
                                            <td>${{ number_format(intval($salereport['sale_total_amount'])) }}</td>
                                            <td>{{ $salereport['company_id'] }}</td>
                                            <td>
                                                <div class="btn-group" role="group"
                                                    aria-label="Basic mixed styles example">
                                                    <form method="post"
                                                        action="{{ route('admin.salereports.destroy', $salereport['id']) }}"
                                                        id="eliminarsalereports_{{ $loop->iteration }}">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a title="Eliminar"
                                                        onclick="document.getElementById('eliminarsalereports_{{ $loop->iteration }}').submit()"
                                                        class="btn btn-danger btn-company-danger" >
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                    <a title="Editar"
                                                        href="{{ route('admin.salereports.edit', $salereport['id']) }}"
                                                        class="me-2 btn btn-warning btn-company-danger">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-success" data-toggle="modal" data-target="#saleReportModal{{ $loop->iteration }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p>Total de Montos: ${{ number_format(intval($totalAmount)) }}</p>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        @foreach ($salereports as $salereport)
        <div class="modal fade" id="saleReportModal{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="saleReportModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="saleReportModalLabel">Detalles del Reporte de Venta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí se mostrarán los detalles del reporte de venta -->
                        <p>Fecha: {{ $salereport['fecha'] }}</p>
                        <p>Empresa: {{ $salereport['company_id'] }}</p>
                        <p>Métodos de Pago:</p>
                        <ul>
                            @foreach ($salereport['payment_methods'] as $paymentMethod)
                                <li>{{ $paymentMethod['name'] }} - Monto: ${{ number_format(intval($paymentMethod['amount'])) }}</li>
                            @endforeach
                        </ul>
                        <p>Total Vendido: ${{ number_format(intval($salereport['sale_total_amount'])) }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </section>
    <!-- /.content -->
@endsection
