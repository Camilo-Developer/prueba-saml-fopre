@extends('layouts.app')
@section('title', 'Crear Usuario')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nuevo Usuario</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Nuevo Usuario</li>
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
                        <form action="{{route('admin.users.store')}}" method="post">
                            @csrf
                            @method('Post')
                            <div class="form-group">
                                <label for="nombre_usuario">Nombre de su Usuario:</label>
                                <input type="text" class="form-control form-control-border" id="nombre_usuario" name="name" placeholder="Nombre del Usuario">
                            </div>
                            <div class="form-group">
                                <label for="apellido_usuario">Apellido de su Usuario:</label>
                                <input type="text" class="form-control form-control-border" id="apellido_usuario" name="lastname" placeholder="Apellido del Usuario">
                            </div>
                            <div class="form-group">
                                <label for="email_usuario">Email de su Usuario:</label>
                                <input type="email" class="form-control form-control-border" id="email_usuario" name="email" placeholder="Example@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password_usuario">Contraseña de su Usuario:</label>
                                <input type="password" class="form-control form-control-border" id="password_usuario" name="password" placeholder="Contraseña del Usuario">
                            </div>
                            <div class="form-group">
                                <label for="identity_card">Numero de Identificación de su Usuario:</label>
                                <input type="text" class="form-control form-control-border" id="identity_card" name="identity_card" placeholder="Numero identificación del usuario">
                            </div>

                            <div class="form-group">
                                <label for="estado_id">Estado del Usuario:</label>
                                <select class="custom-select form-control-border" name="estado_id" id="estado_id">
                                    <option selected>--Seleccionar Estado--</option>
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}">{{$state->nombre_estado}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="role">Rol del Usuario:</label>
                                <select class="custom-select form-control-border" name="roles[]" id="role">
                                    <option selected>--Seleccionar Rol--</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Crear Usuario</button>
                            <a href="{{route('admin.users.index')}}" class="btn btn-block bg-gradient-danger btn-lg">Cancelar</a>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
