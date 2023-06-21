@extends('layouts.app')
@section('title', 'Editar Estado')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Estado: {{$states->nombre_estado}} </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('states.index')}}">Listar Estado</a></li>
                        <li class="breadcrumb-item active">Editar Estado</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!--Contenido- Formulario-->
    <section class="content">
        <div class="container-fluid" style="width: 70%">
            <div class="card card-default color-palette-box">
                <div class="card-body">
                    <div class="col-12">
                        <form action="{{route('states.update',$states->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nombre_estado">Nuevo Nombre de su Estado:</label>
                                <input type="text" class="form-control form-control-border" id="nombre_estado" name="nombre_estado" value="{{$states->nombre_estado}}">
                            </div>
                            <div class="form-group">
                                <label for="color">Nuevo Color de su estado:</label>
                                <input type="color" class="form-control form-control-border" id="color" name="color" value="{{$states->color}}">
                            </div>
                            <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Editar Estado</button>
                            <a href="{{route('states.index')}}" class="btn btn-block bg-gradient-danger btn-lg">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
