@extends('layouts.app-c-senek')
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
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$total_states}}</h3>

                        <p>Nuevo Estado</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-usps"></i>
                    </div>
                    <a href="{{route('states.create')}}" class="small-box-footer">Ir ahora <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$total_users}}</h3>

                        <p>Registar Usuario</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('users.create')}}" class="small-box-footer">Ir ahora <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning" style="color: #FFFFFF!important;">
                    <div class="inner">
                        <h3>{{$total_products}}</h3>

                        <p>Nuevo Producto</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-product-hunt"></i>
                    </div>
                    <a href="{{route('products.create')}}" class="small-box-footer" style="color: #FFFFFF!important;">Ir ahora <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3>{{$total_menus}}</h3>

                        <p>Nuevo Menu</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-mendeley"></i>
                    </div>
                    <a href="{{route('menus.create')}}" class="small-box-footer">Ir ahora <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-pink">
                    <div class="inner">
                        <h3>{{$total_pays}}</h3>

                        <p>Nuevo Metodo Pago</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-bill-alt"></i>
                    </div>
                    <a href="{{route('pays.create')}}" class="small-box-footer">Ir ahora <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-orange" style="color: #FFFFFF!important;">
                    <div class="inner">
                        <h3>{{$total_salereports}}</h3>

                        <p>Nuevo Reporte Ventas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <a href="{{route('salereports.create')}}" class="small-box-footer" style="color: #FFFFFF!important;">Ir ahora <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-indigo">
                    <div class="inner">
                        <h3>{{$total_companies}}</h3>

                        <p>Nueva Empresa</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <a href="{{route('companies.create')}}" class="small-box-footer">Ir ahora <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-cyan">
                    <div class="inner">
                        <h3>{{$total_companies}}</h3>

                        <p>Pedido Anticipado</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-prescription-bottle-alt"></i>
                    </div>
                    <a href="{{route('companies.create')}}" class="small-box-footer">Ir ahora <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection
