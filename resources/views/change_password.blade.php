@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Cambio de contraseña para: {{ Auth::user()->name }}</div>

                    <div class="panel-body">
                        <strong style="color: red;">Esta opcion es para que usted pueda cambiar su contraseña, debera ingresar su contraseña actual
                            para completar el proceso.</strong>
                        <meta name="csrf-token" content="{{ csrf_token() }}"/>
                        @if(Session::has('flash_message'))
                            <div class="alert alert-danger">{{ Session::get('flash_message') }}</div>
                        @endif
                        <form action="#" autocomplete="off" method="POST" id="form_change_pass">
                            <div class="form-group">
                                <label for="old_password">Contraseña actual</label>
                                <input type="password" class="form-control" name="old_password" id="old_password" required/>
                            </div>
                            <div class="form-group">
                                <label for="new_password">Ingrese nueva contraseña</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" required/>
                            </div>
                            <div class="form-group">
                                <label for="confirm_new_password">Confirmar nueva contraseña</label>
                                <input type="password" class="form-control" name="confirm_new_password"
                                       id="confirm_new_password" required/>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Cambiar contraseña"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('after_scripts')
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#form_change_pass').on('submit', function (e) {
            $.ajax({
                type: "POST",
                url: '{{ URL::route('save.password') }}',
                data: {
                    old_password: $('input#old_password').val(),
                    new_password: $('input#new_password').val(),
                    confirm_new_password: $('input#confirm_new_password').val(),
                    _token: CSRF_TOKEN
                },
                success: function (data) {
                    $('#form_change_pass').trigger("reset");
                    alert(data);
                    window.location.href = "{{ URL::to('home') }}"
                },
                error: function (error) {
                    alert(error['responseJSON']['error']);
                    $('#form_change_pass').trigger("reset");
                }
            });
            return false;
        });
    </script>
@endsection
