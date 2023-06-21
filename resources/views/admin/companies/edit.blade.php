@extends('layouts.app')
@section('title', 'Editar producto')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Empresa:  {{$company->nombre_empresa}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.companies.index')}}">Listar Empresa</a></li>
                        <li class="breadcrumb-item active">Editar Empresa</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!--Contenido- Formulario-->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon">
                            <img src="{{ asset('storage/companies/' . $company->nombre_empresa . '/' . $company->imagen_company) }}" class="img-companies-admin" id="img_select_company" width="70px" height="64px" >
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-number" id="name_country">{{$company->nombre_empresa}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card card-default color-palette-box">
                        <div class="card-body">
                            <div class="col-12">
                                <form action="{{route('admin.companies.update',$company)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <label >Seleccione una imagen:</label>
                                    <div class="custom-file mb-2">
                                        <input type="file" class="custom-file-input" name="imagen_company" id="imagen_company" title="" value="{{$company->imagen_company}}">
                                        <label class="custom-file-label" for="imagen_company" >Seleccione una imagen:</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre_empresa">Nombre de su Empresa:</label>
                                        <input onkeyup="show_name_country(this.value)" type="text" class="form-control form-control-border" id="nombre_empresa" name="nombre_empresa" value="{{$company->nombre_empresa}}" placeholder="Nombre de su Empresa">
                                    </div>

                                    <div class="form-group">
                                        <label for="nit">Nit de su empresa:</label>
                                        <input  value="{{$company->nit}}" type="text" class="form-control form-control-border" id="nit" name="nit" placeholder="Nit de su Empresa">
                                    </div>
                                    <div class="form-group">
                                        <label for="razon_social">Razón Social de su empresa:</label>
                                        <input value="{{$company->razon_social}}"  type="text" class="form-control form-control-border" id="razon_social" name="razon_social" placeholder="Razón Social de su Empresa">
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion_correspondencia">Dirección Correspondencia de su empresa:</label>
                                        <input value="{{$company->direccion_correspondencia}}"  type="text" class="form-control form-control-border" id="direccion_correspondencia" name="direccion_correspondencia" placeholder="Dirección Correspondencia de su Empresa">
                                    </div>
                                    <div class="form-group">
                                        <label for="correo_correspondencia">Correo Correspondencia de su empresa:</label>
                                        <input value="{{$company->correo_correspondencia}}"  type="text" class="form-control form-control-border" id="correo_correspondencia" name="correo_correspondencia" placeholder="Correo Correspondencia de su Empresa">
                                    </div>
                                    <div class="form-group">
                                        <label for="celular_correspondencia">Celular Correspondencia de su empresa:</label>
                                        <input value="{{$company->celular_correspondencia}}"  type="text" class="form-control form-control-border" id="celular_correspondencia" name="celular_correspondencia" placeholder="Celular Correspondencia de su Empresa">
                                    </div>
                                    <div class="form-group">
                                        <label for="ubicacion">Ubicación en Campus de su empresa:</label>
                                        <input value="{{$company->ubicacion}}"  type="text" class="form-control form-control-border" id="ubicacion" name="ubicacion" placeholder="Ubicación en Campus de su Empresa">
                                    </div>

                                    <div class="form-group">
                                        <label for="producto_id">Selección de Usuario Responsable:</label>
                                        <select class="custom-select form-control-border" name="usuario_id" id="usuario_id">
                                            <option value="{{$company->user->id}}" selected>{{$company->user->name}} {{$company->user->lastname}}</option>>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}} {{$user->lastname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="estado_id">Seleccion de Estado para la Empresa:</label>
                                        <select class="custom-select form-control-border" name="estado_id" id="estado_id">
                                            <option value="{{$company->state->id}}" selected>{{$company->state->nombre_estado}}</option>
                                            @foreach($states as $state)
                                                <option value="{{$state->id}}">{{$state->nombre_estado}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Editar Empresa</button>
                                    <a href="{{route('admin.companies.index')}}" class="btn btn-block bg-gradient-danger btn-lg">Cancelar</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function (e) {
            $('#imagen_company').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#img_select_company').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });

        function show_name_country(valor){
            document.getElementById("name_country").innerHTML=valor;
        }
    </script>
@endsection
