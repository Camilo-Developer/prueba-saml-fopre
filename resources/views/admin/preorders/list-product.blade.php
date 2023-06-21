@extends('layouts.app')
@section('title', 'Crear Pedido Anticipado')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nuevo Pedido Anticipado</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Seleccion de Empresas</a></li>
                        <li class="breadcrumb-item active">Pedido Anticipado</li>
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
                    <div>
                        <label for="">Seleccione la empresa para su pedido.</label>
                    </div>
                    <div>
                        <div class="row ">

                        </div>
                    </div>



                </div>
            </div>
        </div>
    </section>
@endsection
