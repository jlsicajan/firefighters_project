@extends('layouts.app')

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
                                <input type="date" class="form-control" name="date" id="date" required/>
                            </div>
                            <div class="form-group">
                                <label for="bill_number">Numero de la factura</label>
                                <input type="number" class="form-control" name="bill_number" id="bill_number"/>
                            </div>
                            <div class="form-group">
                                <label for="station_spend">Ingrese la cantidad que gasto</label>
                                <input type="number" class="form-control" name="station_spend" id="station_spend"
                                       required/>
                            </div>
                            <div class="form-group">
                                <label for="station_description">Descripcion en que lo gasto (Q)</label>
                                <textarea class="form-control" id="station_description" name="station_description"
                                          required rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
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
        $('#date').val(today);
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#form_station').on('submit', function (e) {
            $.ajax({
                type: "POST",
                url: '{{ URL::route('save.station') }}',
                data: {
                    date: $('input#date').val(),
                    bill_number: $('input#bill_number').val(),
                    station_spend: $('input#station_spend').val(),
                    description: $('textarea#station_description').val(),
                    _token: CSRF_TOKEN
                },
                success: function (data) {
                    alert(data);
                    $('#form_station').trigger("reset");
                    $('#date').val(today);
                }
            });
            return false;
        });
    </script>
@endsection
