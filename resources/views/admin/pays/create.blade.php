@extends('layouts.app')
@section('title', 'Crear Metodo Pago')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nuevo Metodo Pago</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Nuevo Metodo Pago</li>
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
                        <form action="{{route('admin.pays.store')}}" method="post">
                            @csrf
                            @method('Post')
                            <div class="form-group">
                                <label for="metodo_pago">Nombre de su Metodo pago:</label>
                                <input type="text" class="form-control form-control-border" id="metodo_pago" name="metodo_pago" placeholder="Nombre de su Metodo Pago">
                            </div>
                            <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Crear Metodo Pago</button>
                            <a href="{{route('admin.pays.index')}}" class="btn btn-block bg-gradient-danger btn-lg">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
