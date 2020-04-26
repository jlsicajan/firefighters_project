@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <h5><strong>CONTROL GENERAL DE UNIDADES</strong></h5>
        <div class="panel panel-default panel-transparent">
            <div class="panel-heading">
                <form class="form-inline" method="get" action="{{ action('Reports\GeneralController@pdf') }}">
                    <div class="form-group input-append date form_datetime">
                        <label for="date_from" class="white_word">DESDE: </label>
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
                        <button type="submit" name="PDF" value="PDF" class="btn btn-danger">Generar PDF</button>
                        {{--<button type="submit" name="XLSX" value="XLSX" class="btn btn-success">Generar EXCEL</button>--}}
                </form>
            </div>

            <div class="panel-body">
                <table id="unity_data_table" class="display table table-bordered" cellspacing="0" width="100%">
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <hr>
        <div id="2020_cases" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <hr>
        <div id="2019_cases" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <hr>
        <div id="2018_cases" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <hr>
        <div id="2017_cases" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <hr>
    </div>
    <br>
@endsection
<div class="modal fade" id="unityDetailModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detalle</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@section('after_scripts')
    <script src="/js/highchart/highcharts.js"></script>
    <script src="/js/highchart/exporting.js"></script>
    <script src="/js/highchart/highcharts_dark_theme.js"></script>
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
            var unity_table = $('#unity_data_table').DataTable({
                "processing": true,
                "serverSide": true,
                "bProcessing": true,
                "bServerSide": true,
                "ajax":{
                    "url": "{{ URL::route('general.unity.data.ajax') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{ csrf_token() }}"}
                },
                "columns": [
                    {"width": "10%"},
                    {"width": "10%"},
                    {"width": "10%"},
                    {"width": "10%"},
                    {"width": "10%"},
                    {"width": "10%"},
                    {"width": "10%"},
                    {"width": "10%"},
                    {"width": "10%"},
                    {"width": "10%"},
                ],
                "language": {
                    "url": "/datatable/language/spanish.json"
                },
                "scrollY": "500px",
                "scrollCollapse": true,
                "paging": true,
                "info": true,
                "bSort" : false,
                //fnDrawCallback for autoscroll to top after change pagination datatable xD
                "fnDrawCallback": function (o) {
                    $('html,body').animate({scrollTop: 0}, 500);
                },
            });
            $("#unityDetailModal").on("show.bs.modal", function (e) {
                var id = $(e.relatedTarget).data('id');
                $.get('/unity/data/find/' + id, function (data) {
                    $(".modal-body").html(data);
                });
            });
        });
        Highcharts.setOptions({
            lang: {
                printChart: "Imprimir",
                loading: 'Cargando...',
                exportButtonTitle: "Exportar",
                printButtonTitle: "Imprimir",
                downloadPNG: 'Descargar en imagen PNG',
                downloadJPEG: 'Descargar en imagen JPEG',
                downloadPDF: 'Descargar en documento PDF',
                downloadSVG: 'Descargar en SVG'
            }
        });
        // Apply the theme
        Highcharts.setOptions(Highcharts.theme);

        function main_options_common(year, display_series){
            var year_selected = year.toString();
            return {
                downloadPDF: "Descargar PDF",
                downloadPNG: "Descargar imagen",
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Reporte mensual de casos'
                },
                subtitle: {
                    text: 'Patzun Chimaltenango ' + year_selected
                },
                xAxis: {
                    categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
                },
                yAxis: {
                    title: {
                        text: 'Casos'
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: false
                    }
                },
                series: display_series
            };
        }

        var data_cases = {!! json_encode($char_datas) !!};
        var parsed_data = [];

        for(var year_rows in data_cases){
            parsed_data[year_rows] = [];
            for(var cases_selected in data_cases[year_rows]){
                let data_to_display = [];
                for(data_value in data_cases[year_rows][cases_selected]){
                    data_to_display.push(data_cases[year_rows][cases_selected][data_value]);
                }
                parsed_data[year_rows].push({
                    'name': cases_selected,
                    'data': data_to_display,
                });
            }
        }
        
        for(year_to_chart in parsed_data){
            Highcharts.chart(year_to_chart.toString() + '_cases', main_options_common(year_to_chart, parsed_data[year_to_chart]));
        }

    </script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"/>
@endsection
