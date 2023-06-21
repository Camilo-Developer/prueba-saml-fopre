@extends('layouts.app')
@section('title', 'Crear Reporte Ventas')
@section('content')
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nuevo Reporte Venta</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Nuevo Reporte Venta</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!--Contenido- Formulario-->
    @if(auth()->user()->hasRole('Admin'))
        <section class="content">
            <div class="container-fluid" >
                <div class="card card-default color-palette-box">
                    <div class="card-body">
                        <div class="col-12">
                            <form action="{{route('admin.salereports.store')}}" method="post">
                                @csrf
                                @method('Post')
                                <div class="form-group">
                                    <label for="fecha">Fecha del reporte:</label>
                                    <input type="datetime-local" class="form-control form-control-border" id="fecha" name="fecha" min="{{ date('Y-m-d\TH:i') }}" max="{{ date('Y-m-d\TH:i', strtotime('+1 week')) }}">
                                </div>
                                <div class="form-group">
                                    <table class="table table-bordered" id="item_table">
                                        <thead>
                                        <tr>
                                            <th>Medio de pago</th>
                                            <th>Monto</th>
                                            <th><a  name="add" class="btn btn-success btn-xs add"><i class="fas fa-plus"></i></a></th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label for="company_id">Selección de Empresa:</label>
                                    <select class="custom-select form-control-border" name="company_id" id="company_id">
                                        <option selected>--Seleccionar Empresa--</option>
                                        @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{$company->nombre_empresa}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Crear Reporte de Venta</button>
                                <a href="{{route('admin.salereports.index')}}" class="btn btn-block bg-gradient-danger btn-lg">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    @elseif(auth()->user()->hasRole('Empresa'))
        <section class="content">
            <div class="container-fluid" >
                <div class="card card-default color-palette-box">
                    <div class="card-body">
                        <div class="col-12">
                            <form action="{{route('admin.salereports.store')}}" method="post">
                                @csrf
                                @method('Post')
                                <div class="form-group">
                                    <label for="fecha">Fecha del reporte:</label>
                                    <input type="datetime-local" class="form-control form-control-border" id="fecha" name="fecha" min="{{ date('Y-m-d\TH:i') }}" max="{{ date('Y-m-d\TH:i', strtotime('+1 week')) }}">
                                </div>
                                <div class="form-group">
                                    <table class="table table-bordered" id="item_table">
                                        <thead>
                                        <tr>
                                            <th>Medio de pago</th>
                                            <th>Monto</th>
                                            <th><a  name="add" class="btn btn-success btn-xs add"><i class="fas fa-plus"></i></a></th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label for="company_id">Reporte de la empresa:</label>
                                    @foreach(auth()->user()->companys as $companies)
                                        <input type="text" disabled readonly class="form-control form-control-border" value="{{$companies->nombre_empresa}}">
                                        <input type="hidden" class="form-control form-control-border" id="company_id" value="{{$companies->id}}" name="company_id">
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Crear Reporte de Venta</button>
                                <a href="{{route('admin.salereports.index')}}" class="btn btn-block bg-gradient-danger btn-lg">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection
@section('js')
    <script>
        var counter = 0;
        $(document).on("click", ".add", function () {

            var html = "";
            html += "<tr>";
            html += '<td><select class="custom-select form-control-border" name="payment_methods[' + counter + '][id]" id="pay_id"><option selected>--Seleccionar Pago--</option>@foreach($pays as $pay)<option value="{{$pay->id}}">{{$pay->metodo_pago}}</option>@endforeach</select></td>';
            html += '<td><input type="text" name="payment_methods[' + counter + '][amount]" class="form-control item_name" /></td>';
            html += '<td><a type="button" name="remove" class="btn btn-danger btn-xs remove"><i class="fas fa-trash"></i></a></td>';
            $("tbody").append(html);
            counter++;
        });

        $(document).on("click", ".remove", function () {
            $(this).closest("tr").remove();
        });

    </script>
@endsection
