@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Contabilidad</div>

                <div class="panel-body">
                    <div class="col-md-6">
                        <table id="accounting_table" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>FECHA</th>
                                <th>ACCION</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dates as $date)
                                <tr>
                                    <td>{{$date['date']}}</td>
                                    <td><button type="button" class="btn btn-warning"><i class="glyphicon glyphicon-th-list"></i></button></td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>FECHA</th>
                                <th>ACCION</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('after_scripts')
    <script>
        $(document).ready(function () {
            $('#accounting_table').DataTable({
                "language": {
                    "url": "/datatable/language/spanish.json"
                },
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ],
                "columns": [
                    {"width": "80%"},
                    {"width": "20%"}
                ],
                "scrollY": "350px",
                "scrollCollapse": true,
                "paging": false,
                "info": false,
                "bSort": false
            });

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
