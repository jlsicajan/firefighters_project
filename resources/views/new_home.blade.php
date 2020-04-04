@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel-heading">
                <h3 class="text-center"><strong>Bienvenido al sistema de la estacion 22</strong></h3>
            </div>

            <div class="col-md-6">
                <table class="table table-bordered bg-primary">
                    <thead>
                        <tr>
                            <th>Datos Usuario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><li><strong>Usuario:</strong> {{ Auth::user()->name }}</li></td>
                        </tr>
                        <tr>
                            <td><li><strong>Numero de casco usuario: </strong> {{ $casc_number }}</li></td>
                        </tr>
                        <tr>
                            <td><li><strong>Email:</strong> {{ $email }}</li></td>
                        </tr>
                    </tbody>

                </table>
            </div>

            <div class="col-md-6">
                <table>
                    <thead>
                        <tr>
                            <th><li><strong>Total de datos ingresados: </strong></li></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
