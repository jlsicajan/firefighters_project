@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Control general de los gastos de la estacion</div>

                    <div class="panel-body">
                        <table id="station_datas" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Oficial que reporta</th>
                                <th>Numero de factura</th>
                                <th>Gastado</th>
                                <th>Observaciones</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Fecha</th>
                                <th>Oficial que reporta</th>
                                <th>Numero de factura</th>
                                <th>Gastado</th>
                                <th>Observaciones</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach(json_decode($station_datas) as $station_data)
                                <tr>
                                    <td>{{ $station_data->created_at }}</td>
                                    <td>{{  App\User::getNameById($station_data->user_id) }}</td>
                                    <td>{{ $station_data->bill_number }}</td>
                                    <td>{{ $station_data->station_spend }}</td>
                                    <td>{{ $station_data->description }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="row text-center">--}}
            {{--<div class="col-md-12">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">Reporte de gastos en combustible</div>--}}

                    {{--<div class="panel-body">--}}
                        {{--<form class="form-inline" method="get" action="{{ action('GeneralController@pdf') }}">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="date_from">DESDE:</label>--}}
                                {{--<input type="date" class="form-control" name="date_from" id="date_from" placeholder="d/m/Y"/>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="date_to">HASTA:</label>--}}
                                {{--<input type="date" class="form-control" name="date_to" id="date_to" placeholder="d/m/Y"/>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="year">AÑO:</label>--}}
                                {{--<select class="form-control" id="year" name="year">--}}
                                    {{--<option value="2017">2017</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="unity">UNIDAD:</label>--}}
                                {{--<select class="form-control" id="unity" name="unity">--}}
                                    {{--<option value="all" selected>-- TODAS LAS UNIDADES --</option>--}}
                                    {{--@foreach($unities as $unity)--}}
                                        {{--<option value="{{ $unity->code }}">{{ $unity->name }}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<button type="submit" class="btn btn-danger">Generar PDF</button>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
@endsection
@section('after_scripts')
    <script>
        var now = new Date();

        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);

        var today = now.getFullYear() + "-" + month + "-" + day;
        if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
            today = day + "/" + month + "/" + now.getFullYear();
        }
        $('#date_from').val(today);
        $('#date_to').val(today);
        $(document).ready(function () {
            $('#station_datas').DataTable({
                "language": {
                    "url": "/datatable/language/spanish.json"
                }
            });
        });
    </script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"/>
@endsection
