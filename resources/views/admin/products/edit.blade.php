@extends('layouts.app')
@section('title', 'Editar producto')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Producto: {{$product->nombre_producto}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.products.index')}}">Lista de Productos</a></li>
                        <li class="breadcrumb-item active">Editar Producto</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid" >
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <div class="card card-edit-product" >
                                    <img src="/imagen/{{$product->imagen_producto}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold text-center mb-2" >{{$product->nombre_producto}}</h5>
                                        <br>
                                        <label class="float-right" >{{$product->precio_producto}}</label>
                                        <p class="card-text">{{$product->descripcion_producto}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">

                    <div class="card card-default color-palette-box">
                        <div class="card-body">
                            <div class="col-12">
                                <form action="{{route('admin.products.update',$product)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid grid-cols-1 mt-5 mx-7">
                                        <img id="imagenSeleccionada" class="img-edit-product">
                                    </div>
                                    <label >Seleccione una imagen::</label>
                                    <div class="custom-file mb-2">
                                        <input type="file" class="custom-file-input" name="imagen_producto" id="imagen_producto">
                                        <label class="custom-file-label" for="imagen_producto">Seleccione una imagen:</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre_producto">Nombre de su producto:</label>
                                        <input type="text" class="form-control form-control-border" id="nombre_producto" name="nombre_producto" value="{{$product->nombre_producto}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion_producto">Descripción de su producto:</label>
                                        <textarea class="form-control" id="descripcion_producto" name="descripcion_producto" rows="3">{{$product->descripcion_producto}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="precio_producto">Precio de su producto:</label>
                                        <input type="text" class="form-control form-control-border" id="precio_producto" name="precio_producto" value="{{$product->precio_producto}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="impoconsumo_producto">Ipoconsumo:</label>
                                        <input type="text" class="form-control form-control-border" id="impoconsumo_producto" name="impoconsumo_producto" value="{{$product->impoconsumo_producto}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="estado_id">Seleccionar Empresa del Producto:</label>
                                        <select class="custom-select form-control-border" name="company_id" id="company_id">
                                            <option  value="{{$product->company->id}}" selected>{{$product->company->nombre_empresa}}</option>
                                            @foreach($companies as $company)
                                                <option value="{{$company->id}}">{{$company->nombre_empresa}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="state_id">Seleccionar Estado del Producto:</label>
                                        <select class="custom-select form-control-border" name="state_id" id="state_id">
                                            <option  value="{{$product->state->id}}" selected>{{$product->state->nombre_estado}}</option>
                                            @foreach($states as $state)
                                                <option value="{{$state->id}}">{{$state->nombre_estado}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Editar Producto</button>
                                    <a href="{{route('admin.products.index')}}" class="btn btn-block bg-gradient-danger btn-lg">Cancelar</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Contenido- Formulario-->
@endsection
@section('js')
    <script>
        $(document).ready(function (e) {
            $('#imagen_producto').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#imagenSeleccionada').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endsection
