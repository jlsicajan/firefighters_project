@extends('layouts.app')
@section('after-styles')
    <style>
        .btn-bs-file{
            position:relative;
        }
        .btn-bs-file input[type="file"]{
            position: absolute;
            top: -9999999;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            cursor: inherit;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Gastos de combustible</div>

                    <div class="panel-body">
                        <meta name="csrf-token" content="{{ csrf_token() }}"/>
                        <form action="#" autocomplete="off" method="POST" id="form_gas">
                            <div class="form-group">
                                <label for="date">Fecha</label>
                                <input type="text" class="form-control" name="date" id="date" required value="{{ $date_today }}" disabled/>
                            </div>
                            <div class="form-group">
                                <label for="unity">Unidad</label>
                                <select class="form-control" id="unity" name="unity">
                                    <option value="null" selected disabled>-- Seleccion la unidad --</option>
                                    @foreach($unities as $unity)
                                        <option value="{{ $unity->code }}">{{ $unity->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="bill_number">Numero de la factura</label>
                                <input type="number" class="form-control" name="bill_number" id="bill_number"/>
                            </div>
                            <div class="form-group">
                                <label for="gas_name">Nombre de la gasolinera</label>
                                <input class="form-control" id="gas_name" name="gas_name"
                                       required/>
                            </div>
                            <div class="form-group">
                                <label for="gas_spend">Ingrese la cantidad que gasto (Q)</label>
                                <input type="number" class="form-control" name="gas_spend" id="gas_spend"
                                       required/>
                            </div>
                            <div class="form-group">
                                <label for="note_gas">Nota (no obligatorio)</label>
                                <textarea class="form-control" name="note_gas" id="note_gas" rows="2"></textarea>
                            </div>

                            <input type="submit" class="btn btn-primary" value="Guardar"/>
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
        $('#form_gas').on('submit', function (e) {
            $.ajax({
                type: "POST",
                url: '{{ URL::route('save.gas') }}',
                data: {
                    date: $('input#date').val(),
                    unity: $('select#unity').val(),
                    bill_number: $('input#bill_number').val(),
                    gas_name: $('input#gas_name').val(),
                    gas_spend: $('input#gas_spend').val(),
                    note_gas: $('textarea#note_gas').val(),
                    _token: CSRF_TOKEN
                },
                success: function (data) {
                    alert(data);
                    $('#form_gas').trigger("reset");
                    $('#date').val(today);
                }
            });
            return false;
        });
    </script>
@endsection
