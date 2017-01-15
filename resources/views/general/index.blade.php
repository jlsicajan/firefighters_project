@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="panel panel-default panel-transparent">
            <div class="panel-heading">
                <form class="form-inline" method="get" action="{{ action('GeneralController@pdf') }}">
                    <div class="form-group input-append date form_datetime">
                        <label for="date_from" class="white_word">CONTROL GENERAL DE UNIDADES DESDE: </label>
                        <input size="20" type="text" class="form-control" name="date_from" id="date_from"
                               placeholder="d/m/Y h"
                               required readonly/>
                    </div>
                    <div class="form-group input-append date form_datetime">
                        <label for="date_to" class="white_word">HASTA:</label>
                        <input size="20" type="text" class="form-control" name="date_to" id="date_to"
                               placeholder="d/m/Y h"
                               required readonly/>
                        <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                    <div class="form-group">
                        <label for="unity" class="white_word">UNIDAD:</label>
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

            <div class="panel-body">
                <hr>
                <table id="unity_table" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="white_word">Fecha</th>
                        <th class="white_word">Unidad</th>
                        <th class="white_word">Nombre paciente</th>
                        <th class="white_word">Piloto</th>
                        <th class="white_word">Asistente</th>
                        <th class="white_word">Oficial que reporta</th>
                        <th class="white_word">Paciente aporte / telefono</th>
                        <th class="white_word">Caso / Observaciones</th>
                        <th class="white_word">Km salida</th>
                        <th class="white_word">Km entrada</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th class="white_word">Fecha</th>
                        <th class="white_word">Unidad</th>
                        <th class="white_word">Nombre paciente</th>
                        <th class="white_word">Piloto</th>
                        <th class="white_word">Asistente</th>
                        <th class="white_word">Oficial que reporta</th>
                        <th class="white_word">Paciente aporte / telefono</th>
                        <th class="white_word">Caso / Observaciones</th>
                        <th class="white_word">Km salida / Km entrada</th>
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
                            <td>Q. {{ number_format($unity_data->patient_input , 2) }}
                                / {{ $unity_data->patient_phone }}</td>
                            <td>{{ $unity_data->patient_case }} / <p
                                        style="color: green">{{ $unity_data->observations }}</p></td>
                            <td><strong>{{ $unity_data->kmout }}</strong></td>
                            <td><strong>{{ $unity_data->kmin }}</strong></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('after_scripts')
    <script>
        $('#date_from, #date_to').datetimepicker({
            language: 'es',
            format: 'dd/mm/yyyy HH:ii p',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1
        });
        $(document).ready(function () {
            $('#unity_table').DataTable({
                "language": {
                    "url": "/datatable/language/spanish.json"
                },
                "scrollY": "500px",
            });
        });
    </script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"/>
@endsection
