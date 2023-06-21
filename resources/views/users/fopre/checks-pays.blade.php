@extends('layouts.guest')
@section('title', 'Inicio')
@section('content')

    <section class="menu-area section-gap" id="coffee">
        <div class="container">
            @if(Session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa fa-check-circle-o" aria-hidden="true"></i>
                         Pedido creado con éxito!</h3>
                </div>
                <div class="card-body">
                    <div class="row">

                            <div class="col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <div class="mb-3 ">
                                            <label class="font-weight-bold">Fecha de creación:</label>
                                            <input type="text"  placeholder="Fecha de creación" disabled readonly value="{{$preorder->fecha}}"  class="single-input">
                                        </div>
                                        <div class="mb-3 ">
                                            <label class="font-weight-bold mt-1">Nombre Persona solicita:</label>
                                            <input type="text"  placeholder="Nombre Persona solicita" disabled readonly value="{{$preorder->user->name}} {{$preorder->user->lastname}}" class="single-input">
                                        </div>
                                        <div class="mb-3 ">
                                            <label class="font-weight-bold">Centro de costo:</label>
                                            <input type="text"  placeholder="Centro de costo" disabled readonly value="{{$preorder->cost_center}}" class="single-input">

                                        </div>
                                        <div class="mb-3 ">
                                            <label class="font-weight-bold mt-1">Extension:</label>
                                            <input type="text"  placeholder="Extension" disabled readonly value="{{$preorder->extension}}" class="single-input">

                                        </div>

                                        <div class="mb-3 ">
                                            <label class="font-weight-bold mt-2">Observaciones:</label>
                                            <textarea class="single-input" disabled readonly cols="20" rows="4">{{$preorder->observations}}</textarea>


                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <div class="mb-3">
                                            <label class="font-weight-bold">Dependencia:</label>
                                            <input type="text"  placeholder="Dependencia" disabled readonly value="{{$preorder->dependence}}" class="single-input">
                                        </div>
                                        <div class="mb-3">
                                            <label class="font-weight-bold">Nombre Persona autoriza:</label>
                                            <input type="text"  placeholder="Nombre Persona autoriza" disabled readonly value="{{$preorder->name_auth}}" class="single-input">
                                        </div>
                                        <div class="mb-3">
                                            <label class="font-weight-bold mt-1">Nombre del Centro de costo:</label>
                                            <input type="text"  placeholder="Nombre del Centro de costo" disabled readonly value="{{$preorder->cost_center}}" class="single-input">
                                        </div>
                                        @php
                                            $fecha_preorder_reclamar = $preorder->fecha_claim;
                                            $fechaVisualProduct_1 = \Carbon\Carbon::parse($fecha_preorder_reclamar)->format('F d, Y - H:i');
                                        @endphp
                                        <div class="mb-3">
                                            <label class="font-weight-bold">Fecha en que reclamara el pedido:</label>
                                            <input type="text"  placeholder="Fecha en que reclamara el pedido" disabled readonly value="{{$fechaVisualProduct_1}}" class="single-input">
                                        </div>
                                        <div class="mb-3 ">
                                            <label class="font-weight-bold mt-2">Correo electronico:</label>
                                            <input type="text"  placeholder="Correo electronico" disabled readonly value="{{$preorder->user->email}}" class="single-input">
                                        </div>
                                        <div class="mb-3 ">
                                            <label class="font-weight-bold mt-2">Estado de la compra:</label>
                                            <input type="text"  placeholder="Estado" disabled readonly value="{{$preorder->state->nombre_estado}}" class="single-input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="col-12 table-responsive">
                            <div class="mb-3">
                                <label class="font-weight-bold mt-2">Productos:</label>
                            </div>
                            <table class="table table-striped" style="border: 1px solid #dee2e6;">
                                <thead>
                                <tr class="text-center">
                                    <th >Producto</th>
                                    <th >Precio</th>
                                    <th >Reclar Pedido</th>
                                    <th >Cantidad</th>
                                    <th >Subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($preorder->products as $product )
                                    @php
                                        $fecha = $product->pivot->pivotParent->fecha_claim;
                                        $fechaVisualProduct = \Carbon\Carbon::parse($fecha)->format('F d, Y - H:i');
                                    @endphp
                                    <tr class="text-center">

                                        <td>
                                            <img width="50px" src="/imagen/{{$product->imagen_producto}}" alt="">
                                            {{$product->nombre_producto}}
                                        </td>
                                        <td>$ {{number_format(intval($product->precio_producto))}} COP</td>
                                        <td>{{$fechaVisualProduct}}</td>
                                        <td>{{$product->pivot->quantity}}</td>
                                        <td>$ {{number_format(intval($product->pivot->subtotal))}} COP</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <div class="d-flex justify-content-end">
                        <label for=""><span class="font-weight-bold">Total:</span>$ {{number_format(intval($preorder->total))}} COP</label>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
