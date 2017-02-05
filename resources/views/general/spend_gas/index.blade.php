@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <form class="form-inline" method="get" action="{{ action('Reports\GeneralSpendGasController@pdf') }}">
                            <div class="form-group input-append date form_datetime">
                                <label for="date_from" class="white_word">CONTROL GENERAL DE COMBUSTIBLE DESDE: </label>
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
            $('#gas_spend').DataTable({
                "language": {
                    "url": "/datatable/language/spanish.json"
                },
                "scrollY": "400px",
                "bSort" : false,
                //fnDrawCallback for autoscroll to top after change pagination datatable xD
                "fnDrawCallback": function (o) {
                    if ( o._iDisplayStart != oldStart ) {
                        var targetOffset = $('#example').offset().top;
                        $('html,body').animate({scrollTop: targetOffset}, 500);
                    }
                },
            });
        });
    </script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"/>
@endsection
