@extends('layouts.app')
@section('title', 'Listar Estados')
@section('content')
    @if(Session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(Session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(Session('edit'))
        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
            {{session('edit')}}
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
                    <h1>Lista de Estado</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Lista de Estado</li>
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
                        <div class="card-header">
                            @can('admin.states.create')
                            <a href="{{route('admin.states.create')}}" title="Crear Estado" class="new-mas"><i class="fas fa-plus"></i></a>
                            @endcan
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-3">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr class="text-center">
                                    <th>Nombre del Estado</th>
                                    <th>Color de Estado</th>
                                    <th>Tipo de Estado</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($states as $state)
                                <tr class="text-center">
                                    <td>{{$state->nombre_estado}}</td>
                                    <td class="d-flex justify-content-center">
                                        <div style="height: 18px; width: 56px; margin-top: 10px; border-radius: 15px; background-color: {{$state->color}}; ">
                                        </div>
                                    </td>
                                    <td>{{$state->typestate->name}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            @can('admin.states.destroy')
                                            <form method="post" action="{{route('admin.states.destroy', $state->id)}}"  class="formEliminarstate">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-company-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                            @endcan
                                            @can('admin.states.edit')
                                            <a title="Editar" href="{{route('admin.states.edit',$state->id)}}"
                                               class="me-2 btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {!! $states->links() !!}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        (function () {
            'use strict'
            //debemos crear la clase formEliminar dentro del form del boton borrar
            //recordar que cada registro a eliminar esta contenido en un form
            var forms = document.querySelectorAll('.formEliminarstate')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        event.preventDefault()
                        event.stopPropagation()
                        Swal.fire({
                            title: '¿Confirma la eliminación del registro?',
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonColor: '#20c997',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Confirmar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                @if(session('error'))

                                Swal.fire('¡Alerta!', '{{session('error')}}','success');

                                @else
                                    this.submit();

                                Swal.fire('¡Eliminado!', 'El registro ha sido eliminado exitosamente.','success');

                                @endif

                            }
                        })
                    }, false)
                })
        })()
    </script>
@endsection
