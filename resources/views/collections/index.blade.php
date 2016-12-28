@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Inventario de recaudaciones</div>

                    <div class="panel-body">
                        <form  autocomplete="off">
                            <div class="form-group">
                                <label for="date">Fecha</label>
                                <input type="date" class="form-control" name="date" id="date" required/>
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
        //        alert('it works');
        //        $('#patient_phone').hide();
    </script>
@endsection
