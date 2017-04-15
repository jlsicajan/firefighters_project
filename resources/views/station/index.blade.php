@extends('layouts.app')
@section('after-styles')
    <style>
        .btn-bs-file{
            position:relative;
        }
        .btn-bs-file input[type="file"]{
            position: absolute;
            top: -9999999;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            cursor: inherit;
        }
    </style>
    <link href="/fileinput/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Gastos de la estacion</div>

                    <div class="panel-body">
                        <meta name="csrf-token" content="{{ csrf_token() }}"/>
                        <form action="#" autocomplete="off" method="POST" id="form_station">
                            <div class="form-group">
                                <label for="date">Fecha</label>
                                <input type="text" class="form-control" name="date" id="date" required value="{{ $date_today }}" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="bill_number">Numero de la factura</label>
                                <input type="number" class="form-control" name="bill_number" id="bill_number"/>
                            </div>
                            <div class="form-group">
                                <label for="station_spend">Ingrese la cantidad que gasto</label>
                                <input type="number" step="any"  class="form-control" name="station_spend" id="station_spend"
                                       required/>
                            </div>
                            <div class="form-group">
                                <label for="station_description">Descripcion en que lo gasto (Q)</label>
                                <textarea class="form-control" id="station_description" name="station_description"
                                          required rows="3"></textarea>
                            </div>
                            {{--<div class="form-group">Tome una fotografia--}}
                                {{--<input id="img_station_spend" name="img_station_spend" class="file" type="file">--}}
                            {{--</div>--}}
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal loading -->
    @include('units.modal_loading.loading')
@endsection
@section('after_scripts')    
    <script src="/fileinput/fileinput.js" type="text/javascript"></script>
    <script src="/fileinput/locales/es.js" type="text/javascript"></script>
    <script>
        $("#img_station_spend").fileinput({
            dropZoneEnabled: false,
            overwriteInitial: false,
            maxFileSize: 20000,
            maxFilesNum: 1,
            showUpload: false,
            showCaption: false,
            fileType: "any",
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
            initialPreviewAsData: true,
            allowedFileExtensions : ['jpg', 'png', 'jpeg'],
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            }
        });
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#form_station').on('submit', function (e) {
            var data_to_send = new FormData();
            var files = $('#img_station_spend').fileinput('getFileStack');
            $("#modal_loading").modal({show: true});

            data_to_send.append('photo', files[0]);
            data_to_send.append('date', $('input#date').val());
            data_to_send.append('bill_number', $('input#bill_number').val());
            data_to_send.append('station_spend', $('input#station_spend').val());
            data_to_send.append('description', $('textarea#station_description').val());

            $.ajax({
                type: "POST",
                cache: false,
                processData: false,
                contentType: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: '{{ URL::route('save.station') }}',
                data: data_to_send,
                success: function (data) {
                    alert(data);
                    $('#form_station').trigger("reset");
                    $("#modal_loading").modal("hide");
                }
            });
            return false;
        });
    </script>
@endsection
