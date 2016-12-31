@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Control general</div>

                    <div class="panel-body">
                        <table id="unity" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Unidad</th>
                                <th>Nombre paciente</th>
                                <th>Piloto</th>
                                <th>Asistente</th>
                                <th>Oficial que reporta</th>
                                <th>Paciente aporte</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Fecha</th>
                                <th>Unidad</th>
                                <th>Nombre paciente</th>
                                <th>Piloto</th>
                                <th>Asistente</th>
                                <th>Oficial que reporta</th>
                                <th>Paciente aporte</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach(json_decode($unity_datas) as $unity_data)
                                <tr>
                                    <td>{{ $unity_data->date }}</td>
                                    <td>{{  App\Unity::getNameById($unity_data->unity_id) }}</td>
                                    <td>{{ $unity_data->patient_name }}</td>
                                    <td>{{  App\User::getNameById($unity_data->pilot_id) }}</td>
                                    <td>{{  App\User::getNameById($unity_data->asistant_id) }}</td>
                                    <td>{{  App\User::getNameById($unity_data->user_id) }}</td>
                                    <td>Q {{ $unity_data->patient_input }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('after_scripts')
    <script>
    </script>
@endsection
