@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                @can('admin.states.index')
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$total_states}}</h3>

                            <p>Listar Estados</p>
                        </div>
                        <div class="icon">
                            <i class="fab fa-usps"></i>
                        </div>
                        <a href="{{route('admin.states.index')}}" class="small-box-footer">Ir ahora <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @endcan
                    @can('admin.roles.index')
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <h3>{{$total_roles}}</h3>

                                    <p>Listar Roles</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users-cog"></i>
                                </div>
                                <a href="{{route('admin.roles.index')}}" class="small-box-footer">Ir ahora <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endcan
                @can('admin.users.index')
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$total_users}}</h3>

                            <p>Listar Usuarios</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('admin.users.index')}}" class="small-box-footer">Ir ahora <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @endcan
                @can('admin.products.index')
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning color-dashboard-div-admin" >
                        <div class="inner">
                            <h3>{{$total_products}}</h3>

                            <p>Listar Productos</p>
                        </div>
                        <div class="icon">
                            <i class="fab fa-product-hunt"></i>
                        </div>
                        <a href="{{route('admin.products.index')}}" class="small-box-footer color-dashboard-div-admin">Ir ahora <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @endcan
                <!-- ./col -->
                @can('admin.pays.index')
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-pink">
                        <div class="inner">
                            <h3>{{$total_pays}}</h3>

                            <p>Listar Metodos de Pago</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-bill-alt"></i>
                        </div>
                        <a href="{{route('admin.pays.index')}}" class="small-box-footer">Ir ahora <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @endcan
                <!-- ./col -->
                @can('admin.salereports.index')
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-orange color-dashboard-div-admin">
                        <div class="inner">
                            <h3>{{$total_salereports}}</h3>

                            <p>Listar Reportes Ventas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <a href="{{route('admin.salereports.index')}}" class="small-box-footer text-white color-dashboard-div-admin" >Ir ahora <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @endcan
                <!-- ./col -->
                @can('admin.companies.index')
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-indigo">
                        <div class="inner">
                            <h3>{{$total_companies}}</h3>

                            <p>Listar Empresas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <a href="{{route('admin.companies.index')}}" class="small-box-footer">Ir ahora <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @endcan
                <!-- ./col -->
                @can('admin.preorders.index')
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-cyan">
                        <div class="inner">
                            <h3>{{$total_preorders}}</h3>

                            <p>Listar Pedidos Anticipados</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-prescription-bottle-alt"></i>
                        </div>
                        <a href="{{route('admin.preorders.index')}}" class="small-box-footer">Ir ahora <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @endcan
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
