@extends('layouts.app')
@section('title', 'Editar Usuario')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Datos del Usuario</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Listado Usuarios</a></li>
                        <li class="breadcrumb-item active">Editar Usuario</li>
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
                        <form action="{{route('admin.users.update',$user)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nombre_usuario">Nombre de su Usuario:</label>
                                <input type="text" class="form-control form-control-border" id="nombre_usuario" name="name" value="{{$user->name}}">
                            </div>
                            <div class="form-group">
                                <label for="apellido_usuario">Apellido de su Usuario:</label>
                                <input type="text" class="form-control form-control-border" id="apellido_usuario" name="lastname" value="{{$user->lastname}}">
                            </div>
                            <div class="form-group">
                                <label for="email_usuario">Email de su Usuario:</label>
                                <input type="email" class="form-control form-control-border" id="email_usuario" name="email" value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                                <label for="password_usuario">Contraseña de su Usuario:</label>
                                <input type="password" class="form-control form-control-border" id="password_usuario" name="password" placeholder="Nueva Contraseña del Usuario">
                            </div>
                            <div class="form-group">
                                <label for="identity_card">Numero de Identificación de su Usuario:</label>
                                <input type="text" class="form-control form-control-border" id="identity_card" name="identity_card" value="{{$user->identity_card}}">
                            </div>

                            <div class="form-group">
                                <label for="estado_id">Estado del Usuario:</label>
                                <select class="custom-select form-control-border" name="estado_id" id="estado_id">
                                    <option  value="{{$user->state->id}}" >{{$user->state->nombre_estado}}</option>
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}">{{$state->nombre_estado}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="estado_id"  >Rol del Usuario:</label>
                                @foreach($roles as $role)
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" name="roles[]" type="checkbox" value="{{$role->id}}" @if(in_array($role->id,$roles_user)) checked @endif id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{$role->name}}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Editar Usuario</button>
                            <a href="{{route('admin.users.index')}}" class="btn btn-block bg-gradient-danger btn-lg">Cancelar</a>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
