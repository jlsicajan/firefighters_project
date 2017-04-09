<script>
    $('.form_basic_water').on('submit', function (e) {
        $("#modal_loading").modal({show: true});
        $.ajax({
            type: "POST",
            url: '{{ URL::route('unidad.save') }}',
            data: {
                date: $('input#date_water').val(),
                timeout: $('input#timeout_water').val(),
                timein: $('input#timein_water').val(),
                kmout: $('input#kmout_water').val(),
                kmin: $('input#kmin_water').val(),
                patient_phone: $('input#patient_phone_water').val(),
                patient_input: $('input#patient_input_water').val(),
                asistant_id: $('select#asistant_water').val(),
                pilot_id: $('select#pilot_water').val(),
                unity_id: $('input#unity_id_water').val(),
                general_case: $('input#general_case_water').val(),
                asistant_id_two: $('select#asistant_id_two_water').val(),
                observations: $('textarea#observations_water').val(),
                service_type: $('input#service_type').val(),

                water_destiny: $('input#water_destiny').val(),
                water_spend: $('input#water_spend').val(),
                fill_unity: $('input#fill_unity').val(),
                spend_aport: $('input#spend_aport').val(),
                fill_spend: $('input#fill_spend').val(),

                is_water: true,
                _token: CSRF_TOKEN
            },
            success: function (data) {
                $("#modal_loading").modal("hide");
                alert(data['message']);
                $('.form_basic_water').trigger("reset");
                $('input#kmout_water').val(data['kmall']);
                km_out = data['kmall'];
            }
        });
        return false;
    });
</script>