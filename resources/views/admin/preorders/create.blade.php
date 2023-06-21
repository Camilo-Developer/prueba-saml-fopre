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
                        <li class="breadcrumb-item active">Nuevo Pedido Anticipado</li>
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
                    @if(auth()->user()->hasRole('Admin'))
                        <form action="{{route('admin.preorders.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="fecha_claim">Creacion del pedido:</label>
                                <input type="datetime-local" readonly class="form-control form-control-border" name="fecha" id="datetime-input-create">
                            </div>
                            <div class="form-group">
                                <label >Estado del pedido:</label>
                                <input type="text" readonly class="form-control form-control-border" value="Pendiente">
                            </div>

                            <div class="form-group">
                                <label for="company_id">Selección una empresa:</label>
                                <select class="categories form-control" name="company_id[]" id="company_id" multiple="multiple"></select>
                            </div>



                            <div class="form-group">
                                <label for="product_id">Selecione un Producto:</label>
                                <select class="custom-select form-control-border" name="product_id" id="product_id">
                                    <option selected>--Seleccionar producto--</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->nombre_producto}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="hidden">
                                @foreach($products as $product)
                                    <input type="hidden" value="{{$product->precio_producto}}" id="precio_{{$product->id}}">
                                @endforeach
                            </div>
                            <div class=" row">
                                <div class="col-12">
                                    <div class="form-group ">
                                        <button type="button" id="agregar_preorder" class="btn btn-success float-right mb-4">Agregar producto</button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-tools">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar Producto">
                                                    <div class="input-group-append">
                                                        <a  class="btn btn-default">
                                                            <i class="fas fa-search"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-3">
                                            <table class="table table-hover text-nowrap" id="detalles_preorder">
                                                <thead class="text-center">
                                                <tr >
                                                    <th>Nombre Producto</th>
                                                    <th>Precio</th>
                                                    <th>Cantidad</th>
                                                    <th>subtotal</th>
                                                    <th>Acciones</th>
                                                </tr>
                                                </thead>
                                                <tbody class="text-center">

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer clearfix">
                                            <div class="float-right">
                                                <input type="hidden" id="total_value" name="total_value" value="">
                                                <p>Total: <span id="total">0</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="usuario_id">Nombre del cliente:</label>
                                <select class="categories form-control" name="usuario_id[]" id="usuario_id" multiple="multiple"></select>
                            </div>

                            <div class="form-group">
                                <label for="correo_usuario">Correo del cliente:</label>
                                <input type="text" class="form-control"  id="correo_usuario" readonly>
                            </div>
                            <div class="form-group">
                                <label for="dependence">Dependecia:</label>
                                <input type="text" class="form-control form-control-border" id="dependence" name="dependence" placeholder="Ingerese la Dependecia">
                            </div>
                            <div class="form-group">
                                <label for="cost_center">Centro de costo:</label>
                                <input type="text" class="form-control form-control-border" id="cost_center" name="cost_center" placeholder="Ingrese el centro de costo">
                            </div>
                            <div class="form-group">
                                <label for="name_cost_center">Nombre del centro de costo:</label>
                                <input type="text" class="form-control form-control-border" id="name_cost_center" name="name_cost_center" placeholder="Nombre del centro de costo">
                            </div>
                            <div class="form-group">
                                <label for="extension">Extensión:</label>
                                <input type="text" class="form-control form-control-border" id="extension" name="extension" placeholder="Ingrese la extensión del usuario">
                            </div>
                            <div class="form-group">
                                <label for="fecha_claim">Fecha de entrega del pedido:</label>
                                <input type="datetime-local" class="form-control form-control-border" id="fecha_claim" name="fecha_claim">
                            </div>
                            <div class="form-group">
                                <label for="observations">Observaciones:</label>
                                <input type="text" class="form-control form-control-border" id="observations" name="observations" placeholder="Nombre de su Menu">
                            </div>

                            <button type="submit" class="btn btn-success">Crear pedido</button>
                        </form>

                    @elseif(auth()->user()->hasRole('Empresa'))
                        <form action="{{route('admin.preorders.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="fecha_claim">Creacion del pedido:</label>
                                <input type="datetime-local" class="form-control form-control-border" name="fecha" id="datetime-input-create">
                            </div>
                                <input type="hidden" value="{{auth()->user()->companys()->pluck('id')->first()}}" name="company_id">
                                <p><label for="">Empresa:</label> {{auth()->user()->companys()->pluck('nombre_empresa')->first()}}</p>



                            <div class="form-group">
                                <label for="product_id">Selecione un Producto:</label>
                                <select class="custom-select form-control-border" name="product_id" id="product_id">
                                    <option selected>--Seleccionar producto--</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->nombre_producto}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="hidden">
                                @foreach($products as $product)
                                    <input type="hidden" value="{{$product->precio_producto}}" id="precio_{{$product->id}}">
                                @endforeach
                            </div>
                            <div class=" row">
                                <div class="col-12">
                                    <div class="form-group ">
                                        <button type="button" id="agregar_preorder" class="btn btn-success float-right mb-4">Agregar producto</button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-tools">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar Producto">
                                                    <div class="input-group-append">
                                                        <a  class="btn btn-default">
                                                            <i class="fas fa-search"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-3">
                                            <table class="table table-hover text-nowrap" id="detalles_preorder">
                                                <thead class="text-center">
                                                <tr >
                                                    <th>Nombre Producto</th>
                                                    <th>Precio</th>
                                                    <th>Cantidad</th>
                                                    <th>subtotal</th>
                                                    <th>Acciones</th>
                                                </tr>
                                                </thead>
                                                <tbody class="text-center">

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer clearfix">
                                            <div class="float-right">
                                                <input type="hidden" id="total_value" name="total_value" value="">
                                                <p>Total: <span id="total">0</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="usuario_id">Nombre del cliente:</label>
                                <select class="categories form-control" name="usuario_id[]" id="usuario_id" multiple="multiple"></select>
                            </div>

                            <div class="form-group">
                                <label for="correo_usuario">Correo del cliente:</label>
                                <input type="text" class="form-control" id="correo_usuario" readonly>
                            </div>
                            <div class="form-group">
                                <label for="dependence">Dependecia:</label>
                                <input type="text" class="form-control form-control-border" id="dependence" name="dependence" placeholder="Ingerese la Dependecia">
                            </div>
                            <div class="form-group">
                                <label for="cost_center">Centro de costo:</label>
                                <input type="text" class="form-control form-control-border" id="cost_center" name="cost_center" placeholder="Ingrese el centro de costo">
                            </div>
                            <div class="form-group">
                                <label for="name_cost_center">Nombre del centro de costo:</label>
                                <input type="text" class="form-control form-control-border" id="name_cost_center" name="name_cost_center" placeholder="Nombre del centro de costo">
                            </div>
                            <div class="form-group">
                                <label for="extension">Extensión:</label>
                                <input type="text" class="form-control form-control-border" id="extension" name="extension" placeholder="Ingrese la extensión del usuario">
                            </div>
                            <div class="form-group">
                                <label for="fecha_claim">Fecha de entrega del pedido:</label>
                                <input type="datetime-local" class="form-control form-control-border" id="fecha_claim" name="fecha_claim">
                            </div>
                            <div class="form-group">
                                <label for="observations">Observaciones:</label>
                                <input type="text" class="form-control form-control-border" id="observations" name="observations" placeholder="Nombre de su Menu">
                            </div>

                            <button type="submit" class="btn btn-success">Crear pedido</button>
                        </form>
                    @endif





                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            var cont = 0;
            $("#agregar_preorder").click(function() {
                agregar();
            });

            $(document).on('change', '.cantidad', function() {
                calcularSubtotal($(this));
                calcularTotal();
            });
        });

        function agregar() {
            var product = $("#product_id option:selected").text();
            var product_id = $("#product_id").val();
            var precio_productos = parseFloat($("#precio_" + product_id).val().replace(/[^\d.]/g, '').replace(/\./g, ''));

            if (product_id != "") {
                var fila = '<tr class="selected" id="fila' + cont + '">' +
                    '<td><input type="hidden" name="products['+ cont +'][id]" value="' + product_id + '">' + product + '</td>' +
                    '<td><input type="text" name="products['+ cont +'][precio]" class="form-control precio" value="' + parseInt(precio_productos) + '" readonly></td>' +
                    '<td><input type="number" name="products['+ cont +'][cantidad]" class="form-control cantidad" min="1" value="1"></td>' +
                    '<td><input type="text" name="products['+ cont +'][subtotal]" class="form-control subtotal" readonly></td>' +
                    '<td class="d-flex justify-content-center"><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont + ');"><i class="fa fa-times"></i></button></td>' +
                    '</tr>';
                cont++;
                $('#detalles_preorder tbody').append(fila);
                calcularSubtotal($('.cantidad:last'));

                calcularTotal();
            } else {
                Swal.fire({
                    type: 'error',
                    text: 'Rellene todos los campos del detalle de la compra',
                });
            }
        }

        function eliminar(index) {
            $("#fila" + index).remove();
            calcularTotal();
        }

        function calcularSubtotal(element) {
            var cantidad = element.val();
            var fila = element.closest('tr');
            var precio = parseFloat(fila.find('.precio').val().replace(/[^\d.]/g, '').replace(/\./g, ''));
            var subtotal = cantidad * precio;
            fila.find('.subtotal').val(formatCurrency(subtotal));
        }

        function calcularTotal() {
            var total = 0;
            $('.subtotal').each(function() {
                var subtotal = parseFloat($(this).val().replace(/[^\d.]/g, '').replace(/\./g, ''));
                if (!isNaN(subtotal)) {
                    total += subtotal;
                }
            });
            $('#total').text(formatCurrency(total));
            $('#total_value').val(total);
        }

        function formatCurrency(amount) {
            var formatter = new Intl.NumberFormat('es-CO', {
                style: 'currency',
                currency: 'COP',
                minimumFractionDigits: 0
            });

            return formatter.format(amount).replace(/COP/g, '$');
        }

        window.onload = function() {
            // Obtener el elemento de entrada
            var input = document.getElementById("datetime-input-create");

            // Obtener la fecha y hora actual
            var now = new Date();

            // Formatear la fecha y hora actual para el valor del campo
            var year = now.getFullYear();
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var day = ("0" + now.getDate()).slice(-2);
            var hours = ("0" + now.getHours()).slice(-2);
            var minutes = ("0" + now.getMinutes()).slice(-2);
            var formattedDateTime = year + "-" + month + "-" + day + "T" + hours + ":" + minutes;

            // Establecer el valor y desactivar la edición del campo
            input.value = formattedDateTime;
            input.disabled = true;
        };
    </script>
    <script>
        $(document).ready(function () {
            var usuarioIdSelect = $('#usuario_id');
            var correoUsuarioInput = $('#correo_usuario');

            var empresaIdSelect = $('#company_id');

            usuarioIdSelect.select2({
                placeholder: 'Selecciona un elemento',
                allowClear: true,
                ajax: {
                    url: '{{ route('buscar-usuario') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            usuario_id: params.term,
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name + ' ' + item.lastname,
                                    email: item.email // Agregamos el email como propiedad del objeto
                                };
                            })
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1
            });

            empresaIdSelect.select2({
                placeholder: 'select',
                allowClear:true,
                ajax: {
                    url: '{{ route('buscar-empresa') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            company_id: params.term,
                            "_token":"{{ csrf_token() }}",
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.nombre_empresa
                                }
                            })
                        };
                    },
                    cache: true
                },
                placeholder: 'Selecciona un elemento',
                minimumInputLength: 1,
            });

            usuarioIdSelect.on('select2:select', function (e) {
                var selectedUser = e.params.data;
                correoUsuarioInput.val(selectedUser.email); // Establecemos el valor del campo de correo con el email del usuario seleccionado
            });

            usuarioIdSelect.on('select2:clear', function () {
                correoUsuarioInput.val(''); // Limpiamos el valor del campo de correo cuando se deseleccione el usuario
            });
        });

    </script>
@endsection

