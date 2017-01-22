<div class="container">
    <div class="row">
        <div class="col-xs-4">
            <h4><strong>{{$unity_data->general_case }}</strong></h4>
            <hr>
            <h5><strong>Oficial que reporta:</strong> {{ $unity_data->user->name }}</h5>
            <h5><strong>Unidad:</strong> {{ $unity_data->unity->name }}</h5>
            <h5><strong>Hora de salida:</strong> {{ $unity_data->timeout }}</h5>
            <h5><strong>Hora de entrada:</strong> {{ $unity_data->timein }}</h5>
            <h5><strong>Km salida:</strong> {{ $unity_data->kmout }}</h5>
            <h5><strong>Km entrada:</strong> {{ $unity_data->kmin }}</h5>
            <br>
            <h4><strong>Detalles del paciente</strong></h4>
            <hr>
            <h5><strong>Nombre:</strong> {{  $unity_data->patient_name }} - {{ $unity_data->patient_responsible  }}</h5>
            <h5><strong>Edad:</strong> {{  $unity_data->patient_age }}</h5>
            <h5><strong>Direccion:</strong> {{  $unity_data->patient_address }}</h5>
            <h5><strong>Direccion de donde salio:</strong> {{  $unity_data->patient_address_from }}</h5>
            <h5><strong>Direccion a donde se llevo:</strong> {{  $unity_data->patient_destiny }}</h5>
            <h5><strong>Telefono:</strong> {{  $unity_data->patient_phone }}</h5>
            <h5><strong>Aporte del paciente:</strong> {{  $unity_data->patient_input }}</h5>
            <h5><strong>Caso:</strong> {{  $unity_data->patient_case }}</h5>
        </div>
        <div class="col-xs-4">
            <h4><strong>{{ $unity_data->date }}</strong></h4>
            <hr>
            <h5><strong>Asistente:</strong> {{ $unity_data->asistant->name }}</h5>
            <h5><strong>Segundo asistente:</strong> {{ App\User::getNameById($unity_data->asistant_id_two) }}</h5>
            <h5><strong>Piloto:</strong> {{ $unity_data->pilot->name }}</h5>
            <h5><strong>Tipo de servicio social:</strong> {{ $unity_data->service_type }}</h5>
            @if($unity_data->unity->code == "TDP22")
                <h5><strong>Destino servicio de agua:</strong> {{ $unity_data->water_destiny or ' ' }}</h5>
                <h5><strong>Cantidad distribuida:</strong> {{ $unity_data->water_spend or ' ' }}</h5>
                <h5><strong>Lugar de carga:</strong> {{ $unity_data->fill_unity or ' '  }}</h5>
                <h5><strong>Cuanto se gasto en la cargada:</strong> {{ $unity_data->fill_spend or ' ' }}</h5>
                <h5><strong>Quien aporta el gasto:</strong> {{ $unity_data->spend_aport or ' ' }}</h5>
            @endif
        </div>
    </div>
</div>