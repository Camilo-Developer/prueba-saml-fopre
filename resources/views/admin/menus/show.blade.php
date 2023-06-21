@extends('layouts.app')
@section('title', 'ver menu')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Nuevo Menu</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!--Contenido- Formulario-->
    <section class="content">
        <div class="container-fluid" >
            <div class="card card-default color-palette-box">
                <div class="card-body">
                    <h1>Detalles del Menu: {{$menu->nombre_menu}}</h1>
                    <label>Estado: {{$menu->state->nombre_estado}}</label><br>
                    <label>Empresa: {{$menu->company->nombre_empresa}}</label>
                    <div class="col-12">
                        <div class=" row">
                            <label>Listado de Productos Agregados al menu:</label>

                            <div class="col-12">
                                <div class="card">
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-3">
                                        <table class="table table-hover text-nowrap" id="detalles">
                                            <thead class="text-center">
                                            <tr >
                                                <th scope="col">Imagen Producto</th>
                                                <th scope="col">Nombre Producto</th>
                                                <th scope="col">precio Producto</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            @foreach($menu->products as $product)
                                                <tr>
                                                    <td><img src="/imagen/{{$product->imagen_producto}}" alt="" width="60px" height="60px"></td>
                                                    <td>{{$product->nombre_producto}}</td>
                                                    <td>$ {{number_format(intval($product->precio_producto))}} COP</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                            <a title="Editar" href="{{route('admin.products.edit',$product->id)}}"
                                                               class="me-2 btn btn-warning btn-company-danger">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="{{route('admin.products.show',$product->id)}}"
                                                               class=" btn btn-success"><i class="fas fa-eye"></i>
                                                            </a>

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
