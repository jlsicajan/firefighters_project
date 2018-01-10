<script>
    $('.form_basic_decease').on('submit', function (e) {
        show_spinner_loading();
        var data_to_send = new FormData();

        var form = $('.form_basic_decease input, .form_basic_decease textarea, .form_basic_decease select');
        form.each(function(item){
            if($(this).attr('name') != 'patient_check'){
                console.dir($(this).attr('name'));
                var column = $(this).attr('name');
                var value = $(this).val();
                data_to_send.append(column, value);
            }
        });

        $.ajax({
            type: "POST",
            cache: false,
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '{{ URL::route('unidad.save') }}',
            data: data_to_send,
            success: function (data) {
                setTimeout(function(){
                    hide_spinner_loading();
                    alert(data['message']);
                }, 2000);

                $('.form_basic_decease').trigger("reset");
                $('.form_basic_decease input#kmout').val(data['kmall']);
                km_out = data['kmall'];
            }
        });
        return false;
    });
</script>