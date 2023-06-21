@extends('layouts.app')
@section('title', 'Crear menu')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nuevo Menu</h1>
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
        <div class="container-fluid">
            <div class="card card-default color-palette-box">
                <div class="card-body">
                    <div class="col-12">
                        <form action="{{route('admin.menus.store')}}" method="post">
                            @csrf
                            @method('Post')
                            <div class="form-group">
                                <label for="nombre_menu">Nombre de su menu:</label>
                                <input type="text" class="form-control form-control-border" id="nombre_menu" name="nombre_menu" placeholder="Nombre de su Menu">
                            </div>
                            <div class="form-group">
                                <label for="estado_id">Seleccionar Estado del Menu:</label>
                                <select class="custom-select form-control-border" name="estado_id" id="estado_id">
                                    <option selected>--Seleccionar Estado--</option>
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}">{{$state->nombre_estado}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="estado_id">Seleccionar Empresa del Menu:</label>
                                <select class="custom-select form-control-border empresa-select" name="company_id" id="company_id">
                                    <option selected>--Seleccionar Empresas--</option>
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

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer clearfix">
                                            <ul class="pagination pagination-sm m-0 float-right">
                                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Crear Menu</button>
                            <a href="{{route('admin.menus.index')}}" class="btn btn-block bg-gradient-danger btn-lg">Cancelar</a>
                        </form>
                    </div>
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
    </script>

@endsection
