@extends('layouts.app')
@section('title', 'Listar Empresas')
@section('content')
    <style>
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }
        /* Style the buttons that are used to open the tab content */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
        }
        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }
        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }
        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
    </style>
    @if(Session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!--Migas de pan-->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detalles de la empresa {{$company->nombre_empresa}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Lista de Empresas</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-header">
                            <div class="float-right">
                                <a href="{{route('admin.companies.edit',$company)}}" class="btn btn-secondary">Editar Empresa</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @php
                               $nombreEmpresa = $company->nombre_empresa;
                               // Eliminar caracteres especiales y espacios
                               $nombreEmpresa = preg_replace('/[^A-Za-z0-9]/', '', $nombreEmpresa);
                               // Convertir a minúsculas
                               $nombreEmpresa = strtolower($nombreEmpresa);
                               $extensionCPREG = pathinfo($company->comprobante_registro, PATHINFO_EXTENSION);
                               $extensionREGINV = pathinfo($company->registro_invima, PATHINFO_EXTENSION);
                               $extensionEXAMICRO = pathinfo($company->examen_microbiologico, PATHINFO_EXTENSION);
                               $extensionBPM = pathinfo($company->bpm, PATHINFO_EXTENSION);
                               $extensionFORSGSST = pathinfo($company->formato_sgsst, PATHINFO_EXTENSION);
                               $extensionPROBIO = pathinfo($company->protocolos_bioseguridad, PATHINFO_EXTENSION);
                               $extensionPLANSANE = pathinfo($company->plan_saneamiento, PATHINFO_EXTENSION);
                               $extensionCPCARMANIP = pathinfo($company->copia_carnet_manipulacion, PATHINFO_EXTENSION);
                               $extensionCPCARVACU = pathinfo($company->copia_carnet_vacunacion, PATHINFO_EXTENSION);
                               $extensionARP = pathinfo($company->copia_plantilla_arp, PATHINFO_EXTENSION);
                               $extensionLogo = pathinfo($company->logo, PATHINFO_EXTENSION);
                               $extensionPRODUCT = pathinfo($company->productos, PATHINFO_EXTENSION);
                               // Determinar si hay algún archivo disponible
                               $hasFiles = !empty($extensionCPREG) || !empty($extensionREGINV) || !empty($extensionEXAMICRO) || !empty($extensionBPM);
                            @endphp
                            <div class="tab">
                                <button type="button" class="tablinks" onclick="openCity(event, 'datosprincipales')"
                                        id="defaultOpen">Datos Principales</button>
                                <button type="button" class="tablinks" onclick="openCity(event, 'proveedor')"
                                        id="defaultOpen">Creación Proveedor</button>
                                <button type="button" class="tablinks" onclick="openCity(event, 'sanitarios')">
                                    Documentos Sanitarios</button>
                                <button type="button" class="tablinks"
                                        onclick="openCity(event, 'logistico')">Requerimientos logísticos y
                                    técnicos</button>
                            </div>
                            <div id="datosprincipales" class="tabcontent">
                                <h3>Datos principales de la empresa</h3>
                                <!-- card Comprobante registro -->
                                <div class="form-group">
                                    <label for="nit">Nit:</label>
                                    <input disabled value="{{$company->nit}}" type="text" class="form-control form-control-border" id="nit" name="nit" placeholder="Nit de la empresa">
                                </div>
                                <div class="form-group">
                                    <label for="razon_social">Razón social:</label>
                                    <input disabled value="{{$company->razon_social}}" type="text" class="form-control form-control-border" id="razon_social" name="razon_social" placeholder="Razón social de la empresa">
                                </div>
                                <div class="form-group">
                                    <label for="direccion_correspondencia">Dirección Correspondencia:</label>
                                    <input disabled value="{{$company->direccion_correspondencia}}" type="text" class="form-control form-control-border" id="direccion_correspondencia" name="direccion_correspondencia" placeholder="Direccion Correspondencia de la empresa">
                                </div>
                                <div class="form-group">
                                    <label for="correo_correspondencia">Correo Correspondencia:</label>
                                    <input disabled value="{{$company->correo_correspondencia}}" type="text" class="form-control form-control-border" id="correo_correspondencia" name="correo_correspondencia" placeholder="Correo Correspondencia de la empresa">
                                </div>
                                <div class="form-group">
                                    <label for="celular_correspondencia">Celular Correspondencia:</label>
                                    <input disabled value="{{$company->celular_correspondencia}}" type="text" class="form-control form-control-border" id="celular_correspondencia" name="celular_correspondencia" placeholder="Celular Correspondencia de la empresa">
                                </div>
                                <div class="form-group">
                                    <label for="ubicacion">Ubicacion en Campus:</label>
                                    <input disabled value="{{$company->ubicacion}}" type="text" class="form-control form-control-border" id="ubicacion" name="ubicacion" placeholder="Celular Correspondencia de la empresa">
                                </div>

                            </div>

                        @if ($hasFiles)
                                <div id="proveedor" class="tabcontent">
                                    <h3>Documentos Registro proveedor</h3>
                                    <!-- card Comprobante registro -->
                                    @if (!empty($extensionCPREG))
                                    <div class="col-sm-3 ">
                                        <div class="card" >
                                            <img src="/imagen/archivo.png" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-center">
                                                    <h5 class="card-title text-center">Comprobante Registro</h5>
                                                </div>
                                                <div class="d-flex justify-content-center mt-3">
                                                    <a class="btn btn-primary " href="{{ route('download.document', ['folder' => $company->nombre_empresa, 'filename' => 'comprobante_registro_'.$nombreEmpresa.'.'.$extensionCPREG]) }}">Descargar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                        <span>Aun no hay un documento en registro de Proveedor</span>
                                    @endif
                                </div>
                                <!-- Tab content -->
                                <div id="sanitarios" class="tabcontent">
                                    <h3>DOCUMENTOS SANITARIOS</h3>
                                    <div class="row">
                                        <!-- card Comprobante registro Invima-->
                                        <div class="col-sm-3">
                                            @if (!empty($extensionREGINV))
                                                <div class="card">
                                                    <img src="/imagen/archivo.png" class="card-img-top" alt="..." />
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-center">
                                                            <h5 class="card-title">Registro Invima</h5>
                                                        </div>
                                                        <div class="d-flex justify-content-center mt-3">
                                                            <a class="btn btn-primary" href="{{ route('download.document', ['folder' => $company->nombre_empresa, 'filename' => 'registro_invima_'.$nombreEmpresa.'.'.$extensionREGINV]) }}">Descargar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- card Examen Microbiologico -->
                                        <div class="col-sm-3">
                                            @if (!empty($extensionEXAMICRO))
                                                <div class="card">
                                                    <img src="/imagen/archivo.png" class="card-img-top" alt="..." />
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-center">
                                                            <h5 class="card-title">Examen Microbiologico</h5>
                                                        </div>
                                                        <div class="d-flex justify-content-center mt-3">
                                                            <a class="btn btn-primary" href="{{ route('download.document', ['folder' => $company->nombre_empresa, 'filename' => 'examen_microbiologico_'.$nombreEmpresa.'.'.$extensionEXAMICRO]) }}">Descargar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- card  BPM -->
                                        <div class="col-sm-3">
                                            @if (!empty($extensionBPM))
                                                <div class="card">
                                                    <img src="/imagen/archivo.png" class="card-img-top" alt="..." />
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-center">
                                                            <h5 class="card-title">BPM</h5>
                                                        </div>
                                                        <div class="d-flex justify-content-center mt-3">
                                                            <a class="btn btn-primary" href="{{ route('download.document', ['folder' => $company->nombre_empresa, 'filename' => 'bpm_'.$nombreEmpresa.'.'.$extensionBPM]) }}">Descargar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- card Formato SGSST -->
                                        <div class="col-sm-3">
                                            @if (!empty($extensionFORSGSST))
                                                <div class="card">
                                                    <img src="/imagen/archivo.png" class="card-img-top" alt="..." />
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-center">
                                                            <h5 class="card-title">Formato SGSST</h5>
                                                        </div>
                                                        <div class="d-flex justify-content-center mt-3">
                                                            <a class="btn btn-primary" href="{{ route('download.document', ['folder' => $company->nombre_empresa, 'filename' => 'formato_sgsst_'.$nombreEmpresa.'.'.$extensionFORSGSST]) }}">Descargar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- card Protocolo bioseguridad -->
                                        <div class="col-sm-3">
                                            @if (!empty($extensionPROBIO))
                                                <div class="card">
                                                    <img src="/imagen/archivo.png" class="card-img-top" alt="..." />
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-center">
                                                            <h5 class="card-title">Protocolo Bioseguridad</h5>
                                                        </div>
                                                        <div class="d-flex justify-content-center mt-3">
                                                            <a class="btn btn-primary" href="{{ route('download.document', ['folder' => $company->nombre_empresa, 'filename' => 'protocolos_bioseguridad_'.$nombreEmpresa.'.'.$extensionPROBIO]) }}">Descargar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- card Plan saneamiento Basico -->
                                        <div class="col-sm-3">
                                            @if (!empty($extensionPLANSANE))
                                                <div class="card">
                                                    <img src="/imagen/archivo.png" class="card-img-top" alt="..." />
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-center">
                                                            <h5 class="card-title">Plan Saneamiento Básico</h5>
                                                        </div>
                                                        <div class="d-flex justify-content-center mt-3">
                                                            <a class="btn btn-primary" href="{{ route('download.document', ['folder' => $company->nombre_empresa, 'filename' => 'plan_saneamiento_'.$nombreEmpresa.'.'.$extensionPLANSANE]) }}">Descargar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- card Copia carnet manipulacion de alimentos -->
                                        <div class="col-sm-3">
                                            @if (!empty($extensionCPCARMANIP))
                                                <div class="card">
                                                    <img src="/imagen/archivo.png" class="card-img-top" alt="..." />
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-center">
                                                            <h5 class="card-title" title="Carnet Manipulación Alimentos">Carnet Manipulación Alimen...</h5>
                                                        </div>
                                                        <div class="d-flex justify-content-center mt-3">
                                                            <a class="btn btn-primary" href="{{ route('download.document', ['folder' => $company->nombre_empresa, 'filename' => 'copia_carnet_manipulacion_'.$nombreEmpresa.'.'.$extensionCPCARMANIP]) }}">Descargar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- card Copia carnet vacunacion covid -->
                                        <div class="col-sm-3">
                                            @if (!empty($extensionCPCARMANIP))
                                                <div class="card">
                                                    <img src="/imagen/archivo.png" class="card-img-top" alt="..." />
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-center">
                                                            <h5 class="card-title" title="Carnet Manipulación Alimentos">Carnet Vacunacion Covid</h5>
                                                        </div>
                                                        <div class="d-flex justify-content-center mt-3">
                                                            <a class="btn btn-primary" href="{{ route('download.document', ['folder' => $company->nombre_empresa, 'filename' => 'copia_carnet_vacunacion_'.$nombreEmpresa.'.'.$extensionCPCARVACU]) }}">Descargar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- card Copia plantilla arp -->
                                        <div class="col-sm-3">
                                            @if (!empty($extensionARP))
                                                <div class="card">
                                                    <img src="/imagen/archivo.png" class="card-img-top" alt="..." />
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-center">
                                                            <h5 class="card-title" title="Carnet Manipulación Alimentos">Plantilla ARP</h5>
                                                        </div>
                                                        <div class="d-flex justify-content-center mt-3">
                                                            <a class="btn btn-primary" href="{{ route('download.document', ['folder' => $company->nombre_empresa, 'filename' => 'copia_plantilla_arp_'.$nombreEmpresa.'.'.$extensionARP]) }}">Descargar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- card Logo -->
                                        <div class="col-sm-3">
                                            @if (!empty($extensionLogo))
                                                <div class="card">
                                                    <img src="/imagen/archivo.png" class="card-img-top" alt="..." />
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-center">
                                                            <h5 class="card-title" title="Carnet Manipulación Alimentos">Logo</h5>
                                                        </div>
                                                        <div class="d-flex justify-content-center mt-3">
                                                            <a class="btn btn-primary" href="{{ route('download.document', ['folder' => $company->nombre_empresa, 'filename' => 'logo_'.$nombreEmpresa.'.'.$extensionLogo]) }}">Descargar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- card Logo -->
                                        <div class="col-sm-3">
                                            @if (!empty($extensionPRODUCT))
                                                <div class="card">
                                                    <img src="/imagen/archivo.png" class="card-img-top" alt="..." />
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-center">
                                                            <h5 class="card-title" title="Carnet Manipulación Alimentos">Productos</h5>
                                                        </div>
                                                        <div class="d-flex justify-content-center mt-3">
                                                            <a class="btn btn-primary" href="{{ route('download.document', ['folder' => $company->nombre_empresa, 'filename' => 'productos_'.$nombreEmpresa.'.'.$extensionPRODUCT]) }}">Descargar</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div id="logistico" class="tabcontent">
                                    <h3>Requerimientos logísticos</h3>
                                    <label>Personal que ingresará durante semana al evento:</label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="item_table">
                                            <thead>
                                            <tr>
                                                <th>Nombre y Apellido</th>
                                                <th>Número de identificación</th>
                                                <th>Tipo de empleado</th>
                                                <th>Placa de vehiculo</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbody">
                                            @php
                                                $logisticos = ($company->logistico) ? json_decode($company->logistico, true) : [];
                                            @endphp

                                            @foreach ($logisticos as $reqlogisticos)
                                                <tr>
                                                    <td>{{ $reqlogisticos['names'] }}</td>
                                                    <td>{{ $reqlogisticos['identification_number'] }}</td>
                                                    <td>{{ $reqlogisticos['employee_type'] }}</td>
                                                    <td>{{ $reqlogisticos['vehicle_license_plate'] }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <h3>Requerimientos eléctricos</h3>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="item_table">
                                            <thead>
                                            <tr>
                                                <th>Elemento a ingresar (ej: nevera, parrilla, microondas, caja registradora, etc.)</th>
                                                <th>Cantidad</th>
                                                <th>Vatios (w) individuales</th>
                                                <th>Amperios individuales que consume cada equipo</th>
                                                <th>Cantidad de tomas eléctricas de 110v</th>
                                                <th>Cantidad tomas eléctricas de 220v</th>
                                                <th>¿Es trifásica?</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbody_elect">
                                            @php
                                                $electrico = ($company->electrico) ? json_decode($company->electrico, true) : [];
                                            @endphp

                                            @foreach ($electrico as $reqelectrico)
                                                <tr>
                                                    <td>{{ $reqelectrico['elements'] }}</td>
                                                    <td>{{ $reqelectrico['count'] }}</td>
                                                    <td>{{ $reqelectrico['vatios'] }}</td>
                                                    <td>{{ $reqelectrico['amperios'] }}</td>
                                                    <td>{{ $reqelectrico['110'] }}</td>
                                                    <td>{{ $reqelectrico['220'] }}</td>
                                                    <td>{{ $reqelectrico['tri'] }}</td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <fieldset class="form-group">
                                        <div class="row">
                                            <legend class="col-form-label col-sm-2 pt-0">¿Usará gas?</legend>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input disabled class="form-check-input" type="radio" name="gas" id="gas_si" value="Si" {{ $company->gas == 'Si' ? 'checked' : '' }}/>
                                                    <label class="form-check-label" for="gas_si">
                                                        Si
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input disabled class="form-check-input" type="radio" name="gas" id="gas_no" value="No" {{ $company->gas == 'No' ? 'checked' : '' }}/>
                                                    <label class="form-check-label" for="gas_no">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <div class="row">
                                            <legend class="col-form-label col-sm-2 pt-0">¿Traerá carpa propia?</legend>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input disabled class="form-check-input" type="radio" name="carpa" id="carpa_si" value="Si" {{ $company->carpa == 'Si' ? 'checked' : '' }}/>
                                                    <label class="form-check-label" for="carpa_si">
                                                        Si
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input disabled class="form-check-input" type="radio" name="carpa" id="carpa_no" value="No" {{ $company->carpa == 'No' ? 'checked' : '' }}/>
                                                    <label class="form-check-label" for="carpa_no">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tamaño_carpa">Tamaño de la carpa: </label>
                                                <input type="text" class="form-control" id="tamaño_carpa" disabled name="tamaño_carpa" value="{{$company->tamaño_carpa}}"/>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <h3>Medios de pago</h3>
                                    <table class="table table-bordered" id="item_table">
                                        <thead>
                                        <tr>
                                            <th>Medio de pago</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tbody_pago">
                                        @php
                                            $medioPago = ($company->array_medios_pago) ? json_decode($company->array_medios_pago, true) : [];
                                        @endphp

                                        @foreach ($medioPago as $respMedioPago)
                                            <tr>
                                                <td>{{ $respMedioPago['elements'] }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="form-group">
                                        <label for="observaciones">Observaciones adicionales:</label>
                                        <textarea class="form-control" id="observaciones" name="observaciones" rows="3" disabled>{{$company->observaciones}}</textarea>
                                    </div>
                                </div>
                            @else
                                <p class="mt-3 text-center">Esta empresa aún no cuenta con ningún archivo disponible.</p>
                            @endif

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('js')

    <script>
        document.getElementById("defaultOpen").click();

        function openCity(evt, tabName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
        var counter = 0;

        $(document).on("click", ".add", function() {

            var html = "";
            html += "<tr>";
            html += '<td><input type="text" name="logistico[' + counter +
                '][names]" class="form-control item_name" /></td>';
            html += '<td><input type="text" name="logistico[' + counter +
                '][identification_number]" class="form-control item_name" /></td>';
            html += '<td><select class="custom-select form-control-border" name="logistico[' + counter +
                '][employee_type]" id="pay_id"><option selected>--Seleccionar Pago--</option><option value="Conductor">Conductor</option><option value="Cajero">Cajero</option><option value="Cocinero">Cocinero</option><option value="Otro">Otro</option></select></td>';
            html += '<td><input type="text" name="logistico[' + counter +
                '][vehicle_license_plate]" class="form-control item_name" /></td>';
            html +=
                '<td><a type="button" name="remove" class="btn btn-danger btn-xs remove"><i class="fas fa-trash"></i></a></td>';
            $("#tbody").append(html);
            counter++;
        });

        $(document).on("click", ".remove", function() {
            $(this).closest("tr").remove();
        });

        var counter2 = 0;

        $(document).on("click", ".add_elect", function() {

            var html = "";
            html += "<tr>";
            html += '<td><input type="text" name="electrico[' + counter2 +
                '][elements]" class="form-control item_name" /></td>';
            html += '<td><input type="text" name="electrico[' + counter2 +
                '][count]" class="form-control item_name" /></td>';
            html += '<td><input type="text" name="electrico[' + counter2 +
                '][vatios]" class="form-control item_name" /></td>';
            html += '<td><input type="text" name="electrico[' + counter2 +
                '][amperios]" class="form-control item_name" /></td>';
            html += '<td><input type="text" name="electrico[' + counter2 +
                '][110]" class="form-control item_name" /></td>';
            html += '<td><input type="text" name="electrico[' + counter2 +
                '][220]" class="form-control item_name" /></td>';
            html += '<td><select class="custom-select form-control-border" name="electrico[' + counter2 +
                '][tri]" id="pay_id"><option selected>--Seleccionar Pago--</option><option value="Si">Si</option><option value="No">No</option>';
            html +=
                '<td><a type="button" name="remove_elect" class="btn btn-danger btn-xs remove_elect"><i class="fas fa-trash"></i></a></td>';
            $("#tbody_elect").append(html);
            counter2++;
        });

        $(document).on("click", ".remove_elect", function() {
            $(this).closest("tr").remove();
        });

        var counter3 = 0;

        $(document).on("click", ".add_pago", function() {

            var html = "";
            html += "<tr>";
            html += '<td><input type="text" name="array_medios_pago[' + counter3 +
                '][elements]" class="form-control item_name" /></td>';
            html +=
                '<td><a type="button" name="remove_pago" class="btn btn-danger btn-xs remove_pago"><i class="fas fa-trash"></i></a></td>';
            $("#tbody_pago").append(html);
            counter2++;
        });

        $(document).on("click", ".remove_pago", function() {
            $(this).closest("tr").remove();
        });
    </script>
@endsection
