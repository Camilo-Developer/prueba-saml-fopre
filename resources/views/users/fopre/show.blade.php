@extends('layouts.guest')
@section('title', 'Inicio')
@section('content')
    <section class="menu-area section-products">
        <div class="container-fluid">
            <div class="row div-menu-products-users"  >
                <div class="col-12 col-lg-2 bg-info-menu" >
                    <div class="container">
                        <div class="d-flex justify-content-center">
                            <img width="140px" class="rounded-circle img-fluid mt-5" src="{{ asset('storage/companies/' . $company->nombre_empresa . '/' . $company->imagen_company) }}" alt="">
                        </div>
                        <hr>
                        <p class="text-black fw-bold h6 mt-4">Empresa: {{$company->nombre_empresa}}</p>
                        <p class="text-black fw-bold h6 mt-3">Ubicación: {{$company->ubicacion}}</p>
                    </div>
                </div>
                <div class="col-12 col-lg-10 scroll-product" >
                    @if(Session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            {{session('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="row d-flex justify-content-center">
                        <div class="menu-content pb-60 col-lg-10">
                            <br>
                            <div class="title text-center">
                                <h1 class="mb-3 mt-5 text-center text-white">Productos de la empresa {{$company->nombre_empresa}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($products as $list_product)
                            <div class="col-lg-4">
                                <div class="single-menu prueba-1" style="height: 222px" data-bs-toggle="modal" data-bs-target="#modal_product{{ $loop->iteration }}" >
                                    <div class="d-flex flex-row-reverse">
                                        <div class="css-t3bqh2 mt-3 ">
                                    <span class="a-1">
                                        <span class="a-2" ></span>
                                        <img src="/imagen/{{$list_product->imagen_producto}}" class="a-img-1"/>
                                    </span>
                                        </div>
                                        <div class="d-block" >
                                            <div class="title-div justify-content-between d-flex">
                                                <h4>{{$list_product->nombre_producto}}</h4>
                                            </div>
                                            <div class="text-start">
                                                <p>
                                                    {{substr($list_product->descripcion_producto, 0, 50)}}...
                                                </p>
                                                <p class="price mt-2">
                                                    $ {{number_format(intval($list_product->precio_producto))}} COP
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            @if(auth()->check())
                                <form action="{{route('add_to_cart', $list_product->id)}}" method="post">
                                    @csrf
                                    <div class="modal fade" id="modal_product{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered " style="max-width: 1000px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{$list_product->nombre_producto}}</h5>
                                                    <i class="fa fa-times" aria-hidden="true" data-bs-dismiss="modal" aria-label="Close" style="cursor: pointer"></i>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-6 img-modal-product" style="background-image: url('/imagen/{{$list_product->imagen_producto}}')">
                                                            </div>
                                                            <div class="col-12 col-sm-6 mt-3">
                                                                <label class="precio_product">$ {{number_format(intval($list_product->precio_producto))}} COP</label>
                                                                <br>
                                                                <p class="p-modal">{{$list_product->descripcion_producto}}</p>
                                                                <input type="hidden" name="company_id" value="{{$list_product->company_id}}">
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
                                </form>
                            @else
                                <div class="modal fade" id="modal_product{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered " style="max-width: 1000px;">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{$list_product->nombre_producto}}</h5>
                                                <i class="fa fa-times" aria-hidden="true" data-bs-dismiss="modal" aria-label="Close" style="cursor: pointer"></i>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6 img-modal-product" style="background-image: url('/imagen/{{$list_product->imagen_producto}}')">
                                                        </div>
                                                        <div class="col-12 col-sm-6 mt-3">
                                                            <label class="precio_product">$ {{number_format(intval($list_product->precio_producto))}} COP</label>
                                                            <br>
                                                            <p class="p-modal">{{$list_product->descripcion_producto}}</p><br>
                                                            <p class="text-center p-modal">Si deseas realizar un <span class="precio_product">Pedido anticipado</span> !Inicia Sesión!.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{route('login')}}" class="btn btn-success">Iniciar Sesión</a>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
