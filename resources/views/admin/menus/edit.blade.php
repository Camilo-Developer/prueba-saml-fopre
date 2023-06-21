@extends('layouts.app')
@section('title', 'editar menu')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Menu: {{$menu->nombre_menu}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.menus.index')}}">Listar Menu</a></li>
                        <li class="breadcrumb-item active">Editar Menu</li>
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
                    @if(auth()->user()->hasRole('Admin'))
                        <div class="col-12">
                            <form action="{{route('admin.menus.update',$menu)}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="nombre_menu">Nombre de su menu:</label>
                                    <input type="text" class="form-control form-control-border" id="nombre_menu" name="nombre_menu" value="{{$menu->nombre_menu}}">
                                </div>
                                <div class="form-group">
                                    <label for="estado_id">Seleccionar Estado del Menu:</label>
                                    <select class="custom-select form-control-border" name="estado_id" id="estado_id">
                                        <option  value="{{$menu->state->id}}">{{$menu->state->nombre_estado}}</option>
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}">{{$state->nombre_estado}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="estado_id">Seleccionar Empresa del Menu:</label>
                                    <select class="custom-select form-control-border empresa-select" name="company_id" id="company_id">
                                        <option value="{{$menu->company->id}}" selected>{{$menu->company->nombre_empresa}}</option>
                                        @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{$company->nombre_empresa}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="producto_id">Selección de Productos para el Menu:</label>
                                    <select class="custom-select form-control-border producto-select" name="producto_id" id="producto_id">
                                        <option selected>--Seleccionar Producto--</option>
                                    </select>
                                </div>
                                <br>
                                <div class=" row">
                                    <div class="col-12">
                                        <div class="form-group ">
                                            <button type="button" id="agregar" class="btn btn-success float-right mb-4">Agregar producto</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-tools">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar Producto">
                                                        <div class="input-group-append">
                                                            <a  class="btn btn-default">
                                                                <i class="fas fa-search"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body table-responsive p-3">
                                                <table class="table table-hover text-nowrap" id="detalles">
                                                    <thead class="text-center">
                                                    <tr >
                                                        <th>Nombre Producto</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="text-center">
                                                    @foreach($menu->products as $product)
                                                        @php
                                                            $nombre = str_replace(' ','', $product->nombre_producto);
                                                        @endphp
                                                        <tr id="fila{{$nombre}}">
                                                            <td><input type="hidden" name="producto_id[]" value="{{$product->id}}" />{{$product->nombre_producto}}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger btn-sm" onclick="eliminar('{{$nombre}}');"><i class="fa fa-times"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Editar Menu</button>
                                <a href="{{route('admin.menus.index')}}" class="btn btn-block bg-gradient-danger btn-lg">Cancelar</a>
                            </form>
                        </div>
                    @else
                        <div class="col-12">
                            <form action="{{route('admin.menus.update',$menu)}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="nombre_menu">Nombre de su menu:</label>
                                    <input type="text" class="form-control form-control-border" id="nombre_menu" name="nombre_menu" value="{{$menu->nombre_menu}}">
                                </div>
                                <div class="form-group">
                                    <label for="estado_id">Seleccionar Estado del Menu:</label>
                                    <select class="custom-select form-control-border" name="estado_id" id="estado_id">
                                        <option  value="{{$menu->state->id}}">{{$menu->state->nombre_estado}}</option>
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}">{{$state->nombre_estado}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nombre_menu">Empresa responsable:</label>
                                    <input type="hidden" class="form-control form-control-border" value="{{$menu->company->id}}">
                                    <input disabled type="text" class="form-control form-control-border" value="{{$menu->company->nombre_empresa}}">
                                </div>
                                <div class="form-group">
                                    <label for="producto_id">Selección de Productos para el Menu:</label>
                                    <select class="custom-select form-control-border" name="producto_id" id="producto_id">
                                        <option selected>--Seleccionar Producto--</option>
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}">{{$product->nombre_producto}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class=" row">
                                    <div class="col-12">
                                        <div class="form-group ">
                                            <button type="button" id="agregar" class="btn btn-success float-right mb-4">Agregar producto</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="card-tools">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar Producto">
                                                        <div class="input-group-append">
                                                            <a  class="btn btn-default">
                                                                <i class="fas fa-search"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body table-responsive p-3">
                                                <table class="table table-hover text-nowrap" id="detalles">
                                                    <thead class="text-center">
                                                    <tr >
                                                        <th>Nombre Producto</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="text-center">
                                                    @foreach($menu->products as $product)
                                                        @php
                                                            $nombre = str_replace(' ','', $product->nombre_producto);
                                                        @endphp
                                                        <tr id="fila{{$nombre}}">
                                                            <td><input type="hidden" name="producto_id[]" value="{{$product->id}}" />{{$product->nombre_producto}}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger btn-sm" onclick="eliminar('{{$nombre}}');"><i class="fa fa-times"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Editar Menu</button>
                                <a href="{{route('admin.menus.index')}}" class="btn btn-block bg-gradient-danger btn-lg">Cancelar</a>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        // Obtener los elementos select de empresas y productos
        var empresaSelect = document.querySelector('.empresa-select');
        var productoSelect = document.querySelector('.producto-select');

        // Copia de los productos originales
        var originalProductos = {!! $products !!};

        // Evento onChange para el select de empresas
        empresaSelect.addEventListener('change', function() {
            var selectedCompanyId = empresaSelect.value;

            // Filtrar los productos por la empresa seleccionada
            var filteredProductos = originalProductos.filter(function(producto) {
                return producto.company_id == selectedCompanyId;
            });

            // Limpiar el select de productos
            productoSelect.innerHTML = '<option selected>--Seleccionar Producto--</option>';

            // Agregar las opciones de productos filtrados al select
            filteredProductos.forEach(function(producto) {
                var option = document.createElement('option');
                option.value = producto.id;
                option.textContent = producto.nombre_producto;
                productoSelect.appendChild(option);
            });
        });

        // Obtener el ID de la empresa seleccionada por defecto
        var defaultCompanyId = empresaSelect.value;

        // Filtrar los productos por la empresa seleccionada por defecto
        var defaultFilteredProductos = originalProductos.filter(function(producto) {
            return producto.company_id == defaultCompanyId;
        });

        // Agregar las opciones de productos filtrados por defecto al select
        defaultFilteredProductos.forEach(function(producto) {
            var option = document.createElement('option');
            option.value = producto.id;
            option.textContent = producto.nombre_producto;
            productoSelect.appendChild(option);
        });
    </script>


@endsection
