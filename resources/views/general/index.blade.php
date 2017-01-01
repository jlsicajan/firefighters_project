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
                                <th>Paciente aporte / telefono</th>
                                <th>Caso</th>
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
                                <th>Paciente aporte / telefono</th>
                                <th>Caso</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach(json_decode($unity_datas) as $unity_data)
                                <tr>
                                    <td>{{ $unity_data->date }}</td>
                                    <td>{{  App\Unity::getNameById($unity_data->unity_id) }}</td>
                                    <td>{{ $unity_data->patient_name }}</td>
                                    <td>{{  App\User::getNameById($unity_data->pilot_id) }}</td>
                                    @if(App\User::getNameById($unity_data->asistant_id) != '')
                                        <td>{{  App\User::getNameById($unity_data->asistant_id) }}</td>
                                    @else
                                        <td>NINGUN ASISTENTE</td>
                                    @endif
                                <td>{{  App\User::getNameById($unity_data->user_id) }}</td>
                                <td>Q {{ $unity_data->patient_input }}/{{ $unity_data->patient_phone }}</td>
                                <td>{{ $unity_data->patient_case }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row text-center">
                            <a type="button" class="btn btn-danger" href="{{ url('pdf/general') }}">Generar PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('after_scripts')
    <script>
        $(document).ready(function () {
            $('#unity').DataTable({
                "language": {
                    "url": "/datatable/language/spanish.json"
                }
            });
        });
    </script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"/>
@endsection
