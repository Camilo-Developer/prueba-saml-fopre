@extends('layouts.app')
@section('title', 'Menu')
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
                    <h1>Lista de Menus</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Lista de Menus</li>
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
                            @can('admin.menus.create')
                            <a href="{{route('admin.menus.create')}}" title="Crear Menu" class="new-mas"><i class="fas fa-plus"></i></a>
                            @endcan
                            <div class="card-tools">
                                <div class="input-group input-group-sm buq-menu">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar Menu">

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
                                    <th>Nombre del Producto</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($menus as $menu)
                                    <tr class="text-center">
                                        <td><a class="text-decoration-none " href="{{route('admin.menus.show',$menu)}}">{{$menu->nombre_menu}}</a></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                @can('admin.menus.destroy')
                                                <form method="post" action="{{route('admin.menus.destroy', $menu)}}" id="eliminarmenu_{{ $loop->iteration }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a title="Eliminar" onclick="document.getElementById('eliminarmenu_{{ $loop->iteration }}').submit()" class="  btn btn-danger btn-company-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                                @endcan
                                                <a title="Editar" href="{{route('admin.menus.edit',$menu)}}"
                                                   class="me-2 btn btn-warning btn-company-danger">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{route('admin.menus.show',$menu)}}"
                                                   class=" btn btn-success"><i class="fas fa-eye"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
