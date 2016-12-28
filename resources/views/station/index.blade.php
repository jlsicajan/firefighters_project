@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Gastos de la estacion</div>

                    <div class="panel-body">
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <form action="#" autocomplete="off" method="POST" id="form_station">
                            <div class="form-group">
                                <label for="bill_number">Numero de la factura</label>
                                <input type="number" class="form-control" name="bill_number" id="bill_number"
                                       required/>
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
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#form_station').on('submit', function (e) {
            $.ajax({
                type: "POST",
                url: '{{ URL::route('save.station') }}',
                data: {
                    bill_number: $('input#bill_number').val(),
                    station_spend: $('input#station_spend').val(),
                    description: $('textarea#station_description').val(),
                    _token: CSRF_TOKEN
                },
                success: function (data) {
                    alert(data);
                    $('#form_station').trigger("reset");
                }
            });
            return false;
        });
    </script>
@endsection
