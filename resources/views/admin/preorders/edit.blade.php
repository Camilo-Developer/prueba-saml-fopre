@extends('layouts.app')
@section('title', 'Editar Pedido Anticipado')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Pedido Anticipado</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Lista pedidos pendientes</a></li>
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

                        <form action="{{route('admin.preorders.update',$preorder)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="fecha">Creacion del pedido:</label>
                                <input type="datetime-local" class="form-control form-control-border" name="fecha"  readonly value="{{$preorder->fecha}}">
                            </div>
                            <div class="form-group">
                                <label for="estado_id">Seleccione el Estado:</label>
                                <select class="custom-select form-control-border" name="estado_id" id="estado_id">
                                    <option value="{{$preorder->state->id}}" selected>{{$preorder->state->nombre_estado}}</option>
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}">{{$state->nombre_estado}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="company_id">Selección una empresa:</label>
                                <select class="custom-select form-control-border" name="company_id" id="company_id">
                                    <option value="{{$preorder->company->id}}" selected>{{$preorder->company->nombre_empresa}}</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->nombre_empresa}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_id">Selecione un Producto:</label>
                                <select class="custom-select form-control-border" name="product_id" id="product_id">
                                    <option  selected>--Seleccionar Producto--</option>
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
                                                @foreach($preorder->products as $product)
                                                    @php
                                                        $nombre = str_replace(' ','', $product->nombre_producto);
                                                    @endphp
                                                    <tr id="fila{{$nombre}}">
                                                        <td>
                                                            <input type="hidden" name="products[{{$product->id}}][id]" value="{{$product->id}}">{{$product->nombre_producto}}</td>
                                                        <td>
                                                            <input type="text" name="products[{{$product->id}}][precio]" class="form-control precio" value="{{number_format(intval($product->precio_producto))}} " readonly>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="products[{{$product->id}}][cantidad]" class="form-control cantidad" min="1" value="{{$product->pivot->quantity}}">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="products[{{$product->id}}][subtotal]" class="form-control subtotal" value="{{number_format(intval($product->pivot->subtotal))}}" readonly>
                                                        </td>
                                                        <td class="d-flex justify-content-center">
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="eliminar('{{$nombre}}');">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer clearfix">
                                            <div class="float-right">
                                                <input type="hidden" id="total_value" name="total_value" value="{{$product->pivot->subtotal}}">
                                                <p>Total: <span id="total">{{number_format(intval($product->pivot->subtotal))}}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="usuario_id">Nombre del cliente:</label>
                                <select class="custom-select form-control-border" name="usuario_id" id="usuario_id">
                                    <option value="{{$preorder->user->id}}" selected>{{$preorder->user->name}}</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}" data-email="{{$user->email}}">{{$user->name}} {{$user->lastname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="usuario_id">Correo del cliente:</label>
                                <input type="email" disabled readonly class="form-control form-control-border" id="user_email" placeholder="{{$preorder->user->email}}">
                            </div>
                            <div class="form-group">
                                <label for="dependence">Dependecia:</label>
                                <input type="text" class="form-control form-control-border" id="dependence" value="{{$preorder->dependence}}" name="dependence" value="{{$preorder->dependence}}" placeholder="Ingerese la Dependecia">
                            </div>
                            <div class="form-group">
                                <label for="cost_center">Centro de costo:</label>
                                <input type="text" class="form-control form-control-border" id="cost_center" value="{{$preorder->cost_center}}" name="cost_center" placeholder="Ingrese el centro de costo">
                            </div>
                            <div class="form-group">
                                <label for="name_cost_center">Nombre del centro de costo:</label>
                                <input type="text" class="form-control form-control-border" id="name_cost_center" value="{{$preorder->name_cost_center}}" name="name_cost_center" placeholder="Nombre del centro de costo">
                            </div>
                            <div class="form-group">
                                <label for="extension">Extensión:</label>
                                <input type="text" class="form-control form-control-border" id="extension" name="extension" value="{{$preorder->extension}}" placeholder="Ingrese la extensión del usuario">
                            </div>
                            <div class="form-group">
                                <label for="fecha_claim">Fecha de entrega del pedido:</label>
                                <input type="datetime-local" class="form-control form-control-border" id="fecha_claim" value="{{$preorder->fecha_claim}}" name="fecha_claim">
                            </div>
                            <div class="form-group">
                                <label for="observations">Observaciones:</label>
                                <input type="text" class="form-control form-control-border" id="observations" name="observations" value="{{$preorder->observations}}" placeholder="Nombre de su Menu">
                            </div>

                            <button type="submit" class="btn btn-success">Editar pedido</button>
                        </form>

                    @elseif(auth()->user()->hasRole('Empresa'))
                        <form action="{{route('admin.preorders.update', $preorder)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="fecha_claim">Creacion del pedido:</label>
                                <input type="datetime-local" class="form-control form-control-border" name="fecha" id="datetime-input-create">
                            </div>
                            <div class="form-group">
                                <label for="estado_id">Seleccione el Estado:</label>
                                <select class="custom-select form-control-border" name="estado_id" id="estado_id">
                                    <option value="{{$preorder->state->id}}" selected>{{$preorder->state->nombre_estado}}</option>
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}">{{$state->nombre_estado}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @foreach(auth()->user()->companys as $company)
                                <input type="hidden" value="{{$company->id}}" name="company_id">
                                <p><label for="">Empresa:</label> {{$company->nombre_empresa}}</p>
                            @endforeach



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
                                                <tr>
                                                    <th>Nombre Producto</th>
                                                    <th>Precio</th>
                                                    <th>Cantidad</th>
                                                    <th>subtotal</th>
                                                    <th>Acciones</th>
                                                </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                @foreach($preorder->products as $product)
                                                    @php
                                                        $nombre = str_replace(' ','', $product->nombre_producto);
                                                    @endphp
                                                    <tr id="fila{{$nombre}}">
                                                        <td>
                                                            <input type="hidden" name="products[id]" value="{{$product->id}}">{{$product->nombre_producto}}</td>
                                                        <td>
                                                            <input type="text" name="products[precio]" class="form-control precio" value="{{$product->precio_producto}} " readonly>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="products[cantidad]" class="form-control cantidad" min="1" value="{{$product->pivot->quantity}}">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="products[subtotal]" class="form-control subtotal" value="{{$product->pivot->subtotal}}" readonly>
                                                        </td>
                                                        <td class="d-flex justify-content-center">
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="eliminar('{{$nombre}}');">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer clearfix">
                                            <div class="float-right">

                                                <input type="hidden" id="total_value" name="total_value" value="">
                                                <p>Total: <span id="total">{{number_format(intval($product->pivot->subtotal))}}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="usuario_id">Nombre del cliente:</label>
                                <select class="custom-select form-control-border" name="usuario_id" id="usuario_id">
                                    <option value="{{$preorder->user->id}}" selected>{{$preorder->user->name}}</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}" data-email="{{$user->email}}">{{$user->name}} {{$user->lastname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="usuario_id">Correo del cliente:</label>
                                <input type="email" disabled readonly class="form-control form-control-border" id="user_email" placeholder="{{$preorder->user->email}}">
                            </div>
                            <div class="form-group">
                                <label for="dependence">Dependecia:</label>
                                <input type="text" class="form-control form-control-border" id="dependence" name="dependence" value="{{$preorder->dependence}}" placeholder="Ingerese la Dependecia">
                            </div>
                            <div class="form-group">
                                <label for="cost_center">Centro de costo:</label>
                                <input type="text" class="form-control form-control-border" id="cost_center" name="cost_center" value="{{$preorder->cost_center}}" placeholder="Ingrese el centro de costo">
                            </div>
                            <div class="form-group">
                                <label for="name_cost_center">Nombre del centro de costo:</label>
                                <input type="text" class="form-control form-control-border" id="name_cost_center" name="name_cost_center" value="{{$preorder->name_cost_center}}" placeholder="Nombre del centro de costo">
                            </div>
                            <div class="form-group">
                                <label for="extension">Extensión:</label>
                                <input type="text" class="form-control form-control-border" id="extension" name="extension" value="{{$preorder->extension}}" placeholder="Ingrese la extensión del usuario">
                            </div>
                            <div class="form-group">
                                <label for="fecha_claim">Fecha de entrega del pedido:</label>
                                <input type="datetime-local" class="form-control form-control-border" id="fecha_claim" value="{{$preorder->fecha_claim}}" name="fecha_claim">
                            </div>
                            <div class="form-group">
                                <label for="observations">Observaciones:</label>
                                <input type="text" class="form-control form-control-border" id="observations" name="observations" value="{{$preorder->observations}}" placeholder="Nombre de su Menu">
                            </div>

                            <button type="submit" class="btn btn-success">Editar pedido</button>
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
            var precio_productos = $("#precio_" + product_id).val();
            var cont = 0;

            if (product_id != "") {
                var fila = '<tr class="selected" id="fila' + cont + '">' +
                    '<td><input type="hidden" name="products['+ cont +'][id]" value="' + product_id + '">' + product + '</td>' +
                    '<td><input type="text" name="products['+ cont +'][precio]" class="form-control precio" value="' + precio_productos + '" readonly></td>' +
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
            fila.find('.subtotal').val(subtotal);
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

        //para obtener el a el email con el usuario
        var div1Select = document.getElementById('usuario_id');
        var div3Input = document.getElementById('user_email');

        // Obtener el correo del usuario seleccionado en el Div 1
        var selectedUserEmail = div1Select.options[div1Select.selectedIndex].getAttribute('data-email');

        // Establecer el correo del usuario seleccionado en el Div 3
        div3Input.value = selectedUserEmail;

        // Escuchar el evento de cambio en el select del Div 1
        div1Select.addEventListener('change', function() {
            // Obtener el correo del usuario seleccionado en el Div 1
            var selectedUserEmail = div1Select.options[div1Select.selectedIndex].getAttribute('data-email');

            // Establecer el correo del usuario seleccionado en el Div 3
            div3Input.value = selectedUserEmail;
        });
    </script>
@endsection
