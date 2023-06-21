@extends('layouts.guest')
@section('title','Registrarse')
@section('content')

    <!-- Start login Area -->
    <section class="menu-area section-gap " id="coffee">
        <div class="container ">
            <div class="d-flex justify-content-center">
                <div class="col-lg-6">
                    <div class="single-menu mt-5">
                        <div class="title-div justify-content-center d-flex">
                            <h2>Registrarse</h2>
                        </div>
                        <form action="{{route('register')}}" method="post">
                            @csrf
                            <div class="mt-10">
                                <input type="text" name="name" id="name" placeholder="Escriba sus Nombres" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Escriba sus Nombres'" required class="single-input">
                            </div>
                            <div class="mt-10">
                                <input type="text" name="lastname" id="lastname" placeholder="Escriba sus Apellidos" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Escriba sus Apellidos'" required class="single-input">
                            </div>
                            <div class="mt-10">
                                <input type="email" name="email" id="email" placeholder="Escriba su Correo Electrónico" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Escriba su Correo Electrónico'" required class="single-input">
                            </div>
                            <div class="mt-10">
                                <input type="password" name="password" id="password" placeholder="Escriba su Contraseña" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Escriba su Contraseña'" required class="single-input">
                            </div>
                            <div class="mt-10">
                                <input type="password" name="password" id="password" placeholder="Confirme su Contraseña" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirme su Contraseña'" required class="single-input">
                            </div>
                            <div class="mt-10">
                                <input type="text" name="identity_card" id="identity_card" placeholder="Escriba su Identificacion" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Escriba su Identificacion'" required class="single-input">
                            </div>

                            <div class="mt-3 d-flex justify-content-center">
                                <button type="submit" class="genric-btn primary-border circle arrow e-large" style="font-size: 12px">Registrarse</button>
                            </div>
                            <div class="mt-3 text-right">
                                <p class="sample-text">Ya tienes una Cuenta  | <a class="link-primary" href="{{route('login')}}" style="color: #b68834;">¡Conectarse!</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End login Area -->

@endsection
