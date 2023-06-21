@extends('layouts.guest')
@section('title', 'Empresas')
@section('content')
    <section class="menu-area section-gap" id="coffee">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content pb-60 col-lg-10">
                    <div class="title text-center">
                        <h1 class="mb-10 text-white">Empresas disponibles</h1>
                        <p class="p-companies-users">
                            Apoya al Fopre Café Festival Gastronómico Filantrópico que se realizará del
                            <span class="font-weight-bold">5 al 9 de septiembre de 2022,</span>
                            en las Plazoletas Lleras y Pizano de la Universidad de los Andes.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                    @foreach($companies as $company)
                        <div class="col-2 m-2">
                            <a href="{{route('companies.show', $company)}}">
                                <div class="d-felx justify-content-center">
                                    <div class="d-flex justify-content-center">
                                        <img class="img-companies-users" src="{{ asset('storage/companies/' . $company->nombre_empresa . '/' . $company->imagen_company) }}" alt="">
                                    </div>
                                    <div  class="div-menu-companies d-flex justify-content-center align-items-center mt-2" >
                                        <p class="card-title text-center mt-2">{{$company->nombre_empresa}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
            </div>
    </section>
@endsection
