@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Libro de novedades</div>

                    <div class="panel-body">
                        <form  autocomplete="off">
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
        //        alert('it works');
        //        $('#patient_phone').hide();
    </script>
@endsection
