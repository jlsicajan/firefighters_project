<script>
    $('.form_basic_accident').on('submit', function (e) {
        $("#modal_loading").modal({show: true});
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
                asistant_id_two: $('select#asistant_id_two_a').val(),
                observations: $('textarea#observations_a').val(),
                _token: CSRF_TOKEN
            },
            success: function (data) {
                $("#modal_loading").modal("hide");
                alert(data['message']);
                $('.form_basic_accident').trigger("reset");
                $('input#kmout_a').val(data['kmall']);
                km_out = data['kmall'];
            }
        });
        return false;
    });
</script>