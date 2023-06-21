@extends('layouts.app')
@section('title', 'Importar productos')
@section('content')
      <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Importar Productos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Importar Productos</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!--Contenido- Formulario-->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('products.import.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label >Seleccionar archivo:</label>
                        <div class="custom-file mb-2">
                            <input type="file" class="custom-file-input" name="file" id="file" >
                            <label class="custom-file-label" for="file" >Seleccionar archivo:</label>
                        </div>
                        <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Importar Productos</button>
                        <a href="{{route('admin.products.index')}}" class="btn btn-block bg-gradient-danger btn-lg">Cancelar</a>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection
