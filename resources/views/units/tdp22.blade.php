@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">UNIDAD TDP-22</div>

                    <div class="panel-body">
                        <div class="text-center">
                            <img class="img-responsive" src="/images/unitys/tdp22.jpeg" style="margin: 0 auto; height: 250px; width: 350px">
                        </div>
                        <hr>
                        <ul class="nav nav-tabs">
                            {{--<li><a data-toggle="tab" href="#enfermedadcomun">Enfermedad comun</a></li>--}}
                            <li><a data-toggle="tab" href="#accidente">Accidente</a></li>
                            <li><a data-toggle="tab" href="#social">Servicio social</a></li>
                            <li><a data-toggle="tab" href="#water">Servicio de agua</a></li>
                        </ul>
                        <div class="tab-content">
                            {{--<div id="enfermedadcomun" class="tab-pane fade in active">--}}
                                {{--<h3>Ingrese los datos para enfermedad comun</h3>--}}
                                {{--@include('units.layouts.basic_form', ['unity_set' => 'TDP22', 'general_case' => 'Enfermedad comun'])--}}
                            {{--</div>--}}
                            <div id="accidente" class="tab-pane fade">
                                <h3>Ingrese los datos para accidente</h3>
                                @include('units.layouts.basic_form_accident', ['unity_set' => 'TDP22', 'general_case' => 'Accidente'])
                            </div>
                            <div id="social" class="tab-pane fade">
                                <h3>Ingrese los datos para servicio social</h3>
                                @include('units.layouts.basic_form_social', ['unity_set' => 'TDP22', 'general_case' => 'Servicio social'])
                            </div>
                            <div id="water" class="tab-pane fade in active">
                                <h3>Ingrese los datos para servicio de agua</h3>
                                @include('units.layouts.basic_form_water', ['unity_set' => 'TDP22', 'general_case' => 'Servicio de agua'])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('units.modal_loading.loading')
@endsection
@section('after_scripts')
    <script>
        var km_out = {{ $kmin_all }}
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $('.form_basic_accident').trigger("reset");
            $('.form_basic_service').trigger("reset");
            $('.form_basic_water').trigger("reset");
            $('.kmout').val(km_out);
        });
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    </script>
    @include('units.scripts.acc_form')
    @include('units.scripts.service_form')
    @include('units.scripts.water_form')
@endsection
