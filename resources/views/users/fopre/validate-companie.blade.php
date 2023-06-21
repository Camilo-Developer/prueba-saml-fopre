@extends('layouts.app')
@section('title', 'Validacion de documentos - Empresas')
@section('content')
    <!--Migas de pan-->
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
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Validación de documentos: {{auth()->user()->companys()->pluck('nombre_empresa')->first()}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Validación de documentos</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!--Contenido- Formulario-->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default color-palette-box">
                        <div class="card-body">
                            <div class="col-12">
                                <form action="{{ route('companies.edit_documents', ['company' => $company->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf

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

                                        @if (!empty($company->nit))
                                            <div class="form-group">
                                                <label for="nit">Nit:</label>
                                                <input value="{{$company->nit}}"  type="text" class="form-control form-control-border" id="nit" name="nit" placeholder="Nit de la empresa">
                                            </div>
                                            <span class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>   Ya cuenta con informacion es este campo</span><br>
                                        @else
                                            <div class="form-group mt-2">
                                                <label for="nit">Nit:</label>
                                                <input  type="text" class="form-control form-control-border" id="nit" name="nit" placeholder="Nit de la empresa">
                                            </div>
                                            <span class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i>   Aun no a cargado información en campo</span><br>
                                        @endif
                                        @if (!empty($company->razon_social))
                                        <div class="form-group">
                                            <label for="razon_social">Razón social:</label>
                                            <input value="{{$company->razon_social}}"  type="text" class="form-control form-control-border" id="razon_social" name="razon_social" placeholder="Razón social de la empresa">
                                        </div>
                                            <span class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>   Ya cuenta con informacion es este campo</span><br>

                                        @else
                                            <div class="form-group mt-2">
                                                <label for="razon_social">Razón social:</label>
                                                <input  type="text" class="form-control form-control-border" id="razon_social" name="razon_social" placeholder="Razón social de la empresa">
                                            </div>
                                            <span class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i>   Aun no a cargado información en campo</span><br>
                                        @endif
                                        @if (!empty($company->direccion_correspondencia))
                                        <div class="form-group mt-2">
                                            <label for="direccion_correspondencia">Dirección Correspondencia:</label>
                                            <input value="{{$company->direccion_correspondencia}}"  type="text" class="form-control form-control-border" id="direccion_correspondencia" name="direccion_correspondencia" placeholder="Direccion Correspondencia de la empresa">
                                        </div>
                                            <span class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>   Ya cuenta con informacion es este campo</span><br>

                                        @else
                                            <div class="form-group">
                                                <label for="direccion_correspondencia">Dirección Correspondencia:</label>
                                                <input   type="text" class="form-control form-control-border" id="direccion_correspondencia" name="direccion_correspondencia" placeholder="Direccion Correspondencia de la empresa">
                                            </div>
                                            <span class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i>   Aun no a cargado información en campo</span><br>
                                        @endif
                                        @if (!empty($company->correo_correspondencia))
                                        <div class="form-group">
                                            <label for="correo_correspondencia">Correo Correspondencia:</label>
                                            <input value="{{$company->correo_correspondencia}}" type="text" class="form-control form-control-border" id="correo_correspondencia" name="correo_correspondencia" placeholder="Correo Correspondencia de la empresa">
                                        </div>
                                            <span class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>   Ya cuenta con informacion es este campo</span><br>

                                        @else
                                            <div class="form-group mt-2">
                                                <label for="correo_correspondencia">Correo Correspondencia:</label>
                                                <input  type="text" class="form-control form-control-border" id="correo_correspondencia" name="correo_correspondencia" placeholder="Correo Correspondencia de la empresa">
                                            </div>
                                            <span class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i>   Aun no a cargado información en campo</span><br>
                                        @endif
                                        @if (!empty($company->celular_correspondencia))
                                        <div class="form-group mt-2">
                                            <label for="celular_correspondencia">Celular Correspondencia:</label>
                                            <input value="{{$company->celular_correspondencia}}" type="text" class="form-control form-control-border" id="celular_correspondencia" name="celular_correspondencia" placeholder="Celular Correspondencia de la empresa">
                                        </div>
                                            <span class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>   Ya cuenta con informacion es este campo</span><br>

                                        @else
                                            <div class="form-group">
                                                <label for="celular_correspondencia">Celular Correspondencia:</label>
                                                <input  type="text" class="form-control form-control-border" id="celular_correspondencia" name="celular_correspondencia" placeholder="Celular Correspondencia de la empresa">
                                            </div>
                                            <span class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i>  Aun no a cargado información en campo</span><br>
                                        @endif
                                    </div>
                                    <div id="proveedor" class="tabcontent">
                                        <h3>Registro proveedor</h3>

                                        <div>
                                            <p>Buen día {{ auth()->user()->name }}</p>
                                            <p>
                                                A través del
                                                <b>
                                                    <span>
                                                        <a href="https://enyy.fa.us2.oraclecloud.com/fscmUI/faces/PrcPosRegisterSupplier?prcBuId=300000003032097&amp;busRel=qsR49h%2BlN4i3J3ZqdzK568c47WYCPDBpqw%3D%3D"
                                                            target="_blank">
                                                            Link de autorregistro proveedor de Gasto autorizado
                                                        </a>
                                                    </span>
                                                </b>
                                                puede realizar el proceso de autorregistro como proveedor de autorizado de
                                                la Universidad para poder transaccionar con esta.
                                                <b><u>Por favor tenga en cuenta las recomendaciones para el adecuado
                                                        diligenciamiento del formulario, que puede revisar en el manual
                                                        anexo</u></b>.
                                            </p>
                                            <p><span>Adicionalmente, con la aprobación de registro, se le </span>dará acceso
                                                al portal de proveedores para gestionar las diferentes tareas que le
                                                permite, las cuales le relaciono a continuación:<span></span></p>
                                            <p>
                                                <b>
                                                    <span>Acciones que <u>SI</u> se pueden ejecutar en el Portal de
                                                        Proveedores</span>
                                                </b>
                                                <span>:</span>
                                            </p>
                                            <ul>
                                                <li>
                                                    <b><span>Gestionar Perfil: </span></b>
                                                    <span>
                                                        tarea que permite al proveedor visualizar su información registrada.
                                                        Podrá crear una solicitud de cambio en su perfil actualizando y
                                                        editando su información. Estos cambios serán notificados y
                                                        requerirán aprobación por parte
                                                        de Uniandes.
                                                    </span>
                                                </li>
                                                <li>
                                                    <b><span>Gestionar Órdenes de Compra y Acuerdos de Compra: </span></b>
                                                    <span>
                                                        tarea que permite consultar las Órdenes de Compra y Acuerdos que han
                                                        sido generados al proveedor por parte de la Universidad, su estado y
                                                        contenido.
                                                    </span>
                                                </li>
                                                <li>
                                                    <b><span>Acusar recibo: </span></b>
                                                    <span>
                                                        es la acción que permite al proveedor confirmar la aceptación del
                                                        documento (Orden de Compra o Acuerdo de Copra) mediante la opción
                                                        confirmación.
                                                    </span>
                                                </li>
                                                <li>
                                                    <b><span>Orden de Cambio: </span></b>
                                                    <span>
                                                        tarea que se puede utilizar cuando el proveedor desea cambiar la
                                                        orden o el acuerdo. Esta opción es utilizada cando el proveedor
                                                        requiere notificar un cambio acerca de cualquier atributo del
                                                        documento de compra. Todo cambio
                                                        generado requerirá la aprobación del comprador de Uniandes.
                                                    </span>
                                                </li>
                                                <li>
                                                    <b><span>Rechazo: </span> </b>
                                                    <span>
                                                        es la acción que permite que el proveedor pueda rechazar la orden de
                                                        compra o el acuerdo con justificación y comentarios. La aplicación
                                                        notifica al comprador de Uniandes sobre el rechazo del documento de
                                                        compra. El comprador
                                                        puede revisar los comentarios o la justificación enviada por el
                                                        proveedor y tomar las medidas necesarias en el documento de compra.
                                                    </span>
                                                </li>
                                                <li>
                                                    <b><span>Gestionar Entregables: </span></b>
                                                    <span>permite consultar y anexar los entregables que sean definidos como
                                                        complemento a una Orden de Compra. </span>
                                                </li>
                                                <li>
                                                    <b><span>Ver Recepción: </span> </b>
                                                    <span>
                                                        acción que le permite al proveedor visualizar el número de recepción
                                                        que registra Uniandes cuando recibe los bienes o servicios a
                                                        satisfacción de una Orden de Compra.
                                                    </span>
                                                </li>
                                                <li>
                                                    <b><span>Ver Facturas y Pagos: </span></b>
                                                    <span>permite visualizar las facturas registradas, así como las fechas
                                                        programadas de pago. </span>
                                                </li>
                                                <li>
                                                    <b><span>Respuestas a cuestionarios de calificación: </span></b>
                                                    <span>
                                                        opción que permite capturar las respuestas de los proveedores que
                                                        responden a preguntas en procesos de evaluación de proveedores. Los
                                                        encuestados pueden guardar y actualizar la respuesta del
                                                        cuestionario en cualquier momento
                                                        antes de enviarlo para su aceptación.
                                                    </span>
                                                </li>
                                                <li>
                                                    <b><span>Respuestas a Negociación</span></b><b><span>: </span></b>
                                                    <span>opción que permite capturar las respuestas de los proveedores a
                                                        invitaciones de negociaciones generadas por la Universidad.</span>
                                                </li>
                                            </ul>
                                            <p>
                                                <b>
                                                    <span>Acciones que <u>NO</u> se pueden ejecutar en el Portal de
                                                        Proveedores</span>
                                                </b>
                                                <span>:</span><span></span>
                                            </p>
                                            <ul>
                                                <li>
                                                    <b><span>Generar o radicar facturas: </span></b>
                                                    <span>
                                                        El proceso de radicación es de forma externa a la plataforma.
                                                        <b>
                                                            <u>
                                                                El proveedor debe seguir las indicaciones del proceso de
                                                                radicación de facturas (Ver en
                                                                <a href="https://servicios.uniandes.edu.co/zona-proveedores/"
                                                                    target="_blank">
                                                                    https://servicios.uniandes.edu.co/zona-proveedores/
                                                                </a>
                                                                )
                                                            </u>
                                                        </b>
                                                    </span>
                                                    <span></span>
                                                </li>
                                                <li>
                                                    <b><span>Generar y/o descargar comprobantes de pago de
                                                            facturas:</span></b><span> Se deben solicitar vía correo a
                                                    </span>
                                                    <span>
                                                        <a href="mailto:serviciosvaf@uniandes.edu.co" target="_blank">
                                                            <span>serviciosvaf@uniandes.edu.co</span>
                                                        </a>
                                                    </span>
                                                    <span>.</span>
                                                </li>
                                                <li>
                                                    <b><span>Generar y/o descargar certificaciones de
                                                            retenciones</span></b><span>: Se deben solicitar vía correo a
                                                    </span>
                                                    <span>
                                                        <a href="mailto:certificadosretencion@uniandes.edu.co"
                                                            target="_blank">
                                                            <span>certificadosretencion@uniandes.edu.co</span>
                                                        </a>
                                                    </span>
                                                    <span>.</span>
                                                </li>
                                            </ul>
                                            <p>
                                                ¡¡¡<b>IMPORTANTE</b>!!!: Por favor diligenciar todo el formulario y al
                                                finalizar la entrega de información y documentación exigida, dar clic en el
                                                botón de “
                                                <b>
                                                    <u><span>Registrar</span></u>
                                                </b>
                                                ” para que la solicitud sea enviada a aprobación por parte de la
                                                Universidad:
                                            </p>
                                            <p>
                                                Cualquier inquietud la puede aclarar en nuestra página de
                                                <b>
                                                    <span>
                                                        <a href="https://servicios.uniandes.edu.co/zona-proveedores/"
                                                            target="_blank">
                                                            https://servicios.uniandes.edu.co/zona-proveedores/
                                                        </a>
                                                    </span>
                                                    ,
                                                </b>
                                                <span>que contiene<b> </b></span>información de interés para proveedores de
                                                la Universidad. En caso de no resolver sus dudas, puede escalar sus
                                                preguntas a través del correo
                                                <a href="mailto:proveedorescompras@uniandes.edu.co" target="_blank">
                                                    proveedorescompras@uniandes.edu.co
                                                </a>
                                                .
                                            </p>
                                            <p>
                                                <a><span>Saludos,</span></a>
                                            </p>
                                        </div>


                                        <label>Seleccione comprobante del registro: </label>
                                        <div class="custom-file mb-2">
                                            <input type="file" class="custom-file-input" name="comprobante_registro"
                                                id="comprobante_registro" value="" title="" onchange="updateFileName(this)"/>
                                            <label class="custom-file-label" for="comprobante_registro">Seleccione el archivo:</label>
                                        </div>
                                        @if (!empty($company->comprobante_registro))
                                            @php
                                                $fileName = basename($company->comprobante_registro);
                                            @endphp
                                            <span class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>   Ya cuenta con informacion es este campo: {{ $fileName }}</span><br>
                                        @else
                                            <span class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Aun no a subido ningun archivo en este campo</span><br>
                                        @endif

                                    </div>

                                    <!-- Tab content -->
                                    <div id="sanitarios" class="tabcontent">
                                        <h3>DOCUMENTOS SANITARIOS</h3>

                                        <label>Acta de inspección, vigilancia y control expedida por la Secretaría de Salud
                                            o INVIMA (según el caso) del punto de venta o planta de producción (Vigencia
                                            anual), con concepto favorable sanitario:</label>
                                        <div class="custom-file mb-2">
                                            <input type="file" class="custom-file-input" name="registro_invima"
                                                id="registro_invima" title="" onchange="updateFileName(this)"/>
                                            <label class="custom-file-label" for="registro_invima">Seleccione el archivo:</label>
                                        </div>
                                        @if (!empty($company->registro_invima))
                                            @php
                                                $fileName = basename($company->registro_invima);
                                            @endphp
                                            <span class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>   Ya cuenta con informacion es este campo: {{ $fileName }}</span><br>
                                        @else
                                            <span class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Aun no a subido ningun archivo en este campo</span><br>
                                        @endif
                                        <label>Examen microbiológico del producto terminado, anexar el resultado:</label>
                                        <div class="custom-file mb-2">
                                            <input type="file" class="custom-file-input" name="examen_microbiologico"
                                                id="examen_microbiologico" title="" onchange="updateFileName(this)"/>
                                            <label class="custom-file-label" for="examen_microbiologico">Seleccione el archivo:</label>
                                        </div>
                                        @if (!empty($company->examen_microbiologico))
                                            @php
                                                $fileName = basename($company->examen_microbiologico);
                                            @endphp
                                            <span class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>   Ya cuenta con informacion es este campo: {{ $fileName }}</span><br>
                                        @else
                                            <span class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Aun no a subido ningun archivo en este campo</span><br>
                                        @endif
                                        <label>Proceso de aseguramiento de calidad en área de producción, trasporte y
                                            distribución (BPM):</label>
                                        <div class="custom-file mb-2">
                                            <input type="file" class="custom-file-input" name="bpm"
                                                id="bpm" title="" onchange="updateFileName(this)"/>
                                            <label class="custom-file-label" for="bpm">Seleccione el archivo:</label>
                                        </div>
                                        @if (!empty($company->bpm))
                                            @php
                                                $fileName = basename($company->bpm);
                                            @endphp
                                            <span class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>   Ya cuenta con informacion es este campo: {{ $fileName }}</span><br>
                                        @else
                                            <span class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Aun no a subido ningun archivo en este campo</span><br>
                                        @endif

                                        <label>Formato SGSST que hayan presentado a la ARL si aun no cuentan con el
                                            resultado:</label>
                                        <div class="custom-file mb-2">
                                            <input type="file" class="custom-file-input" name="formato_sgsst"
                                                id="formato_sgsst" title="" onchange="updateFileName(this)"/>
                                            <label class="custom-file-label" for="formato_sgsst">Seleccione el archivo:</label>
                                        </div>
                                        @if (!empty($company->formato_sgsst))
                                            @php
                                                $fileName = basename($company->formato_sgsst);
                                            @endphp
                                            <span class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>   Ya cuenta con informacion es este campo: {{ $fileName }}</span><br>
                                        @else
                                            <span class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Aun no a subido ningun archivo en este campo</span><br>
                                        @endif
                                        <label>Protocolos de bioseguridad:</label>
                                        <div class="custom-file mb-2">
                                            <input type="file" class="custom-file-input" name="protocolos_bioseguridad"
                                                id="protocolos_bioseguridad" title="" onchange="updateFileName(this)"/>
                                            <label class="custom-file-label" for="protocolos_bioseguridad">Seleccione el archivo:</label>
                                        </div>
                                        @if (!empty($company->protocolos_bioseguridad))
                                            @php
                                                $fileName = basename($company->protocolos_bioseguridad);
                                            @endphp
                                            <span class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>   Ya cuenta con informacion es este campo: {{ $fileName }}</span><br>
                                        @else
                                            <span class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Aun no a subido ningun archivo en este campo</span><br>
                                        @endif
                                        <label>Plan de saneamiento básico:</label>
                                        <div class="custom-file mb-2">
                                            <input type="file" class="custom-file-input" name="plan_saneamiento"
                                                id="plan_saneamiento" title="" onchange="updateFileName(this)"/>
                                            <label class="custom-file-label" for="plan_saneamiento">Seleccione el archivo:</label>
                                        </div>
                                        @if (!empty($company->plan_saneamiento))
                                            @php
                                                $fileName = basename($company->plan_saneamiento);
                                            @endphp
                                            <span class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>   Ya cuenta con informacion es este campo: {{ $fileName }}</span><br>
                                        @else
                                            <span class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Aun no a subido ningun archivo en este campo</span><br>
                                        @endif
                                        <label>Copia del carné de manipulación de alimentos de las personas que ingresarán a
                                            la Universidad:</label>
                                        <div class="custom-file mb-2">
                                            <input type="file" class="custom-file-input" name="copia_carnet_manipulacion"
                                                id="copia_carnet_manipulacion" title="" onchange="updateFileName(this)"/>
                                            <label class="custom-file-label" for="copia_carnet_manipulacion">Seleccione el archivo:</label>
                                        </div>
                                        @if (!empty($company->copia_carnet_manipulacion))
                                            @php
                                                $fileName = basename($company->copia_carnet_manipulacion);
                                            @endphp
                                            <span class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>   Ya cuenta con informacion es este campo: {{ $fileName }}</span><br>
                                        @else
                                            <span class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Aun no a subido ningun archivo en este campo</span><br>
                                        @endif
                                        <label>Copia del carné de vacunación Covid con el esquema completo de las personas
                                            que ingresarán a la Universidad:</label>
                                        <div class="custom-file mb-2">
                                            <input type="file" class="custom-file-input" name="copia_carnet_vacunacion"
                                                id="copia_carnet_vacunacion" title="" onchange="updateFileName(this)"/>
                                            <label class="custom-file-label" for="copia_carnet_vacunacion">Seleccione el archivo:</label>
                                        </div>
                                        @if (!empty($company->copia_carnet_vacunacion))
                                            @php
                                                $fileName = basename($company->copia_carnet_vacunacion);
                                            @endphp
                                            <span class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>   Ya cuenta con informacion es este campo: {{ $fileName }}</span><br>
                                        @else
                                            <span class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Aun no a subido ningun archivo en este campo</span><br>
                                        @endif
                                        <label>Copia de las planillas de ARP y EPS de los empleados que ingresarán a la
                                            Universidad de Los Andes:</label>
                                        <div class="custom-file mb-2">
                                            <input type="file" class="custom-file-input" name="copia_plantilla_arp"
                                                id="copia_plantilla_arp" title="" onchange="updateFileName(this)"/>
                                            <label class="custom-file-label" for="copia_plantilla_arp">Seleccione el archivo:</label>
                                        </div>
                                        @if (!empty($company->copia_plantilla_arp))
                                            @php
                                                $fileName = basename($company->copia_plantilla_arp);
                                            @endphp
                                            <span class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>   Ya cuenta con informacion es este campo: {{ $fileName }}</span><br>
                                        @else
                                            <span class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Aun no a subido ningun archivo en este campo</span><br>
                                        @endif
                                        <label>Logo en alta resolución (Photoshop o AI en curvas):</label>
                                        <div class="custom-file mb-2">
                                            <input type="file" class="custom-file-input" name="logo"
                                                id="logo" title="" onchange="updateFileName(this)"/>
                                            <label class="custom-file-label" for="logo">Seleccione el archivo:</label>
                                        </div>
                                        @if (!empty($company->logo))
                                            @php
                                                $fileName = basename($company->logo);
                                            @endphp
                                            <span class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>   Ya cuenta con informacion es este campo: {{ $fileName }}</span><br>
                                        @else
                                            <span class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Aun no a subido ningun archivo en este campo</span><br>
                                        @endif
                                        <label>Suba el listado de sus productos con la siguiente <a
                                                href="{{ asset('recursos/users/img/Plantilla Productos.xlsx') }}">plantilla</a>:</label>
                                        <label>* Debe enviar descripción del producto tal y como desea que aparezca en
                                            nuestro menú. Favor diligenciar con la ortografía y redacción correcta y NO en
                                            mayúsculas. </label>
                                        <label>** Recuerde que los precios deben ser cerrados y con IVA/Impoconsumo incluido
                                            y en ningún caso el precio del FOPRE podrá superar el de sus puntos de venta
                                            externos. Indispensable la venta de bebidas. (precio máximo que se manejará
                                            $20.000 por plato) </label>
                                        <div class="custom-file mb-2">
                                            <input type="file" class="custom-file-input" name="productos"
                                                id="productos" title="" onchange="updateFileName(this)"/>
                                            <label class="custom-file-label" for="productos">Seleccione el archivo:</label>
                                        </div>
                                        @if (!empty($company->productos))
                                            @php
                                                $fileName = basename($company->productos);
                                            @endphp
                                            <span class="text-success"><i class="fa fa-check-circle" aria-hidden="true"></i>   Ya cuenta con informacion es este campo: {{ $fileName }}</span><br>
                                        @else
                                            <span class="text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Aun no a subido ningun archivo en este campo</span><br>
                                        @endif
                                    </div>

                                    <div id="logistico" class="tabcontent">
                                        <h3>Requerimientos logísticos</h3>
                                        <label>Personal que ingresará durante semana del evento Fopre Café para: montaje,
                                            desmontaje, conductores, cajeros, cocineros etc.)</label>
                                        <label for="">*Todas las personas de este listado y que vayan a trabajar en
                                            el evento (desde el montaje en adelante, incluídos transportadores), deberán
                                            estar afiliados a ARL y EPS.</label>
                                        <label for="">**No se aceptarán cartas exhimiendo resposabilidad</label>
                                        <table class="table table-bordered" id="item_table">
                                            <thead>
                                                <tr>
                                                    <th>Nombre y Apellido</th>
                                                    <th>Número de identificación</th>
                                                    <th>Tipo de empleado</th>
                                                    <th>Placa de vehiculo</th>
                                                    <th><a name="add" class="btn btn-success btn-xs add"><i
                                                                class="fas fa-plus"></i></a></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody"></tbody>
                                        </table>
                                        <h3>Requerimientos eléctricos</h3>
                                        <table class="table table-bordered" id="item_table">
                                            <thead>
                                                <tr>
                                                    <th>Elemento a ingresar (ej: nevera, parrilla, microondas, caja
                                                        registradora, etc.)</th>
                                                    <th>Cantidad</th>
                                                    <th>Vatios (w) individuales</th>
                                                    <th>Amperios individuales que consume cada equipo</th>
                                                    <th>Cantidad de tomas eléctricas de 110v</th>
                                                    <th>Cantidad tomas eléctricas de 220v</th>
                                                    <th>¿Es trifásica?</th>
                                                    <th><a name="add_elect" class="btn btn-success btn-xs add_elect"><i
                                                                class="fas fa-plus"></i></a></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_elect"></tbody>
                                        </table>
                                        <fieldset class="form-group">
                                            <div class="row">
                                                <legend class="col-form-label col-sm-2 pt-0">¿Usará gas?</legend>
                                                <div class="col-sm-10">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"  name="gas"
                                                            id="gas_si" value="Si" {{ $company->gas == 'Si' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="gas_si">
                                                            Si
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gas"
                                                            id="gas_no" value="No" {{ $company->gas == 'No' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="gas_no">
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <label>*No olvide cumplir con los requisitos de seguridad en cilindros y
                                                mangueras (prueba obligatoria, se les confirmará horario)</label>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <div class="row">
                                                <legend class="col-form-label col-sm-2 pt-0">¿Traerá carpa propia?</legend>
                                                <div class="col-sm-10">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="carpa"
                                                            id="carpa_si" value="Si" {{ $company->carpa == 'Si' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="carpa_si">
                                                            Si
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="carpa"
                                                            id="carpa_no" value="No" {{ $company->carpa == 'No' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="carpa_no">
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tamaño_carpa">¿Cuál es el tamaño?</label>
                                                    <input type="text" class="form-control" id="tamaño_carpa"
                                                        name="tamaño_carpa" value="{{$company->tamaño_carpa}}">
                                                </div>
                                            </div>
                                        </fieldset>
                                        <h3>Medios de pago</h3>
                                        <table class="table table-bordered" id="item_table">
                                            <thead>
                                                <tr>
                                                    <th>Medio de pago</th>
                                                    <th><a name="add_pago" class="btn btn-success btn-xs add_pago"><i
                                                                class="fas fa-plus"></i></a></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_pago"></tbody>
                                        </table>
                                        <div class="form-group">
                                            <label for="observaciones">Observaciones adicionales:</label>
                                            <textarea class="form-control" id="observaciones" name="observaciones" rows="3">{{$company->observaciones}}</textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Actualizar documentos</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script>
        function updateFileName(input) {
            const fileLabel = input.parentNode.querySelector('.custom-file-label');
            fileLabel.textContent = input.files[0].name;
        }
    </script>
    <script>
        $(document).ready(function() {
            // Verificar si hay información en "logistico" y prellenar las filas
            var logistico = JSON.parse('<?php echo addslashes($company->logistico); ?>'); // Asegúrate de que $logistico contenga el valor JSON en PHP
            if (logistico && logistico.length > 0) {
                for (var i = 0; i < logistico.length; i++) {
                    var html = "";
                    html += "<tr>";
                    html +=
                        '<td><input type="text" name="logistico[' +
                        counter +
                        '][names]" class="form-control item_name" value="' +
                        logistico[i].names +
                        '" /></td>';
                    html +=
                        '<td><input type="text" name="logistico[' +
                        counter +
                        '][identification_number]" class="form-control item_name" value="' +
                        logistico[i].identification_number +
                        '" /></td>';
                    html +=
                        '<td><select class="custom-select form-control-border" name="logistico[' +
                        counter +
                        '][employee_type]" id="pay_id"><option selected>--Seleccionar Pago--</option><option value="Conductor"' +
                        (logistico[i].employee_type === "Conductor" ? " selected" : "") +
                        '>Conductor</option><option value="Cajero"' +
                        (logistico[i].employee_type === "Cajero" ? " selected" : "") +
                        '>Cajero</option><option value="Cocinero"' +
                        (logistico[i].employee_type === "Cocinero" ? " selected" : "") +
                        '>Cocinero</option><option value="Otro"' +
                        (logistico[i].employee_type === "Otro" ? " selected" : "") +
                        '>Otro</option></select></td>';
                    html +=
                        '<td><input type="text" name="logistico[' +
                        counter +
                        '][vehicle_license_plate]" class="form-control item_name" value="' +
                        logistico[i].vehicle_license_plate +
                        '" /></td>';
                    html +=
                        '<td><a type="button" name="remove" class="btn btn-danger btn-xs remove"><i class="fas fa-trash"></i></a></td>';
                    $("#tbody").append(html);
                    counter++;
                }
            }
            // Verificar si hay información en "electrico" y prellenar las filas
            var electrico = JSON.parse('<?php echo addslashes($company->electrico); ?>'); // Asegúrate de que $electrico contenga el valor JSON en PHP
            if (electrico && electrico.length > 0) {
                for (var i = 0; i < electrico.length; i++) {
                    var html = "";
                    html += "<tr>";
                    html +=
                        '<td><input type="text" name="electrico[' +
                        counter2 +
                        '][elements]" class="form-control item_name" value="' +
                        electrico[i].elements +
                        '" /></td>';
                    html +=
                        '<td><input type="text" name="electrico[' +
                        counter2 +
                        '][count]" class="form-control item_name" value="' +
                        electrico[i].count +
                        '" /></td>';
                    html +=
                        '<td><input type="text" name="electrico[' +
                        counter2 +
                        '][vatios]" class="form-control item_name" value="' +
                        electrico[i].vatios +
                        '" /></td>';
                    html +=
                        '<td><input type="text" name="electrico[' +
                        counter2 +
                        '][amperios]" class="form-control item_name" value="' +
                        electrico[i].amperios +
                        '" /></td>';
                    html +=
                        '<td><input type="text" name="electrico[' +
                        counter2 +
                        '][110]" class="form-control item_name" value="' +
                        electrico[i]["110"] +
                        '" /></td>';
                    html +=
                        '<td><input type="text" name="electrico[' +
                        counter2 +
                        '][220]" class="form-control item_name" value="' +
                        electrico[i]["220"] +
                        '" /></td>';
                    html +=
                        '<td><select class="custom-select form-control-border" name="electrico[' +
                        counter2 +
                        '][tri]" id="pay_id"><option selected>--Seleccionar Pago--</option><option value="Si"' +
                        (electrico[i].tri === "Si" ? " selected" : "") +
                        '>Si</option><option value="No"' +
                        (electrico[i].tri === "No" ? " selected" : "") +
                        '>No</option></select></td>';
                    html +=
                        '<td><a type="button" name="remove_elect" class="btn btn-danger btn-xs remove_elect"><i class="fas fa-trash"></i></a></td>';
                    $("#tbody_elect").append(html);
                    counter2++;
                }
            }
            // Verificar si hay información en "array_medios_pago" y prellenar las filas
            var arrayMediosPago = JSON.parse('<?php echo addslashes($company->array_medios_pago); ?>'); // Asegúrate de que $array_medios_pago contenga el valor JSON en PHP
            if (arrayMediosPago && arrayMediosPago.length > 0) {
                for (var i = 0; i < arrayMediosPago.length; i++) {
                    var html = "";
                    html += "<tr>";
                    html +=
                        '<td><input type="text" name="array_medios_pago[' +
                        counter3 +
                        '][elements]" class="form-control item_name" value="' +
                        arrayMediosPago[i].elements +
                        '" /></td>';
                    html +=
                        '<td><a type="button" name="remove_pago" class="btn btn-danger btn-xs remove_pago"><i class="fas fa-trash"></i></a></td>';
                    $("#tbody_pago").append(html);
                    counter3++;
                }
            }

        });

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
            html +=
                '<td><input type="text" name="logistico[' +
                counter +
                '][names]" class="form-control item_name" /></td>';
            html +=
                '<td><input type="text" name="logistico[' +
                counter +
                '][identification_number]" class="form-control item_name" /></td>';
            html +=
                '<td><select class="custom-select form-control-border" name="logistico[' +
                counter +
                '][employee_type]" id="pay_id"><option selected>--Seleccionar Pago--</option><option value="Conductor">Conductor</option><option value="Cajero">Cajero</option><option value="Cocinero">Cocinero</option><option value="Otro">Otro</option></select></td>';
            html +=
                '<td><input type="text" name="logistico[' +
                counter +
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
            counter3++;
        });

        $(document).on("click", ".remove_pago", function() {
            $(this).closest("tr").remove();
        });
    </script>
@endsection
