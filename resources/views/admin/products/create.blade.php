@extends('layouts.app')
@section('title', 'Crear productos')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nuevo Producto</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Nuevo Producto</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!--Contenido- Formulario-->
    <section class="content">
        <div class="container-fluid">
            <div class="row">


                    @if(auth()->user()->hasRole('Admin'))
                    <div class="col-md-3">
                        <div class="card ">
                            <img src="/imagen/prueba.gif" id="imagenSeleccionada" class="card-img-top img-fluid" width="17px" height="27px">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold" id="resul_name_product">Nombre del Producto</h5>
                                <p class="card-text pt-3" id="resul_description_product">Descripción del Producto.</p>
                                <div class="d-flex flex-row-reverse">
                                    <p class="font-weight-bold">Precio:  <span id="resul_price_product"></span></p>
                                </div>
                                <div class="d-flex flex-row-reverse">
                                    <p class="font-weight-bold">Ipoconsumo:  <span id="resul_ipoconsumo"></span></p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted font-weight-bold">Empresa: <span id="resul_company_product"></span></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card card-default color-palette-box">
                            <div class="card-body">
                                <div class="col-12">
                                    <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data" >
                                        @csrf
                                        @method('Post')
                                        <label >Seleccione una imagen::</label>
                                        <div class="custom-file mb-2">
                                            <input type="file" class="custom-file-input" name="imagen_producto" id="imagen_producto" >
                                            <label class="custom-file-label" for="imagen_producto" >Seleccione una imagen:</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre_producto">Nombre de su producto:</label>
                                            <input onkeyup="show_name_product(this.value)" type="text" class="form-control form-control-border" id="nombre_producto" name="nombre_producto" placeholder="Nombre de su Producto">
                                        </div>
                                        <div class="form-group">
                                            <label for="descripcion_producto">Descripción de su producto:</label>
                                            <textarea onkeyup="show_description_product(this.value)" class="form-control descricption-product" id="descripcion_producto" name="descripcion_producto" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="precio_producto">Precio de su producto:</label>
                                            <input type="text" oninput="formatearNumero()" class="form-control form-control-border" id="precio_producto" name="precio_producto" placeholder="Precio de su Producto">
                                        </div>
                                        <div class="form-group">
                                            <label for="impoconsumo_producto">Ipoconsumo:</label>
                                            <input type="text" onkeyup="show_impo(this.value)" class="form-control form-control-border" id="impoconsumo_producto" name="impoconsumo_producto" placeholder="Ipoconsumo">
                                        </div>
                                        <div class="form-group">
                                            <label for="estado_id">Seleccionar la Empresa para su Producto:</label>
                                            <select onchange="mostrarValorSelect()" class="custom-select form-control-border" name="company_id" id="company_id">
                                                <option value="" selected>--Seleccionar Empresas--</option>
                                                @foreach($companies as $company)
                                                    <option value="{{$company->id}}">{{$company->nombre_empresa}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="state_id">Seleccione el estado del producto:</label>
                                            <select onchange="mostrarValorSelect()" class="custom-select form-control-border" name="state_id" id="state_id">
                                                <option value="" selected>--Seleccionar Estado--</option>
                                                @foreach($states as $state)
                                                    <option value="{{$state->id}}">{{$state->nombre_estado}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Crear Producto</button>
                                        <a href="{{route('admin.products.index')}}" class="btn btn-block bg-gradient-danger btn-lg">Cancelar</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-md-3">
                        <div class="card ">
                            <img src="/imagen/prueba.gif" id="imagenSeleccionada" class="card-img-top img-fluid" width="17px" height="27px">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold" id="resul_name_product">Nombre del Producto</h5>
                                <p class="card-text pt-3" id="resul_description_product">Descripción del Producto.</p>
                                <div class="d-flex flex-row-reverse">
                                    <p class="font-weight-bold">Precio:  <span id="resul_price_product"></span></p>
                                </div>
                                <div class="d-flex flex-row-reverse">
                                    <p class="font-weight-bold">Ipoconsumo:  <span id="resul_ipoconsumo"></span></p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted font-weight-bold">Empresa: {{auth()->user()->companys()->pluck('nombre_empresa')->first()}}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card card-default color-palette-box">
                            <div class="card-body">
                                <div class="col-12">
                                    <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data" >
                                        @csrf
                                        @method('Post')
                                        <label >Seleccione una imagen::</label>
                                        <div class="custom-file mb-2">
                                            <input type="file" class="custom-file-input" name="imagen_producto" id="imagen_producto" >
                                            <label class="custom-file-label" for="imagen_producto" >Seleccione una imagen:</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre_producto">Nombre de su producto:</label>
                                            <input onkeyup="show_name_product(this.value)" type="text" class="form-control form-control-border" id="nombre_producto" name="nombre_producto" placeholder="Nombre de su Producto">
                                        </div>
                                        <div class="form-group">
                                            <label for="descripcion_producto">Descripción de su producto:</label>
                                            <textarea onkeyup="show_description_product(this.value)" class="form-control descricption-product" id="descripcion_producto" name="descripcion_producto" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="precio_producto">Precio de su producto:</label>
                                            <input type="text" oninput="formatearNumero()" class="form-control form-control-border" id="precio_producto" name="precio_producto" placeholder="Precio de su Producto">
                                        </div>
                                        <div class="form-group">
                                            <label for="impoconsumo_producto">Ipoconsumo:</label>
                                            <input type="text" onkeyup="show_impo(this.value)" class="form-control form-control-border" id="impoconsumo_producto" name="impoconsumo_producto" placeholder="Ipoconsumo">
                                        </div>
                                        <div class="form-group">
                                            <label for="impoconsumo_producto">Empresa asociada al producto:</label>
                                            <input type="hidden" value="{{auth()->user()->companys()->pluck('id')->first()}}" class="form-control form-control-border" id="company_id" name="company_id">
                                            <input disabled type="text" value="{{auth()->user()->companys()->pluck('nombre_empresa')->first()}}" class="form-control form-control-border"  placeholder="Empresa">
                                        </div>
                                        <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Crear Producto</button>
                                        <a href="{{route('admin.products.index')}}" class="btn btn-block bg-gradient-danger btn-lg">Cancelar</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

            </div>

        </div>
    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function (e) {
            $('#imagen_producto').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#imagenSeleccionada').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
        function show_impo(valor){
            document.getElementById("resul_ipoconsumo").innerHTML=valor + "%";
        }
        function show_name_product(valor){
            document.getElementById("resul_name_product").innerHTML=valor;
        }
        function show_description_product(valor){
            document.getElementById("resul_description_product").innerHTML=valor;
        }
        function show_price_product(valor){
            document.getElementById("resul_price_product").innerHTML="$" + valor + "COP";
        }
        function formatearNumero() {
            var input = document.getElementById('precio_producto');
            var valor = input.value;

            if (valor !== "") {
                var numero = parseFloat(valor);
                var numeroFormateado = numero.toLocaleString();
                var resultado = "$ " + numeroFormateado + " COP";
            } else {
                var resultado = "";
            }

            var resultadoElemento = document.getElementById('resul_price_product');
            resultadoElemento.textContent = resultado;
        }
        function mostrarValorSelect() {
            var select = document.getElementById('company_id');
            var valor = select.value;
            var resultado = document.getElementById('resul_company_product');

            if (valor !== "") {
                resultado.textContent =  valor;
            } else {
                resultado.textContent = "";
            }
        }
    </script>
@endsection
