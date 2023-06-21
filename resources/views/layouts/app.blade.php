<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Fopre-Café</title>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('recursos/admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{url('recursos/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{url('recursos/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{url('recursos/admin/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('recursos/admin/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{url('recursos/admin/dist/css/style.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{url('recursos/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{url('recursos/admin/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{url('recursos/admin/plugins/summernote/summernote-bs4.min.css')}}">
    {{-- select2 --}}
    <link rel="stylesheet" href="{{url('recursos/admin/plugins/select2/css/select2.min.css')}}" />

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Form cerrar sesión-->
    <form action="{{route('logout')}}" method="post" id="cerrar">
        @csrf
    </form>
     <div class="preloader loader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{url('recursos/admin/dist/img/logo-uniandes-preload.png')}}" alt="AdminLTELogo" height="120" width="280">
    </div>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('admin.dashboard')}}" class="nav-link">Inicio</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contacto</a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{route('admin.dashboard')}}" class="brand-link">
            <!--
            <img src="{{url('recursos/admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">

             -->
            <span class="brand-text font-weight-light">Fopre Café</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <!--

                 <div class="image">
                    <img src="" class="img-circle elevation-2" alt="User Image">
                </div>
                 -->
                <div class="info">
                    <a href="{{route('admin.dashboard')}}" class="d-block">{{auth()->user()->name}} {{auth()->user()->lastname}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{route('admin.dashboard')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/dashboard") active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">Accesos</li>

                    <li class="nav-item">
                        @can('admin.states.index')
                        <a href="#" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/states" || $_SERVER['REQUEST_URI'] === "/admin/states/create") active @endif">
                            <i class="nav-icon fab fa-usps"></i>
                            <p>
                                Estados
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        @endcan
                        <ul class="nav nav-treeview">
                            @can('admin.states.create')
                                <li class="nav-item">
                                    <a href="{{route('admin.states.create')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/states/create") active  @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Crear Estado</p>
                                    </a>
                                </li>
                            @endcan
                            @can('admin.states.index')
                                <li class="nav-item">
                                    <a href="{{route('admin.states.index')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/states") active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listar Estados</p>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </li>

                    <li class="nav-item">
                        @can('admin.roles.index')
                            <a href="#" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/roles" || $_SERVER['REQUEST_URI'] === "/admin/roles/create" ) active @endif">
                                <i class="nav-icon fa fa-users-cog"></i>
                                <p>
                                    Roles
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                        @endcan
                        <ul class="nav nav-treeview">
                            @can('admin.roles.create')
                                <li class="nav-item">
                                    <a href="{{route('admin.roles.create')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/roles/create") active  @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Crear rol</p>
                                    </a>
                                </li>
                            @endcan
                            @can('admin.roles.index')
                                <li class="nav-item">
                                    <a href="{{route('admin.roles.index')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/roles") active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listar roles</p>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </li>

                    <li class="nav-item">
                        @can('admin.users.index')
                        <a href="#" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/users" || $_SERVER['REQUEST_URI'] === "/admin/users/create") active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Usuarios
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        @endcan
                        <ul class="nav nav-treeview">
                            @can('admin.users.create')
                            <li class="nav-item">
                                <a href="{{route('admin.users.create')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/users/create") active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Crear usuario</p>
                                </a>
                            </li>
                            @endcan
                            @can('admin.users.index')
                            <li class="nav-item">
                                <a href="{{route('admin.users.index')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/users") active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listar usuarios</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>

                    <li class="nav-item">
                        @can('admin.products.index')
                        <a href="#" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/products" || $_SERVER['REQUEST_URI'] === "/admin/products/create") active @endif">
                            <i class="nav-icon fab fa-product-hunt"></i>
                            <p>
                                Productos
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        @endcan
                        <ul class="nav nav-treeview">
                            @can('admin.products.create')
                            <li class="nav-item">
                                <a href="{{route('admin.products.create')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/products/create") active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Crear producto</p>
                                </a>
                            </li>
                            @endcan
                            @can('admin.products.index')
                            <li class="nav-item">
                                <a href="{{route('admin.products.index')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/products") active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listar productos</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>

                    <li class="nav-item">
                        @can('admin.menus.index')
                        <a href="#" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/menus" || $_SERVER['REQUEST_URI'] === "/admin/menus/create" ) active @endif">
                            <i class="nav-icon fab fa-mendeley"></i>
                            <p>
                                Menus
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        @endcan
                        <ul class="nav nav-treeview">
                            @can('admin.menus.create')
                            <li class="nav-item">
                                <a href="{{route('admin.menus.create')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/menus/create") active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Crear menu</p>
                                </a>
                            </li>
                            @endcan
                            @can('admin.menus.index')
                            <li class="nav-item">
                                <a href="{{route('admin.menus.index')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/menus") active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listar Menus</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>

                    <li class="nav-item">
                        @can('admin.pays.index')
                        <a href="#" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/pays" || $_SERVER['REQUEST_URI'] === "/admin/pays/create") active @endif">
                            <i class="nav-icon fas fa-money-bill-alt"></i>
                            <p>
                                Metodo Pago
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        @endcan
                        <ul class="nav nav-treeview">
                            @can('admin.pays.create')
                            <li class="nav-item">
                                <a href="{{route('admin.pays.create')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/pays/create") active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Crear Metodo Pago</p>
                                </a>
                            </li>
                            @endcan
                            @can('admin.pays.index')
                            <li class="nav-item">
                                <a href="{{route('admin.pays.index')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/pays") active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listar Metodos de Pago</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>

                    <li class="nav-item">
                        @can('admin.salereports.index')
                        <a href="#" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/salereports" || $_SERVER['REQUEST_URI'] === "/admin/salereports/create") active @endif">
                            <i class="nav-icon fas fa-receipt"></i>
                            <p>
                                Reporte de ventas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        @endcan
                        <ul class="nav nav-treeview">
                            @can('admin.salereports.create')
                            <li class="nav-item">
                                <a href="{{route('admin.salereports.create')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/salereports/create") active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Crear Reporte venta</p>
                                </a>
                            </li>
                            @endcan
                            @can('admin.salereports.index')
                            <li class="nav-item">
                                <a href="{{route('admin.salereports.index')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/salereports") active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listar Reportes de venta</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>

                    <li class="nav-item">
                        @can('admin.preorders.index')
                            <a href="#" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/preorders" || $_SERVER['REQUEST_URI'] === "/admin/preorders/create") active @endif">
                                <i class="nav-icon fas fa-prescription-bottle-alt"></i>
                                <p>
                                    Pedidos Anticipados
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                        @endcan
                        <ul class="nav nav-treeview">
                            @can('admin.preorders.create')
                                <li class="nav-item">
                                    <a href="{{route('admin.preorders.create')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/preorders/create") active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Crear Pedido anticipado</p>
                                    </a>
                                </li>
                            @endcan
                            @can('admin.preorders.index')
                                <li class="nav-item">
                                    <a href="{{route('admin.preorders.index')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/preorders") active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listar Pedido anticipado</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>


                    <li class="nav-item">
                        @can('admin.companies.index')
                        <a href="#" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/companies" || $_SERVER['REQUEST_URI'] === "/admin/companies/create") active @endif">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                Empresas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        @endcan
                        <ul class="nav nav-treeview">
                            @can('admin.companies.create')
                            <li class="nav-item">
                                <a href="{{route('admin.companies.create')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/companies/create") active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Crear empresa</p>
                                </a>
                            </li>
                            @endcan
                            @can('admin.companies.index')
                            <li class="nav-item">
                                <a href="{{route('admin.companies.index')}}" class="nav-link @if($_SERVER['REQUEST_URI'] === "/admin/companies") active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listar empresas</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    <li class="nav-header ">Configuraciones</li>
                    <li class="nav-item">
                        <a  class="nav-link disabled">
                            <i class="nav-icon far fa-envelope"></i>
                            <p>{{auth()->user()->email}}</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a onclick="document.getElementById('cerrar').submit()" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Cerrar Sesión</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <!--main donde se encuenta nuestro contenido-->
    <main>
        <div class="content-wrapper">
            @yield('content')
        </div>
    </main>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2023 <a href="https://uniandes.edu.co/">Universidad de los Andes</a>.</strong>
        Derechos Reservados.
        <div class="float-right d-none d-sm-inline-block">
            <b>Versión</b> 1.1.0
        </div>
    </footer>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="{{url('recursos/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('recursos/admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{url('recursos/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.min.js" integrity="sha512-mlz/Fs1VtBou2TrUkGzX4VoGvybkD9nkeXWJm3rle0DPHssYYx4j+8kIS15T78ttGfmOjH0lLaBXGcShaVkdkg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Sparkline -->
<script src="{{url('recursos/admin/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{url('recursos/admin/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{url('recursos/admin/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('recursos/admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{url('recursos/admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{url('recursos/admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('recursos/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{url('recursos/admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{url('recursos/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('recursos/admin/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('recursos/admin/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url('recursos/admin/dist/js/pages/dashboard.js')}}"></script>
{{-- select2 --}}
<script src="{{url('recursos/admin/plugins/select2/js/select2.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Script para agregar productos al menu -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>

@yield('js')

</body>
</html>
