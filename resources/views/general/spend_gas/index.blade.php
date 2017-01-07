@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Control general de los gastos de combustible</div>

                    <div class="panel-body">
                        <table id="gas_spend" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Unidad</th>
                                <th>Oficial que reporta</th>
                                <th>Numero de factura</th>
                                <th>Gasolinera</th>
                                <th>Gastado</th>
                                <th>Observaciones</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Fecha</th>
                                <th>Unidad</th>
                                <th>Oficial que reporta</th>
                                <th>Numero de factura</th>
                                <th>Gasolinera</th>
                                <th>Gastado</th>
                                <th>Observaciones</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach(json_decode($gas_datas) as $gas_data)
                                <tr>
                                    <td>{{ $gas_data->date }}</td>
                                    <td>{{  App\Unity::getNameById($gas_data->unity_id) }}</td>
                                    <td>{{  App\User::getNameById($gas_data->user_id) }}</td>
                                    <td>{{ $gas_data->bill_number }}</td>
                                    <td>{{ $gas_data->gas_name }}</td>
                                    <td>Q. {{ number_format($gas_data->gas_spend, 2) }}</td>
                                    <td>{{ $gas_data->note_gas }}</td>
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
                    <div class="panel-heading">Reporte de gastos en combustible</div>

                    <div class="panel-body">
                        <form class="form-inline" method="get" action="{{ action('GeneralSpendGasController@pdf') }}">
                            <div class="form-group">
                                <label for="date_from">DESDE:</label>
                                <input type="date" class="form-control" name="date_from" id="date_from" placeholder="d/m/Y"/>
                            </div>
                            <div class="form-group">
                                <label for="date_to">HASTA:</label>
                                <input type="date" class="form-control" name="date_to" id="date_to" placeholder="d/m/Y"/>
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
            $('#gas_spend').DataTable({
                "language": {
                    "url": "/datatable/language/spanish.json"
                }
            });
        });
    </script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"/>
@endsection
