@extends('layouts.guest')
@section('title', 'Iniciar Sesión')
@section('content')
    <!-- Start login Area -->
    <section class="menu-area section-gap " id="coffee">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-lg-6">
                    <div class="single-menu single-menu-login mt-5">
                        <div class="title-div justify-content-center d-flex">
                            <h2>Iniciar Sesión</h2>
                        </div>
                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <div class="mt-10">
                                <input type="email" name="email" id="email" placeholder="Correo Electrónico" required class="single-input">
                            </div>
                            <div class="mt-10">
                                <input type="password" name="password" id="password" placeholder="Contraseña" required class="single-input">
                            </div>
                            <div class="mt-3 d-flex justify-content-center">
                                <button type="submit" class="genric-btn primary-border circle arrow e-large register-login" >Iniciar Sesión</button>
                            </div>
                            <div class="mt-2 d-flex justify-content-center">
                                <a href="{{url('saml2/6ee01218-1ec9-4773-b02c-0fecd89515d3/login?returnTo=https://formularios-dre.test/dashboard')}}" class="genric-btn primary-border circle arrow e-large saml-btn">Iniciar Sesión Uniandes</a>
                            </div>
                            <div class="mt-3 text-right">
                                <p class="sample-text">¿Aun no te has Registrado?  | <a class="link-primary register-login" href="{{route('register')}}">¡REGISTRATE AHORA!</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End login Area -->
@endsection
