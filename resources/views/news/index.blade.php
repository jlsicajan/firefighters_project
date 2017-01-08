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
                                <input type="text" class="form-control" name="date" id="date" required value="{{ $date_today }}" disabled/>
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
