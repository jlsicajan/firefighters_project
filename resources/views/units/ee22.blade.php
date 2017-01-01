@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">UNIDAD EE-22</div>

                    <div class="panel-body">
                        <div class="text-center">
                            <img src="/images/unitys/ee22.jpeg" style="height: 250px; width: 350px">
                        </div>
                        <hr>
                        <ul class="nav nav-tabs">
                            <li><a data-toggle="tab" href="#enfermedadcomun">Enfermedad comun</a></li>
                            <li><a data-toggle="tab" href="#accidente">Accidente</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="enfermedadcomun" class="tab-pane fade in active">
                                <h3>Ingrese los datos para enfermedad comun</h3>
                                @include('units.layouts.basic_form', ['unity_set' => 'EE22', 'general_case' => 'Enfermedad comun'])
                            </div>
                            <div id="accidente" class="tab-pane fade">
                                <h3>Ingrese los datos para accidente</h3>
                                @include('units.layouts.basic_form_accident', ['unity_set' => 'EE22', 'general_case' => 'Accidente'])
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
        var now = new Date();

        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);

        var today = now.getFullYear() + "-" + month + "-" + day;
        if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
            today = day + "/" + month + "/" + now.getFullYear();
        }
        $('.date').val(today);
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $('.form_basic').trigger("reset");
            $('.date').val(today);
        });
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('.form_basic').on('submit', function (e) {
            $.ajax({
                type: "POST",
                url: '{{ URL::route('unidad.save') }}',
                data: {
                    date: $('input#date').val(),
                    timeout: $('input#timeout').val(),
                    timein: $('input#timein').val(),
                    kmout: $('input#kmout').val(),
                    kmin: $('input#kmin').val(),
                    patient_name: $('input#patient_name').val(),
                    patient_responsible: $('input#patient_responsible').val(),
                    patient_age: $('input#patient_age').val(),
                    patient_case: $('textarea#patient_case').val(),
                    patient_address: $('input#patient_address').val(),
                    patient_address_from: $('input#patient_address_from').val(),
                    patient_destiny: $('input#patient_destiny').val(),
                    patient_phone: $('input#patient_phone').val(),
                    patient_input: $('input#patient_input').val(),
                    asistant_id: $('select#asistant').val(),
                    pilot_id: $('select#pilot').val(),
                    unity_id: $('input#unity_id').val(),
                    general_case: $('input#general_case').val(),
                    _token: CSRF_TOKEN
                },
                success: function (data) {
                    alert(data);
                    $('.form_basic').trigger("reset");
                    $('.date').val(today);
                }
            });
            return false;
        });
        $('.form_basic_accident').on('submit', function (e) {
            $.ajax({
                type: "POST",
                url: '{{ URL::route('unidad.save') }}',
                data: {
                    date: $('input#date_a').val(),
                    timeout: $('input#timeout_a').val(),
                    timein: $('input#timein_a').val(),
                    kmout: $('input#kmout_a').val(),
                    kmin: $('input#kmin_a').val(),
                    patient_name: $('input#patient_name_a').val(),
                    patient_responsible: $('input#patient_responsible_a').val(),
                    patient_age: $('input#patient_age_a').val(),
                    patient_case: $('textarea#patient_case_a').val(),
                    patient_address: $('input#patient_address_a').val(),
                    patient_address_from: $('input#patient_address_from_a').val(),
                    patient_destiny: $('input#patient_destiny_a').val(),
                    patient_phone: $('input#patient_phone_a').val(),
                    patient_input: $('input#patient_input_a').val(),
                    asistant_id: $('select#asistant_a').val(),
                    pilot_id: $('select#pilot_a').val(),
                    unity_id: $('input#unity_id_a').val(),
                    general_case: $('input#general_case_a').val(),
                    _token: CSRF_TOKEN
                },
                success: function (data) {
                    alert(data);
                    $('.form_basic_accident').trigger("reset");
                    $('.date').val(today);
                }
            });
            return false;
        });
    </script>
@endsection
