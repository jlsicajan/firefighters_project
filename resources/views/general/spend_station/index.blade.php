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
                                    <td>{{ $station_data->date }}</td>
                                    <td>{{  App\User::getNameById($station_data->user_id) }}</td>
                                    <td>{{ $station_data->bill_number }}</td>
                                    <td>Q. {{ number_format($station_data->station_spend, 2) }}</td>
                                    <td>{{ $station_data->description }}</td>
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
                    <div class="panel-heading">Reporte de gastos de la estacion</div>

                    <div class="panel-body">
                        <form class="form-inline" method="get" action="{{ action('GeneralSpendStationController@pdf') }}">
                            <div class="form-group">
                                <label for="date_from">DESDE:</label>
                                <input type="text" class="form-control" name="date_from" id="date_from" placeholder="d/m/Y"/>
                            </div>
                            <div class="form-group">
                                <label for="date_to">HASTA:</label>
                                <input type="text" class="form-control" name="date_to" id="date_to" placeholder="d/m/Y"/>
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
            $('#station_datas').DataTable({
                "language": {
                    "url": "/datatable/language/spanish.json"
                }
            });
        });
    </script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"/>
@endsection
