<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>@yield('title') - Fopre-Café</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{url('recursos/admin/plugins/fontawesome-free/css/all.min.css')}}" />
        <!-- Theme style -->
        <link rel="stylesheet" href="{{url('recursos/admin/dist/css/adminlte.min.css')}}" />
        {{-- select2 --}}
        <link rel="stylesheet" href="{{url('recursos/admin/plugins/select2/css/select2.min.css')}}" />
        <!-- jQuery -->
        <script src="{{url('recursos/admin/plugins/jquery/jquery.min.js')}}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{url('recursos/admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <!-- AdminLTE App -->
        <script src="{{url('recursos/admin/dist/js/adminlte.js')}}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{url('recursos/admin/dist/js/demo.js')}}"></script>
        {{-- select2 --}}
        <script src="{{url('recursos/admin/plugins/select2/js/select2.js')}}"></script>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Form cerrar sesión-->
            <form action="{{route('logout')}}" method="post" id="cerrar">
                @csrf
            </form>

            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="{{url('recursos/admin/dist/img/logo-uniandes-preload.png')}}" alt="AdminLTELogo" height="120" width="280" />
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
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{route('admin.dashboard')}}" class="brand-link">
                    <img src="{{url('recursos/admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8;" />
                    <span class="brand-text font-weight-light">Fopre Café</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{url('recursos/admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image" />
                        </div>
                        <div class="info">
                            <a href="{{url('dashboard')}}" class="d-block">{{auth()->user()->name}}</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                            <li class="nav-item">
                                <a href="{{url('dashboard')}}" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>

                            <li class="nav-header">Accesos</li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fab fa-usps"></i>
                                    <p>
                                        Estados
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('admin.states.create')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crear Estado</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.states.index')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listar Estados</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Usuarios
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('admin.users.create')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crear usuario</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.users.index')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listar usuarios</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fab fa-product-hunt"></i>
                                    <p>
                                        Productos
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('admin.products.create')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crear producto</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.products.index')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listar productos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fab fa-mendeley"></i>
                                    <p>
                                        Menus
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('admin.menus.create')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crear menu</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.menus.index')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listar Menus</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-money-bill-alt"></i>
                                    <p>
                                        Metodo Pago
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('admin.pays.create')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crear Metodo Pago</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.pays.index')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listar Metodos de Pago</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-receipt"></i>
                                    <p>
                                        Reporte de ventas
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('admin.salereports.create')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crear Reporte venta</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.salereports.index')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listar Reportes de venta</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-building"></i>
                                    <p>
                                        Empresas
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('admin.companies.create')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Crear empresa</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('admin.companies.index')}}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listar empresas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-header">Configuraciones</li>
                            <li class="nav-item">
                                <a class="nav-link disabled">
                                    <i class="nav-icon far fa-envelope"></i>
                                    <p>{{auth()->user()->email}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>Configuración de perfil</p>
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
                <div class="float-right d-none d-sm-inline-block"><b>Versión</b> 1.1.0</div>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
    </body>
</html>
