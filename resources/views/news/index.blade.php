@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Libro de novedades</div>

                    <div class="panel-body">
                        <meta name="csrf-token" content="{{ csrf_token() }}"/>
                        <form action="#" autocomplete="off" method="POST" id="form_news">
                            <div class="form-group">
                                <label for="date">Fecha</label>
                                <input type="date" class="form-control" name="date" id="date" required/>
                            </div>
                            <div class="form-group">
                                <label for="news_day">Novedades del dia</label>
                                <textarea class="form-control" id="news_day" name="news_day"
                                          required rows="25"></textarea>
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
        $('#form_news').on('submit', function (e) {
            $.ajax({
                type: "POST",
                url: '{{ URL::route('save.news') }}',
                data: {
                    date: $('input#date').val(),
                    news_day: $('textarea#news_day').val(),
                    _token: CSRF_TOKEN
                },
                success: function (data) {
                    alert(data);
                    $('#form_news').trigger("reset");
                }
            });
            return false;
        });
    </script>
@endsection
