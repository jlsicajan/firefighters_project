@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Inventario de recaudaciones</div>

                    <div class="panel-body">
                        <meta name="csrf-token" content="{{ csrf_token() }}"/>
                        <form action="#" autocomplete="off" method="POST" id="form_collections">
                            <div class="form-group">
                                <label for="date">Fecha</label>
                                <input type="text" class="form-control" name="date" id="date" required value="{{ $date_today }}" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Cuanto se recaudo (Q)</label>
                                <input type="number" class="form-control" name="quantity" id="quantity" required/>
                            </div>
                            <div class="form-group">Breve desripcion</label>
                                <textarea class="form-control" id="station_description" name="station_description"
                                          required rows="8"></textarea>
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

        $('#form_collections').on('submit', function (e) {
            $.ajax({
                type: "POST",
                url: '{{ URL::route('save.collections') }}',
                data: {
                    date: $('input#date').val(),
                    quantity: $('input#quantity').val(),
                    description: $('textarea#station_description').val(),
                    _token: CSRF_TOKEN
                },
                success: function (data) {
                    alert(data);
                    $('#form_collections').trigger("reset");
                    $('#date').val(today);
                }
            });
            return false;
        });
    </script>
@endsection
