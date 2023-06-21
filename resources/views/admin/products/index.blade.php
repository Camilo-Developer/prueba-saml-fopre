@extends('layouts.app')
@section('title', 'Listar productos')
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
                    <h1>Lista de Productos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Lista de Productos</li>
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
                            <a href="{{route('admin.products.create')}}" title="Crear Producto" class="new-mas"><i class="fas fa-plus"></i></a>
                            <a href="{{route('products.import')}}" title="Cargar Productos" class="new-mas" ><i class="fas fa-file-excel"></i></a>
                            <div class="card-tools">
                                <form action="{{ route('admin.products.index') }}" method="GET">
                                    <div class="input-group input-group-sm buq-products">
                                        <input value="{{ request('search') }}" type="search" name="search" class="form-control float-right" placeholder="Buscar Producto">
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
                            @if ($searchResults)
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr class="text-center">
                                    <th>Imagen Producto</th>
                                    <th>Nombre Producto</th>
                                    <th>descripcion Producto</th>
                                    <th>precio Producto</th>
                                    <th>Ipoconsumo</th>
                                    <th>Empresa</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr class="text-center">
                                        <td id="imagen_producto"><img src="/imagen/{{$product->imagen_producto}}" alt="" width="60px" height="60px"></td>
                                        <td id="nombre_producto">{{$product->nombre_producto}}</td>
                                        <td id="descripcion_producto" >{{$product->descripcion_producto}}</td>
                                        <td id="precio_producto">$ {{number_format(intval($product->precio_producto))}} COP</td>
                                        <td id="ipoconsumo">{{$product->impoconsumo_producto}}%</td>
                                        <td id="precio_producto">{{$product->company->nombre_empresa}}</td>
                                        <td id="precio_producto">{{$product->state->nombre_estado}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <form method="post" action="{{route('admin.products.destroy', $product)}}" id="eliminarproducto_{{ $loop->iteration }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a title="Eliminar" onclick="document.getElementById('eliminarproducto_{{ $loop->iteration }}').submit()" class="  btn btn-danger btn-company-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                                <a title="Editar" href="{{route('admin.products.edit',$product)}}"
                                                   class="me-2 btn btn-warning btn-company-danger">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{route('admin.products.show',$product)}}"
                                                   class=" btn btn-success"><i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                                <div class="alert alert-info text-center">
                                    No hay resultados para tu búsqueda.
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            @if(request('search'))
                                <button class="btn btn-secondary float-right" onclick="window.location.href='{{ route('admin.products.index') }}'">
                                    Borrar búsqueda
                                </button>
                            @endif
                            {!! $products->links() !!}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
