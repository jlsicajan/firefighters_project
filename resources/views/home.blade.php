@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 row">
                <div class="col-md-12">
                    <h3 class="text-center"><strong>Bienvenido al sistema de la estacion 22</strong></h3>
                </div>

                <div class="col-md-3">
                    <table class="table table-bordered bg-white">
                        <thead>
                        <tr class="text-center">
                            <th>Datos Usuario</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <strong>Usuario:</strong> {{ Auth::user()->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Numero de casco usuario: </strong> {{ $casc_number }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Email:</strong> {{ $email }}
                            </td>
                        </tr>
                        </tbody>

                    </table>
                </div>

                <div class="col-md-3">
                    <table class="table table-bordered bg-white">
                        <thead>
                        <tr class="text-center">
                            <th>Total de datos ingresados</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center"><h1>32</h1></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="panel panel-success">
                <div class="panel-body row">
                    <div class="col-md-12">
                        <hr>
                        <h5>Listado de usuarios</h5>
                        <table id="users_table" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Nombre de usuario</th>
                                <th>Numero</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            //en este branch, ahora tenemos que obtener los usuarios para mostrarlos en el home, la idea es trabajar la parte de los usuarios (roles)
            // y que pueda editar el rol de los usuarios, que no pueda editar su usario, una funcion de activo/inactivo
            //numero de casco
            //
            var table = $('#users_table').DataTable({
                "ajax": '{{ URL::route('users.data.ajax') }}',
                "columns": [
                    {"width": "25%"},
                    {"width": "25%"},
                    {"width": "25%"},
                    {"width": "25%"},
                ],
                "language": {
                    "url": "/datatable/language/spanish.json"
                },
                "scrollY": "350px",
                "scrollCollapse": true,
                "paging": false,
                "info": false,
            });
        });
    </script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"/>
@endsection
