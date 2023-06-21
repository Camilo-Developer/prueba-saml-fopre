@extends('layouts.guest')
@section('title', 'Inicio')
@section('content')

    <style>
        .no-spinners::-webkit-inner-spin-button,
        .no-spinners::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .no-spinners {
            -moz-appearance: textfield; /* Firefox */
        }
    </style>
    <section class="menu-area section-gap" id="coffee">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('pagar') }}" method="post">
                        @csrf
                        <div class="d-flex justify-content-end">
                            <label>Fecha {{ $fechaHoy }}</label>
                            <input type="hidden" name="fecha" value="{{ $fechaHoy }}">
                        </div>
                       <div class="mt-3">
                           <div class="mb-3">
                               <label for="">Dependencia</label>
                               <input type="text" name="dependence" placeholder="Ingrese dependencia" required class="single-input">
                           </div>
                           <div class="mb-3">
                               <label for="">Nombre Persona solicita</label>
                               <input type="text" name="name" value="{{ auth()->user()->name }}" disabled required class="single-input">

                           </div>
                           <div class="mb-3">
                               <label for="">Nombre Persona autoriza</label>
                               <input type="text" name="name_auth" placeholder="Ingrese la persona que le autorizo el pedido" required class="single-input">
                           </div>
                           <div class="mb-3">
                               <label for="">Centro de costo</label>
                               <input type="text" name="cost_center" placeholder="Ingrese el centro de costo" required class="single-input">
                           </div>
                           <div class="mb-3">
                               <label for="">Nombre del Centro de costo</label>
                               <input type="text" name="name_cost_center" placeholder="ingrese el nombre centro de costo" required class="single-input">
                           </div>
                           <div class="mb-3">
                               <label for="">Extension</label>
                               <input type="number" min="1" name="extension" placeholder="Ingrese la extencion" required class="single-input no-spinners">
                           </div>
                          <div class="mb-3">
                              <label for="">Correo electronico</label>
                              <input type="email" name="email" value="{{ auth()->user()->email }}" disabled required class="single-input">
                          </div>
                          <div class="mb-3">
                              <label for="">Fecha en que reclamara el pedido</label>
                              <input type="datetime-local" name="fecha_claim"  required class="single-input"  id="fecha_claim_input">
                          </div>
                           <div class="mb-3">
                               <label for="observations">Observaciones</label>
                               <textarea name="observations" class="single-textarea" placeholder="Escriba las observaciones de su pedido"  required></textarea>
                           </div>

                       </div>
                        <table class="table table-hover">
                            <thead style="border: 1px solid rgba(0, 0, 0, 0.125)">
                                <tr>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody style="border: 1px solid rgba(0, 0, 0, 0.125)">
                            @php
                                $total = 0;
                                $cartItems = session('cart');
                            @endphp

                            @if ($cartItems)
                                @foreach ($cartItems as $id => $details)
                                    @php
                                        $subtotal = $details['precio_producto'] * $details['quantity'];
                                        $total += $subtotal;
                                    @endphp
                                    <tr data-id="{{ $id }}"
                                        style="border-bottom: 1px solid rgba(0, 0, 0, 0.125)">
                                        <td data-th="Product">
                                            <div class="row">
                                                <div class="col-sm-3 hidden-xs">
                                                    <img src="/imagen/{{ $details['imagen_producto'] }}" width="100"
                                                         height="100" class="img-responsive" />
                                                </div>
                                                <div class="col-sm-9 ms-auto">
                                                    <h4 class="nomargin">{{ $details['nombre_producto'] }}</h4>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-th="Price">$ {{ number_format(intval($details['precio_producto'])) }}</td>
                                        <td data-th="Quantity">
                                            <input type="number" name="products[{{ $id }}]['quantity']"
                                                   value="{{ $details['quantity'] }}"
                                                   class="form-control quantity cart_update" min="1" />
                                        </td>

                                        <td data-th="Subtotal" class="text-center">$ {{ number_format(intval($subtotal)) }}</td>
                                        <input name="products[{{ $id }}]['subtotal']" type="hidden"
                                               value="{{ $subtotal }}">
                                        <input name="total" type="hidden" value="{{ $total }}">

                                        <input type="hidden" name="company_id" value="{{ $details['company_id'] }}">
                                        <td class="actions" data-th="">
                                            <button type="button" class="btn btn-danger btn-sm cart_remove"><i
                                                    class="fa fa-trash-o"></i> Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">No hay productos en su carrito</td>
                                </tr>
                            @endif

                            </tbody>

                        </table>
                        <div class="float-right">
                            <a href="{{ route('companies.index') }}" class="btn btn-primary"><i
                                    class="fa fa-arrow-left"></i> Continuar con la compra</a>
                            <button type="submit" href="{{ route('pagar') }}" class="btn btn-success"><i
                                    class="fa fa-money"></i> Pagar ahora</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </section>
    <!-- Incluir los scripts en archivos externos -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script type="text/javascript">

        //funcion hora actual
        const fechaClaimInput = document.getElementById('fecha_claim_input');
        const minHora = new Date();
        minHora.setHours(8);
        minHora.setMinutes(0);

        const maxHora = new Date();
        maxHora.setHours(19);
        maxHora.setMinutes(0);

        const maxFecha = new Date();
        maxFecha.setMonth(maxFecha.getMonth() + 4); // Añadir 4 meses

        fechaClaimInput.min = minHora.toISOString().slice(0, 16);
        fechaClaimInput.max = maxFecha.toISOString().slice(0, 16);

        fechaClaimInput.addEventListener('change', function() {
            const selectedDateTime = new Date(this.value).getTime();
            const currentDate = new Date();
            currentDate.setHours(0, 0, 0, 0);

            if (selectedDateTime < currentDate.getTime()) {
                this.value = '';
                alert('La fecha seleccionada está fuera del rango permitido (desde hoy hasta 4 meses en el futuro).');
            } else {
                const selectedHour = new Date(this.value).getHours();

                if (selectedHour < 8 || selectedHour > 19) {
                    this.value = '';
                    alert('La hora seleccionada está fuera del rango permitido (8 am - 7 pm).');
                }
            }
        });
        //fin funcion hora actual


        $(document).ready(function() {
            var storedFormData = JSON.parse(localStorage.getItem('formData'));

            if (storedFormData) {
                // Restaurar valores en los respectivos campos
                $('input[name="fecha"]').val(storedFormData.fecha);
                $('input[name="dependence"]').val(storedFormData.dependence);
                $('input[name="name"]').val(storedFormData.name);
                $('input[name="name_auth"]').val(storedFormData.name_auth);
                $('input[name="cost_center"]').val(storedFormData.cost_center);
                $('input[name="name_cost_center"]').val(storedFormData.name_cost_center);
                $('input[name="extension"]').val(storedFormData.extension);
                $('input[name="email"]').val(storedFormData.email);
                $('input[name="fecha_claim"]').val(storedFormData.fecha_claim);
                $('input[name="company_id"]').val(storedFormData.company_id);
                $('textarea[name="observations"]').val(storedFormData.observations);
            }
        });

        $(".cart_update").change(function(e) {
            e.preventDefault();

            var ele = $(this);

            var formData = {
                fecha: $('input[name="fecha"]').val(),
                dependence: $('input[name="dependence"]').val(),
                name: $('input[name="name"]').val(),
                name_auth: $('input[name="name_auth"]').val(),
                cost_center: $('input[name="cost_center"]').val(),
                name_cost_center: $('input[name="name_cost_center"]').val(),
                extension: $('input[name="extension"]').val(),
                email: $('input[name="email"]').val(),
                fecha_claim: $('input[name="fecha_claim"]').val(),
                company_id: $('input[name="company_id"]').val(),
                observations: $('textarea[name="observations"]').val(),
            };

            localStorage.setItem('formData', JSON.stringify(formData));

            $.ajax({
                url: '{{ route('update_cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id"),
                    quantity: ele.parents("tr").find(".quantity").val(),
                    formData: formData
                },
                success: function(response) {

                    // Recargar la página
                    window.location.reload();
                }
            });
        });

        $(".cart_remove").click(function(e) {
            e.preventDefault();

            var ele = $(this);

            if (confirm("Do you really want to remove?")) {
                $.ajax({
                    url: '{{ route('remove_from_cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("data-id")
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
@endsection
