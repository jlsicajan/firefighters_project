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
                    <div class="panel-heading">Gastos de combustible</div>

                    <div class="panel-body">
                        <meta name="csrf-token" content="{{ csrf_token() }}"/>
                        <form action="#" autocomplete="off" method="POST" id="form_gas">
                            <div class="form-group">
                                <label for="date">Fecha</label>
                                <input type="text" class="form-control" name="date" id="date" required value="{{ $date_today }}" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="unity">Unidad</label>
                                <select class="form-control" id="unity" name="unity">
                                    <option value="null" selected disabled>-- Seleccion la unidad --</option>
                                    @foreach($unities as $unity)
                                        <option value="{{ $unity->code }}">{{ $unity->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="bill_number">Numero de la factura</label>
                                <input type="number" class="form-control" name="bill_number" id="bill_number"/>
                            </div>
                            <div class="form-group">
                                <label for="gas_name">Nombre de la gasolinera</label>
                                <input class="form-control" id="gas_name" name="gas_name"
                                       required/>
                            </div>
                            <div class="form-group">
                                <label for="gas_spend">Ingrese la cantidad que gasto (Q)</label>
                                <input type="number" class="form-control" name="gas_spend" id="gas_spend"
                                       required/>
                            </div>
                            <div class="form-group">
                                <label for="note_gas">Nota (no obligatorio)</label>
                                <textarea class="form-control" name="note_gas" id="note_gas" rows="2"></textarea>
                            </div>
                            <div class="form-group">Tome una fotografia
                                <input id="img_gas_spend" name="img_gas_spend" class="file" type="file">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Guardar"/>
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
        $("#img_gas_spend").fileinput({
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
        $('#form_gas').on('submit', function (e) {
            var data_to_send = new FormData();
            var files = $('#img_gas_spend').fileinput('getFileStack');
            $("#modal_loading").modal({show: true});

            data_to_send.append('photo', files[0]);
            data_to_send.append('date', $('input#date').val());
            data_to_send.append('unity', $('select#unity').val());
            data_to_send.append('bill_number', $('input#bill_number').val());
            data_to_send.append('gas_name', $('input#gas_name').val());
            data_to_send.append('gas_spend', $('input#gas_spend').val());
            data_to_send.append('note_gas', $('textarea#note_gas').val());
            $.ajax({
                type: "POST",            
                cache: false,
                processData: false,
                contentType: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: '{{ URL::route('save.gas') }}',
                data: data_to_send,
                success: function (data) {
                    alert(data);
                    $('#form_gas').trigger("reset");
                    $("#modal_loading").modal("hide");
                }
            });
            return false;
        });
    </script>
@endsection
