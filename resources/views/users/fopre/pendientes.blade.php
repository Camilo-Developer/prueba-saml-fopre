@extends('layouts.guest')
@section('title', 'Empresas')
@section('content')
    <section class="menu-area section-gap" id="coffee">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-60 col-lg-10">
                    <div class="title text-center">
                        <h1 class="mb-10 text-white">Lista de pedidos pendientes</h1>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">

                    <div class="row">


                        <div class="col-lg-4">
                            <div class="single-menu prueba-1" style="height: 222px" data-bs-toggle="modal" data-bs-target="#modal_product" >
                                <div class="d-flex flex-row-reverse">
                                    <div class="css-t3bqh2 mt-3 ">
                                    <span class="a-1">
                                        <span class="a-2" ></span>
                                        <img src="/imagen/" class="a-img-1"/>
                                    </span>
                                    </div>
                                    <div class="d-block" >
                                        <div class="title-div justify-content-between d-flex">
                                            <h4>kkk</h4>
                                        </div>
                                        <div class="text-start">
                                            <p>
                                               ...
                                            </p>
                                            <p class="price mt-2">
                                                gg
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        @foreach($preorders as $preorder)
                            @php
                                $fecha_preorder_reclamar = $preorder->fecha_claim;
                                $fechaVisualProduct_1 = \Carbon\Carbon::parse($fecha_preorder_reclamar)->format('F d, Y - H:i');
                            @endphp
                            <div class="col-3 mb-4">
                                <div class="card" style="width: 15rem;" >
                                    <div class="card-body">
                                        <div>
                                            <label for="" class="font-weight-bold">Fecha Creación:</label><br>
                                            <p>{{$preorder->fecha}}</p>
                                        </div>
                                        <div>
                                            <label for="" class="font-weight-bold">Fecha Entrega:</label><br>
                                            <p>{{$fechaVisualProduct_1}}</p>
                                        </div>
                                        <div class="float-right">
                                            <span class="badge badge-pill text-white" style="background-color: {{$preorder->state->color}}; ">{{$preorder->state->nombre_estado}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Launch demo modal
                            </button>

                            <div class="modal fade" id="modal_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered " style="max-width: 1000px;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <i class="fa fa-times" aria-hidden="true" data-bs-dismiss="modal" aria-label="Close" style="cursor: pointer"></i>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-12 col-sm-6 img-modal-product" style="">
                                                    </div>
                                                    <div class="col-12 col-sm-6 mt-3">
                                                        <label class="precio_product">$  COP</label>
                                                        <br>
                                                        <p class="p-modal"></p>
                                                        <input type="hidden" name="company_id" value="">
                                                        <br>
                                                        <div class="d-flex justify-content-center align-items-end number-format">
                                                            <div class="number-input">
                                                                <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" ></button>
                                                                <input class="quantity" min="1" placeholder="0" name="quantity" type="number">
                                                                <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit"   class="btn btn-success">Agregar al carrito</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
