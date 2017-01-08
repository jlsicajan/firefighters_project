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
                                <th>Paciente aporte  /  telefono</th>
                                <th>Caso / Observaciones</th>
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
                                <th>Paciente aporte  /  telefono</th>
                                <th>Caso / Observaciones</th>
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
                                    <td>Q. {{ number_format($unity_data->patient_input , 2) }}  /  {{ $unity_data->patient_phone }}</td>
                                    <td>{{ $unity_data->patient_case }} / <p style="color: green">{{ $unity_data->observations }}</p></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Reporte de control general</div>

                    <div class="panel-body">
                        <form class="form-inline" method="get" action="{{ action('GeneralController@pdf') }}">
                            <div class="form-group">
                                <label for="date_from">DESDE:</label>
                                <input type="text" class="form-control" name="date_from" id="date_from" placeholder="d-m-Y" required/>
                            </div>
                            <div class="form-group">
                                <label for="date_to">HASTA:</label>
                                <input type="text" class="form-control" name="date_to" id="date_to" placeholder="d-m-Y" required/>
                            </div>
                            <div class="form-group">
                                <label for="unity">UNIDAD:</label>
                                <select class="form-control" id="unity" name="unity">
                                    <option value="all" selected>-- TODAS LAS UNIDADES --</option>
                                    @foreach($unities as $unity)
                                        <option value="{{ $unity->code }}">{{ $unity->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger">Generar PDF</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('after_scripts')
    <script>
        $("#date_from").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#date_to").datepicker({ dateFormat: 'dd-mm-yy' });

        $(document).ready(function () {
            $('#unity').DataTable({
                "language": {
                    "url": "/datatable/language/spanish.json"
                },
                "scrollY": "500px",
            });
        });
    </script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"/>
@endsection
