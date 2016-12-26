@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">UNIDAD AD21</div>

                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li><a data-toggle="tab" href="#enfermedadcomun">Enfermedad comun</a></li>
                            <li><a data-toggle="tab" href="#accidente">Accidente</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="enfermedadcomun" class="tab-pane fade in active">
                                <h3>Ingrese los datos para enfermedad comun</h3>
                                @include('units.layouts.basic_form')
                            </div>
                            <div id="accidente" class="tab-pane fade">
                                <h3>Ingrese los datos para accidente</h3>
                                @include('units.layouts.basic_form')
                            </div>
                        </div>
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
