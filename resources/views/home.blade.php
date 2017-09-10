@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">Bienvenido al sistema {{ Auth::user()->name }}</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <hr>
                            <h5>Contabilidad</h5>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection

@section('after_scripts')
<script type="text/javascript">
    $(document).ready(function(){

        //en este branch, ahora tenemos que obtener los usuarios para mostrarlos en el home, la idea es trabajar la parte de los usuarios (roles)
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
