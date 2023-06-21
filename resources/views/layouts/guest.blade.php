<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">

    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>@yield('title') - Fopre Café</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
    CSS
    ============================================= -->
    <link rel="stylesheet" href="{{url('recursos/users/css/linearicons.css')}}">
    <link rel="stylesheet" href="{{url('recursos/users/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url('recursos/users/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{url('recursos/users/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{url('recursos/users/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{url('recursos/users/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{url('recursos/users/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{url('recursos/users/css/main.css')}}">
</head>
<body>
<form action="{{route('logout')}}" method="post" id="cerrar">
    @csrf
</form>
@if(auth()->check())
    @if(auth()->user()->hasRole('Admin'))
        <header id="header" id="home">
            <div class="container">
                <div class="row align-items-center justify-content-between d-flex">
                    <div id="logo">
                        <h1>Fopre Café</h1>
                    </div>
                    <nav id="nav-menu-container">
                        <ul class="nav-menu">
                            <li class="menu-active"><a href="{{url('/')}}">Inicio</a></li>
                            <li class="menu-active"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li><a href="{{route('companies.index')}}">Empresas</a></li>
                            <li><a href="#">{{auth()->user()->email}}</a></li>
                            <li class="menu-has-children">
                            <a  class="text-cart" style="font-size: 20px; ">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    @php
                                        $totalQuantity = 0;
                                    @endphp

                                @if(session('cart'))
                                    @foreach(session('cart') as $id => $details)
                                        @php
                                            $totalQuantity += $details['quantity'];
                                        @endphp
                                    @endforeach
                                @endif
                                <span class="cart-count">{{ $totalQuantity }}</span>
                            </a>
                            <ul class="cart-modal" >
                                <div class="row total-header-section">
                                    @php $total = 0 @endphp
                                    @foreach((array) session('cart') as $id => $details)
                                        @php $total += $details['precio_producto'] * $details['quantity'] @endphp
                                    @endforeach
                                    <div class="col-lg-12 col-sm-12 col-12 total-section text-right">
                                        <p ><span class="font-weight-bold">Total:</span> <span class="text-primary">$ {{number_format(intval($total))  }}</span></p>
                                    </div>
                                </div>
                                <hr>
                                @if(session('cart'))
                                    @foreach(session('cart') as $id => $details)
                                        <div class="container">
                                            <div class="row cart-detail mt-4">
                                                <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                                    <img width="70px" src="/imagen/{{$details['imagen_producto']}}" />
                                                </div>
                                                <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                    <p class="font-weight-bold">{{ $details['nombre_producto'] }}</p>
                                                    <span class="price text-primary"> $ {{ number_format(intval($details['precio_producto']))  }}</span> <span class="count"> Cantidad: {{ $details['quantity'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <br>
                                <hr>
                                <div class="row mt-4">
                                    <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                        @if(session('cart') && count(session('cart')) > 0)
                                            <a href="{{ route('cart') }}" class="btn btn-primary btn-block">Ver carrito</a>
                                        @else
                                            <a href="{{ route('companies.index') }}" class="btn btn-primary btn-block">Registra un producto en el carrito</a>
                                        @endif
                                    </div>
                                </div>
                            </ul>
                            </li>
                            <li><a class="text-cart"  style="cursor: pointer;color: #FFFFFF; font-size: 20px" onclick="document.getElementById('cerrar').submit()"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                        </ul>
                    </nav><!-- #nav-menu-container -->
                </div>
            </div>
        </header><!-- #header -->

    @elseif(auth()->user()->hasRole('Empresa'))
        <header id="header" id="home">
            <div class="container">
                <div class="row align-items-center justify-content-between d-flex">
                    <div id="logo">
                        <h1>Fopre Café</h1>
                    </div>
                    <nav id="nav-menu-container">
                        <ul class="nav-menu">
                            <li class="menu-active"><a href="{{url('/')}}">Inicio</a></li>
                            <li class="menu-active"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li><a href="{{route('companies.index')}}">Empresas</a></li>
                            <li><a href="#">{{auth()->user()->email}}</a></li>
                            <li class="menu-has-children">
                                <a  class="text-cart" style="font-size: 20px; ">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    @php
                                        $totalQuantity = 0;
                                    @endphp

                                    @if(session('cart'))
                                        @foreach(session('cart') as $id => $details)
                                            @php
                                                $totalQuantity += $details['quantity'];
                                            @endphp
                                        @endforeach
                                    @endif
                                    <span class="cart-count">{{ $totalQuantity }}</span>
                                </a>
                                <ul style="display: none; width: 300px; margin-left: -200px">
                                    <div class="row total-header-section">
                                        @php $total = 0 @endphp
                                        @foreach((array) session('cart') as $id => $details)
                                            @php $total += $details['precio_producto'] * $details['quantity'] @endphp
                                        @endforeach
                                        <div class="col-lg-12 col-sm-12 col-12 total-section text-right">
                                            <p ><span class="font-weight-bold">Total:</span> <span class="text-info">$ {{number_format(intval($total))  }}</span></p>
                                        </div>
                                    </div>
                                    @if(session('cart'))
                                        @foreach(session('cart') as $id => $details)
                                            <div class="row cart-detail mt-4">
                                                <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                                    <img width="70px" src="/imagen/{{$details['imagen_producto']}}" />
                                                </div>
                                                <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                    <p class="font-weight-bold">{{ $details['nombre_producto'] }}</p>
                                                    <span class="price text-info"> $ {{ number_format(intval($details['precio_producto']))  }}</span> <span class="count"> Cantidad: {{ $details['quantity'] }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="row mt-4">
                                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                            @if(session('cart') && count(session('cart')) > 0)
                                                <a href="{{ route('cart') }}" class="btn btn-primary btn-block">Ver carrito</a>
                                            @else
                                                <a href="{{ route('companies.index') }}" class="btn btn-primary btn-block">Registra un producto en el carrito</a>
                                            @endif
                                        </div>
                                    </div>
                                </ul>
                            </li>
                            <li><a class="text-cart"  style="cursor: pointer;color: #FFFFFF; font-size: 20px" onclick="document.getElementById('cerrar').submit()"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                        </ul>
                    </nav><!-- #nav-menu-container -->
                </div>
            </div>
        </header><!-- #header -->

    @elseif(auth()->user()->hasRole('Usuario'))
        <header id="header" id="home">
            <div class="container">
                <div class="row align-items-center justify-content-between d-flex">
                    <div id="logo">
                        <h1>Fopre Café</h1>
                    </div>
                    <nav id="nav-menu-container">
                        <ul class="nav-menu">
                            <li class="menu-active"><a href="{{url('/')}}">Inicio</a></li>
                            <li class="menu-active"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li><a href="{{route('companies.index')}}">Empresas</a></li>
                            <li><a href="#">{{auth()->user()->email}}</a></li>
                            <li class="menu-has-children">
                                <a  class="text-cart" style="font-size: 20px; ">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    @php
                                        $totalQuantity = 0;
                                    @endphp

                                    @if(session('cart'))
                                        @foreach(session('cart') as $id => $details)
                                            @php
                                                $totalQuantity += $details['quantity'];
                                            @endphp
                                        @endforeach
                                    @endif
                                    <span class="cart-count">{{ $totalQuantity }}</span>
                                </a>
                                <ul style="display: none; width: 300px; margin-left: -200px">
                                    <div class="row total-header-section">
                                        @php $total = 0 @endphp
                                        @foreach((array) session('cart') as $id => $details)
                                            @php $total += $details['precio_producto'] * $details['quantity'] @endphp
                                        @endforeach
                                        <div class="col-lg-12 col-sm-12 col-12 total-section text-right">
                                            <p ><span class="font-weight-bold">Total:</span> <span class="text-info">$ {{number_format(intval($total))  }}</span></p>
                                        </div>
                                    </div>
                                    @if(session('cart'))
                                        @foreach(session('cart') as $id => $details)
                                            <div class="row cart-detail mt-4">
                                                <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                                    <img width="70px" src="/imagen/{{$details['imagen_producto']}}" />
                                                </div>
                                                <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                    <p class="font-weight-bold">{{ $details['nombre_producto'] }}</p>
                                                    <span class="price text-info"> $ {{ number_format(intval($details['precio_producto']))  }}</span> <span class="count"> Cantidad: {{ $details['quantity'] }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="row mt-4">
                                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                            @if(session('cart') && count(session('cart')) > 0)
                                                <a href="{{ route('cart') }}" class="btn btn-primary btn-block">Ver carrito</a>
                                            @else
                                                <a href="{{ route('companies.index') }}" class="btn btn-primary btn-block">Registra un producto en el carrito</a>
                                            @endif
                                        </div>
                                    </div>
                                </ul>
                            </li>
                            <li><a class="text-cart"  style="cursor: pointer;color: #FFFFFF; font-size: 20px" onclick="document.getElementById('cerrar').submit()"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                        </ul>
                    </nav><!-- #nav-menu-container -->
                </div>
            </div>
        </header><!-- #header -->
    @endif
@else
    <header id="header" id="home">
        <div class="container">
            <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <h1 >Fopre Café</h1>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="{{url('/')}}">Inicio</a></li>
                        <li><a href="{{route('companies.index')}}">Empresas</a></li>
                        <li><a href="{{route('login')}}">Login</a></li>
                        <li><a href="{{route('register')}}">Register</a></li>

                    </ul>
                </nav><!-- #nav-menu-container -->
            </div>
        </div>
    </header><!-- #header -->
@endif



<main>
    @yield('content')
</main>


<!-- start footer Area -->
<footer class="footer-area section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Contactanos:</h6>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.
                    </p>
                    <p class="footer-text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos los derechos reservados | por  <a href="https://colorlib.com" target="_blank">Universidad de los Andes.</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
            <div class="col-lg-5  col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Boletin informativo</h6>
                    <p>Manténgase actualizado con nuestras últimas</p>
                    <div class="" id="mc_embed_signup">
                        <form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">
                            <input class="form-control" name="EMAIL" placeholder="Ingrese correo electrónico" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ingrese correo electrónico '" required="" type="email">
                            <button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                            <div style="position: absolute; left: -5000px;">
                                <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                            </div>

                            <div class="info pt-20"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6 social-widget">
                <div class="single-footer-widget">
                    <h6>Síganos</h6>
                    <p>Redes Sociales</p>
                    <div class="footer-social d-flex align-items-center">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                        <a href="#"><i class="fa fa-behance"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End footer Area -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="{{url('recursos/users/js/vendor/jquery-2.2.4.min.js')}}"></script>
<script src="{{url('recursos/users/js/easing.min.js')}}"></script>
<script src="{{url('recursos/users/js/hoverIntent.js')}}"></script>
<script src="{{url('recursos/users/js/superfish.min.js')}}"></script>
<script src="{{url('recursos/users/js/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{url('recursos/users/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{url('recursos/users/js/owl.carousel.min.js')}}"></script>
<script src="{{url('recursos/users/js/jquery.sticky.js')}}"></script>
<script src="{{url('recursos/users/js/jquery.nice-select.min.js')}}"></script>
<script src="{{url('recursos/users/js/parallax.min.js')}}"></script>
<script src="{{url('recursos/users/js/waypoints.min.js')}}"></script>
<script src="{{url('recursos/users/js/jquery.counterup.min.js')}}"></script>
<script src="{{url('recursos/users/js/mail-script.js')}}"></script>
<script src="{{url('recursos/users/js/main.js')}}"></script>
</body>
</html>



