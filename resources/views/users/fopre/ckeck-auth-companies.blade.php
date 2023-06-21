@extends('layouts.app')
@section('title', 'Cofirmacion Documentos - Empresas')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Validación de documentos: {{auth()->user()->companys()->pluck('nombre_empresa')->first()}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Validación de documentos</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!--Contenido- Formulario-->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default color-palette-box">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <img width="100px" class="img-fluid rounded-circle" src="https://w7.pngwing.com/pngs/731/105/png-transparent-computer-icons-task-management-virtual-assistant-symbol-symbol-miscellaneous-text-service.png" alt="">
                            </div>
                            <div class="text-center">Tus documentos estan siendo validados por el administrador.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
