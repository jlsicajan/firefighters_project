<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Estacion 22 Patzun Chimaltenango') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="/css/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @yield('after-styles')
</head>
{{--background="{{ url('images/body.jpg') }}"--}}
<body>
<div id="app">
    @if(Auth::check())
        @include('layouts.navbar')
    @endif
    <div class="mt-3">
        @yield('content')
    </div>
</div>

<!-- Scripts -->
<script src="/js/app.js"></script>
<script type="text/javascript" src="/js/bootstrap-datetimepicker/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="/js/bootstrap-datetimepicker/bootstrap-datetimepicker.es.js"
        charset="UTF-8"></script>
@yield('after_scripts')
<script>
    $(".spinner_container").hide();
    $("#name_responsible_div").hide();

    $("#name_responsible_div_a").hide();

    $("#name_responsible_div_service").hide();

    function show_spinner_loading() {
        // show spinner
        $(".spinner_container").show();
        $(".navbar").addClass('blur');
        $(".container").addClass('blur');

    }

    function hide_spinner_loading() {
        // hide spinner
        $(".spinner_container").hide();
        $(".navbar").removeClass('blur');
        $(".container").removeClass('blur');

    }

    $('#patient_name_check').click(function () {
        if ($(this).is(':checked')) {
            $("#name_patient_div").show();

            $("input#patient_responsible").prop('required', false);
            $("input#patient_name").prop('required', true);

            $("#name_responsible_div").hide();
        }
    });
    $('#patient_responsible_check').click(function () {
        if ($(this).is(':checked')) {
            $("#name_responsible_div").show();

            $("input#patient_responsible").prop('required', true);
            $("input#patient_name").prop('required', false);

            $("#name_patient_div").hide();
        }
    });

    $('#patient_name_check_a').click(function () {
        if ($(this).is(':checked')) {
            $("#name_patient_div_a").show();

            $("input#patient_responsible_a").prop('required', false);
            $("input#patient_name_a").prop('required', true);

            $("#name_responsible_div_a").hide();
        }
    });
    $('#patient_responsible_check_a').click(function () {
        if ($(this).is(':checked')) {
            $("#name_responsible_div_a").show();

            $("input#patient_responsible_a").prop('required', true);
            $("input#patient_name_a").prop('required', false);

            $("#name_patient_div_a").hide();
        }
    });

    $('#patient_name_check_service').click(function () {
        if ($(this).is(':checked')) {
            $("#name_patient_div_service").show();

            $("input#patient_responsible_service").prop('required', false);
            $("input#patient_name_service").prop('required', true);

            $("#name_responsible_div_service").hide();
        }
    });
    $('#patient_responsible_check_service').click(function () {
        if ($(this).is(':checked')) {
            $("#name_responsible_div_service").show();

            $("input#patient_responsible_service").prop('required', true);
            $("input#patient_name_service").prop('required', false);

            $("#name_patient_div_service").hide();
        }
    });
</script>
</body>
</html>
