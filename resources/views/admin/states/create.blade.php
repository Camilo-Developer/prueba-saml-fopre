@extends('layouts.app')
@section('title', 'Crear Estado')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nuevo Estado</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Nuevo Estado</li>
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
                    <div class="col-12">
                        <form action="{{route('admin.states.store')}}" method="post" >
                            @csrf
                            @method('Post')
                            <div class="form-group">
                                <label for="nombre_estado">Nombre de su Estado:</label>
                                <input type="text" class="form-control form-control-border" id="nombre_estado" name="nombre_estado" placeholder="Nombre estado">
                            </div>
                            <div>
                                @error('nombre_estado')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="color">Color de su estado:</label>
                                <input type="color" class="form-control form-control-border" id="color" name="color" placeholder="Color">
                            </div>
                            <div>
                                @error('color')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Elija el tipo de su estado:</label>
                            @foreach($typestates as $typestate)
                                    <div class="form-check">
                                        <input class="form-check-input" value="{{$typestate->id}}"  type="radio" name="type_state_id">
                                        <label class="form-check-label">{{$typestate->name}}</label>
                                    </div>
                            @endforeach
                            </div>
                            <div>
                                @error('type_state_id')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Crear estado</button>
                            <a href="{{route('admin.states.index')}}" class="btn btn-block bg-gradient-danger btn-lg">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
