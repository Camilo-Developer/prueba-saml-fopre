@extends('layouts.app')
@section('title', 'Editar Rol')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Rol: {{$role->name}} </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.roles.index')}}">Listar Roles</a></li>
                        <li class="breadcrumb-item active">Editar Rol</li>
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
                        <form action="{{route('admin.roles.update',$role)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nombre-role">Nuevo Nombre de su Rol:</label>
                                <input type="text" class="form-control form-control-border" id="nombre-role" name="name" value="{{$role->name}}">
                            </div>
                        @foreach($permissions as $permission)
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="permissions[]" type="checkbox" value="{{$permission->id}}" @if(in_array($permission->id, $permisos)) checked @endif id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                                {{$permission->description}}
                                            </label>
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Editar Estado</button>
                            <a href="{{route('admin.roles.index')}}" class="btn btn-block bg-gradient-danger btn-lg">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
