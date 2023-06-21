@extends('layouts.guest')
@section('title', 'Inicio')
@section('content')
<!-- start banner Area -->
<section class="banner-area" id="home" style="">
    <div class="container">
        <div class="row fullscreen d-flex align-items-center justify-content-start">
            <div class="banner-content col-lg-7 mt-5">
                <h6 class="text-white text-uppercase p">Festival Gastronómico Filantrópico</h6>
                <h1>
                    FOPRE CAFÉ
                </h1>
                <h6 class="text-white text-uppercase mb-3">La mejor experiencia que podrás vivir</h6>
                <a href="{{route('companies.index')}}" class="primary-btn text-uppercase">Revisar Empresas</a>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->
@endsection
