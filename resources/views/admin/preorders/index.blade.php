@extends('layouts.app')
@section('title', 'Listar Empresas')
@section('content')
    @if(Session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(Session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(Session('edit'))
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            {{session('edit')}}
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
                    <h1>Lista de Pedidos anticipados Pendientes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Lista de Pedidos anticipados pendientes</li>
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
                            @can('admin.preorders.create')
                            <a href="{{route('admin.preorders.create')}}" title="Crear Empresa" class="new-mas"><i class="fas fa-plus"></i></a>
                            @endcan
                            <a href="{{route('admin.preorders.entregados')}}" class=" btn-preorders-entregadas btn btn-success btn-sm">Entregados</a>
                            <div class="card-tools">
                                <form action="" method="POST">
                                    <div class="input-group input-group-sm buq-preorders">
                                        <input type="text" id="search" class="form-control float-right" placeholder="Buscar pedidos anticipados">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-3">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr class="text-center">
                                    <th>Fecha Creación</th>
                                    <th>Estado</th>
                                    <th>Fecha entrega</th>
                                    <th>Dependencia</th>
                                    <th>Nombre centro de costo</th>
                                    <th>Total</th>
                                    <th>Nombre usuario compra</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($preorders as $preorder)
                                    @php
                                        $fecha1 = $preorder->fecha;
                                        $fechaVisual1 = \Carbon\Carbon::parse($fecha1)->format('F d, Y - g:i a');

                                        $fecha2 = $preorder->fecha_claim;
                                        $fechaVisual2 = \Carbon\Carbon::parse($fecha2)->format('F d, Y - g:i a');
                                    @endphp

                                    <tr class="text-center">
                                        <td>{{$fechaVisual1}}</td>
                                        <td><span class="badge rounded-pill text-white" style="background-color: {{$preorder->state->color}};">{{$preorder->state->nombre_estado}}</span></td>
                                        <td>{{$fechaVisual2}}</td>
                                        <td>{{$preorder->dependence}}</td>
                                        <td>{{$preorder->name_cost_center}}</td>
                                        <td>$ {{number_format(intval($preorder->total)) }}</td>
                                        <td>{{$preorder->user->name}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                @can('admin.preorders.destroy')
                                                <form method="post" action="{{route('admin.preorders.destroy', $preorder->id)}}" id="eliminarpreorder_{{ $loop->iteration }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a title="Eliminar" onclick="document.getElementById('eliminarpreorder_{{ $loop->iteration }}').submit()" class="  btn btn-danger btn-company-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                                @endcan
                                                <a title="Editar" href="{{route('admin.preorders.edit',[$preorder->id])}}"
                                                   class="me-2 btn btn-warning btn-company-danger" >
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{route('admin.preorders.show',$preorder->id)}}"
                                                   class=" btn btn-success"><i class="fas fa-eye"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{$preorders->links()}}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
