<script>
    $('.form_basic_service').on('submit', function (e) {
        $("#modal_loading").modal({show: true});
        $.ajax({
            type: "POST",
            url: '{{ URL::route('unidad.save') }}',
            data: {
                date: $('input#date_service').val(),
                timeout: $('input#timeout_service').val(),
                timein: $('input#timein_service').val(),
                kmout: $('input#kmout_service').val(),
                kmin: $('input#kmin_service').val(),
                patient_name: $('input#patient_name_service').val(),
                patient_responsible: $('input#patient_responsible_service').val(),
                patient_age: $('input#patient_age_service').val(),
                patient_case: $('textarea#patient_case_service').val(),
                patient_address: $('input#patient_address_service').val(),
                patient_address_from: $('input#patient_address_from_service').val(),
                patient_destiny: $('input#patient_destiny_service').val(),
                patient_phone: $('input#patient_phone_service').val(),
                patient_input: $('input#patient_input_service').val(),
                asistant_id: $('select#asistant_service').val(),
                pilot_id: $('select#pilot_service').val(),
                unity_id: $('input#unity_id_service').val(),
                general_case: $('input#general_case_service').val(),
                asistant_id_two: $('select#asistant_id_two_service').val(),
                observations: $('textarea#observations_service').val(),
                service_type: $('input#service_type').val(),
                _token: CSRF_TOKEN
            },
            success: function (data) {
                $("#modal_loading").modal("hide");
                alert(data['message']);
                $('.form_basic_service').trigger("reset");
                $('input#kmout_service').val(data['kmall']);
                km_out = data['kmall'];
            }
        });
        return false;
    });
</script>