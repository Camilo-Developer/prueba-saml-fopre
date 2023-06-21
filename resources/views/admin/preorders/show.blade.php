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
                    <h1>Ver detalle del Pedido {{$preorder->fecha}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.preorders.index')}}">Lista de Pedidos pendientes</a></li>
                        <li class="breadcrumb-item active">Ver detalle del Pedido {{$preorder->fecha}}</li>
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
                        <div class="card-header ">
                            <div class="float-right">

                                <a href="{{route('admin.preorders.create')}}" title="Crear Pedido Anticipado" class="new-mas"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-3">
                            @php
                                $fecha = $preorder->fecha_claim;
                                $fechaVisual = \Carbon\Carbon::parse($fecha)->format('F d, Y - H:i');
                            @endphp
                            <label class="h4">Detalle de Compra</label>
                            <dl class="row">
                                <dt class="col-sm-4">Fecha: </dt>
                                <dd class="col-sm-8">{{$preorder->fecha}}</dd>
                                <dt class="col-sm-4">Dependencia:</dt>
                                <dd class="col-sm-8">{{$preorder->dependence}}</dd>
                                <dt class="col-sm-4">Nombre quien recibe:</dt>
                                <dd class="col-sm-8">{{$preorder->user->name}} {{$preorder->user->lastname}}</dd>
                                <dt class="col-sm-4">Correo usuario:</dt>
                                <dd class="col-sm-8">{{$preorder->user->email}}</dd>
                                <dt class="col-sm-4">Extensión usuario:</dt>
                                <dd class="col-sm-8">{{$preorder->extension}}</dd>
                                <dt class="col-sm-4">Centro de costo:</dt>
                                <dd class="col-sm-8">{{$preorder->cost_center}}</dd>
                                <dt class="col-sm-4">Fecha entrega:</dt>
                                <dd class="col-sm-8">{{$fechaVisual}}</dd>
                                <dt class="col-sm-4">Empresa:</dt>
                                <dd class="col-sm-8">{{$preorder->company->nombre_empresa}}</dd>
                                <dt class="col-sm-4" >Observaciones:</dt>
                                <dd class="col-sm-8">{{$preorder->observations}}</dd>
                            </dl>
                            <label class="h4">Productos de la compra</label>
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr class="text-center">
                                    <th >Producto</th>
                                    <th>Precio</th>
                                    <th>Fecha entrega</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($preorder->products as $product )
                                    @php
                                        $fecha = $product->pivot->pivotParent->fecha_claim;
                                        $fechaVisualProduct = \Carbon\Carbon::parse($fecha)->format('F d, Y - H:i');
                                    @endphp
                                    <tr class="text-center">

                                        <td>
                                            <img width="50px" src="/imagen/{{$product->imagen_producto}}" alt="">
                                            {{$product->nombre_producto}}
                                        </td>
                                        <td>$ {{number_format(intval($product->precio_producto))}} COP</td>
                                        <td>{{$fechaVisualProduct}}</td>
                                        <td>{{$product->pivot->quantity}}</td>
                                        <td>$ {{number_format(intval($product->pivot->subtotal))}} COP</td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
