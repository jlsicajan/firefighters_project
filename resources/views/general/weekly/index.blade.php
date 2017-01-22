@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Reporte semanal</div>

                <div class="panel-body">
                    <div class="col-xs-6">
                        <br><br>
                        <meta name="csrf-token" content="{{ csrf_token() }}"/>
                        <form action="#" autocomplete="off" method="POST" id="form_weekly_report">
                            <div class="form-group input-append date form_datetime">
                                <label for="date_from" class="white_word">DESDE: </label>
                                <input size="20" type="text" class="form-control" name="date_from" id="date_from"
                                       placeholder="d/m/Y h:m"
                                       required/>
                            </div>
                            <div class="form-group input-append date form_datetime">
                                <label for="date_to" class="white_word">HASTA:</label>
                                <input size="20" type="text" class="form-control" name="date_to" id="date_to"
                                       placeholder="d/m/Y h:m"
                                       required/>
                                <span class="add-on"><i class="icon-th"></i></span>
                            </div>
                            <div class="form-group">
                                <label for="gas_spend">REINTEGRO</label>
                                <input type="number" step="any" class="form-control" name="reintegrate" id="reintegrate"
                                       required value="0.00"/>
                            </div>
                            <div class="form-group">
                                <label for="gas_spend">GANANCIA</label>
                                <input type="number" step="any" class="form-control" name="gain" id="gain"
                                       required value="0.00"/>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Guardar"/>
                        </form>
                    </div>
                    <div class="col-xs-6">
                        <table id="weekly_table" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="white_word">Desde</th>
                                <th class="white_word">Hasta</th>
                                <th class="white_word">Reintegro</th>
                                <th class="white_word">Ganancia</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th class="white_word">TOTAL</th>
                                <th class="white_word"></th>
                                <th class="white_word" id="reintegrate_sum">{{ $reintegrate_sum }}</th>
                                <th class="white_word" id="gain_sum">{{ $gain_sum }}</th>
                            </tr>
                            </tfoot>
                            <tbody>
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
            format: 'dd/mm/yyyy HH:ii:00 p',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1
        });
        $(document).ready(function () {
            var table = $('#weekly_table').DataTable({
                "ajax": '{{ URL::route('weekly.data.ajax') }}',
                "columns": [
                    {"width": "40%"},
                    {"width": "40%"},
                    {"width": "20%"},
                    {"width": "20%"},
                ],
                "language": {
                    "url": "/datatable/language/spanish.json"
                },
                "scrollY": "350px",
                "scrollCollapse": true,
                "paging": false,
                "info": false,
            });
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $('#form_weekly_report').on('submit', function (e) {
                $.ajax({
                    type: "POST",
                    url: '{{ URL::route('save.weekly.data') }}',
                    data: {
                        date_from: $('input#date_from').val(),
                        date_to: $('input#date_to').val(),
                        reintegrate: $('input#reintegrate').val(),
                        gain: $('input#gain').val(),
                        _token: CSRF_TOKEN
                    },
                    success: function (data) {
                        alert(data['message']);
                        $('#form_weekly_report').trigger("reset");
                        table.ajax.reload(null, false);
                        $('#reintegrate_sum').text(data['reintegrate_sum']);
                        $('#gain_sum').text(data['gain_sum']);
                    }
                });
                return false;
            });
        });
    </script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"/>
@endsection
