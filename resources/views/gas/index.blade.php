@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Gastos de combustible</div>

                    <div class="panel-body">
                        <form>
                            <div class="form-group">
                                <label for="unity">Unidad</label>
                                <select class="form-control" id="unity">
                                    <option>UNIDAD AD 21</option>
                                    <option>UNIDAD RD 19</option>
                                    <option>UNIDAD MDP 22</option>
                                    <option>UNIDAD TDP 22</option>
                                    <option>UNIDAD EE 22</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="bill_number">Numero de la factura</label>
                                <input type="number" class="form-control" name="bill_number" id="bill_number"
                                       required/>
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
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('after_scripts')
    <script>
        //        alert('it works');
        //        $('#patient_phone').hide();
    </script>
@endsection
