<script>
    $('.form_basic_accident').on('submit', function (e) {
        $("#modal_loading").modal({show: true});
        var data_to_send = new FormData();

        data_to_send.append('date', $('input#date_a').val());
        data_to_send.append('timeout', $('input#timeout_a').val());
        data_to_send.append('timein', $('input#timein_a').val());
        data_to_send.append('kmout', $('input#kmout_a').val());
        data_to_send.append('kmin', $('input#kmin_a').val());
        data_to_send.append('patient_name', $('input#patient_name_a').val());
        data_to_send.append('patient_responsible', $('input#patient_responsible_a').val());
        data_to_send.append('patient_age', $('input#patient_age_a').val());
        data_to_send.append('patient_case', $('textarea#patient_case_a').val());
        data_to_send.append('patient_address', $('input#patient_address_a').val());
        data_to_send.append('patient_address_from', $('input#patient_address_from_a').val());
        data_to_send.append('patient_destiny', $('input#patient_destiny_a').val());
        data_to_send.append('patient_phone', $('input#patient_phone_a').val());
        data_to_send.append('patient_input', $('input#patient_input_a').val());
        data_to_send.append('asistant_id', $('select#asistant_a').val());
        data_to_send.append('pilot_id', $('select#pilot_a').val());
        data_to_send.append('unity_id', $('input#unity_id_a').val());
        data_to_send.append('general_case', $('input#general_case_a').val());
        data_to_send.append('asistant_id_two', $('select#asistant_id_two_a').val());
        data_to_send.append('observations', $('textarea#observations_a').val());

        $.ajax({
            type: "POST",
            cache: false,
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '{{ URL::route('unidad.save') }}',
            data: data_to_send,
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