@extends('layouts.app-c-senek')
@section('title', 'Crear Modalidad')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nuevo Modalidad</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Nuevo Modalidad</li>
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
                        <form action="{{route('modalities.store')}}" method="post" enctype="multipart/form-data" >
                            @csrf
                            @method('Post')
                            <div class="grid grid-cols-1 mt-5 mx-7">
                                <img id="imagenSeleccionada" style="max-height: 300px;">
                            </div>
                            <label >Seleccione una imagen::</label>
                            <div class="custom-file mb-2">
                                <input type="file" class="custom-file-input" name="img_modality" id="img_modality" >
                                <label class="custom-file-label" for="img_modality" >Seleccione una imagen:</label>
                            </div>
                            <div class="form-group">
                                <label for="name_modality">Nombre de su modalidad:</label>
                                <input type="text" class="form-control form-control-border name_modality" id="name_modality" name="name_modality" placeholder="Nombre de su modalidad">
                            </div>
                            <div class="form-group">
                                <label for="observations_modality">Descripción de su modalidad:</label>
                                <textarea class="form-control" id="observations_modality" name="observations_modality" rows="3" style="border-top: none; border-left: none; border-right: none;"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="categories">Seleccionar Categorias:</label>
                                <select class="categories form-control" name="categories[]" id="categories" multiple="multiple">
                                  </select>
                            </div>
                            <div class="form-group">
                                <label for="sizes">Seleccionar Tallas:</label>
                                <select class="sizes form-control" name="sizes[]" id="sizes" multiple="multiple">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="transports">Seleccionar Medios de Transporte:</label>
                                <select class="transports form-control" name="transports[]" id="transports" multiple="multiple">
                                  </select>
                            </div>
                            <div class="form-group">
                                <label for="state_id">Seleccionar Estado de la Modalidad:</label>
                                <select class="custom-select form-control-border" name="state_id" id="state_id">
                                    <option selected>--Seleccionar Estado--</option>
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}">{{$state->nombre_estado}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Crear modalidad</button>
                            <a href="{{route('products.index')}}" class="btn btn-block bg-gradient-danger btn-lg">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function (e) {
            $('#img_modality').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#imagenSeleccionada').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

            $('#categories').select2({
                placeholder: 'select',
                allowClear:true,
                ajax: {
                    url: '{{ route('buscar-categorias') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            name_category: params.term,
                            "_token":"{{ csrf_token() }}",
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name_category
                                }
                            })
                        };
                    },
                    cache: true
                },
                placeholder: 'Selecciona un elemento',
                minimumInputLength: 1,
            });

            $('#sizes').select2({
                placeholder: 'select',
                allowClear:true,
                ajax: {
                    url: '{{ route('buscar-tallas') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            name_size: params.term,
                            "_token":"{{ csrf_token() }}",
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name_size
                                }
                            })
                        };
                    },
                    cache: true
                },
                placeholder: 'Selecciona un elemento',
                minimumInputLength: 1,
            });

            $('#transports').select2({
                placeholder: 'select',
                allowClear:true,
                ajax: {
                    url: '{{ route('buscar-transportes') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            name_transport: params.term,
                            "_token":"{{ csrf_token() }}",
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name_transport
                                }
                            })
                        };
                    },
                    cache: true
                },
                placeholder: 'Selecciona un elemento',
                minimumInputLength: 1,
            });

        });
    </script>
@endsection
