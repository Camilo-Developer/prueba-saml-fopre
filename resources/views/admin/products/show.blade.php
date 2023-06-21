@extends('layouts.app')
@section('title', 'Ver producto')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ver Producto: {{$product->nombre_producto}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">Lista de Productos</a></li>
                        <li class="breadcrumb-item active">Ver Producto</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid " >
            <div class="d-flex justify-content-center mt-lg-5" >
                <div class="card shadow  mb-5 bg-body rounded card-show-product">
                    <img src="/imagen/{{$product->imagen_producto}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold ">{{$product->nombre_producto}}</h5><br>
                        <label class="d-flex flex-row-reverse mt-2 mb-3">Precio: $ {{number_format(intval($product->precio_producto))}} COP</label>
                        <p class="card-text">
                            {{$product->descripcion_producto}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
