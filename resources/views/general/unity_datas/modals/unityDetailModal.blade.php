<h5><strong>{{$unity_data->general_case }}</strong></h5>
<form class="form-inline">
    <div class="form-group">
        <label for="date">Fecha</label>
        <input size="20" class="form-control" id="date" type="text" value="{{ $unity_data->date }}" disabled>
    </div>
    <div class="form-group">
        <label for="user_id">Oficial que reporta</label>
        <input size="20" class="form-control" id="user_id" type="text" value="{{  $unity_data->user->name }}" disabled>
    </div>
    <div class="form-group">
        <label for="unity">Unidad</label>
        <input size="10" class="form-control" id="unity" type="text" value="{{ $unity_data->unity->name }}" disabled>
    </div>
</form>
<form class="form-inline">
    <div class="form-group">
        <label for="user_id">Hora salida</label>
        <input size="3" class="form-control" id="user_id" type="text" value="{{  $unity_data->timeout }}" disabled>
    </div>
    <div class="form-group">
        <label for="user_id">Hora entrada</label>
        <input size="3" class="form-control" value="{{  $unity_data->timein }}" disabled>
    </div>
    <div class="form-group">
        <label>Kilometraje salida</label>
        <input size="3" class="form-control" value="{{  $unity_data->kmout }}" disabled>
    </div>
    <div class="form-group">
        <label>Kilometraje entrada</label>
        <input size="3" class="form-control" value="{{  $unity_data->kmin }}" disabled>
    </div>
</form>
<form class="form-inline">
    <div class="form-group">
        <label>Nombre del paciente</label>
        <input size="3" class="form-control" value="{{  $unity_data->patient_name }} - {{ $unity_data->patient_responsible  }}" disabled>
    </div>
    <div class="form-group">
        <label>Edad del paciente</label>
        <input size="3" class="form-control" value="{{  $unity_data->patient_age }}" disabled>
    </div>
    <div class="form-group">
        <label>Direccion del paciente</label>
        <input size="5" class="form-control" value="{{  $unity_data->patient_address }}" disabled>
    </div>
</form>
<form class="form-inline">
    <div class="form-group">
        <label>Direccion de donde salio el paciente</label>
        <input size="4" class="form-control" value="{{  $unity_data->patient_address_from }}" disabled>
    </div>
</form>
<form class="form-inline">
    <div class="form-group">
        <label>Caso</label>
        <textarea size="3" class="form-control" value="{{  $unity_data->patient_case }}" disabled/>
    </div>
</form>