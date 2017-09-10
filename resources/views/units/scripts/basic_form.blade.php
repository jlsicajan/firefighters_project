<script>
    $('.form_basic').on('submit', function (e) {
        show_spinner_loading()
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
                asistant_id_two: $('select#asistant_id_two').val(),
                observations: $('textarea#observations').val(),
                _token: CSRF_TOKEN
            },
            success: function (data) {
                setTimeout(function(){
                    hide_spinner_loading();
                    alert(data['message']);
                }, 2000);
                $('.form_basic').trigger("reset");
                $('.kmout').val(data['kmall']);
                km_out = data['kmall'];
            }
        });
        return false;
    });
</script>