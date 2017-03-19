<form action="#" autocomplete="off" method="POST" class="form_basic_water">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <input type="hidden" name="unity_id_water" id="unity_id_water" value="{{ $unity_set }}"/>
    <input type="hidden" name="general_case_water" id="general_case_water" value="{{ $general_case }}"/>
    <div class="form-group">
        <label for="date_water">Fecha</label>
        <input type="text" class="form-control" name="date" id="date" required value="{{ $date_today }}" disabled/>
    </div>

    <div class="form-group">
        <label for="timeout_water">Hora salida</label>
        <input type="text" class="form-control" name="timeout_water" id="timeout_water" required placeholder="00:00"/>
    </div>

    <div class="form-group">
        <label for="timein_water">Hora entrada</label>
        <input type="text" class="form-control" name="timein_water" id="timein_water" required placeholder="00:00"/>
    </div>

    <div class="form-group">
        <label for="kmout_water">Kilometraje salida</label>
        <input type="number" class="form-control kmout" name="kmout_water" id="kmout_water" value="{{ $kmin_all }}" required/>
    </div>

    <div class="form-group">
        <label for="kmin_water">Kilometraje entrada</label>
        <input type="number" class="form-control" name="kmin_water" id="kmin_water" required/>
    </div>

    <div class="form-group" id="name_patient_div_water">
        <label for="water_destiny">Lugar a donde se distribuye</label>
        <input type="text" class="form-control" name="water_destiny" id="water_destiny"/>
    </div>

    <div class="form-group">
        <label for="water_spend">Cantidad distribuida</label>
        <input type="text" class="form-control" name="water_spend" id="water_spend"
               required/>
    </div>

    <div class="form-group">
        <label for="fill_unity">Donde se cargo la unidad</label>
        <input class="form-control" id="fill_unity" name="fill_unity" rows="2"/>
    </div>

    <div class="form-group">
        <label for="fill_spend">Cuanto se pago por la cargada</label>
        <input type="number" class="form-control" name="fill_spend" id="fill_spend"/>
    </div>

    <div class="form-group">
        <label for="spend_aport">Quien aporta el gasto</label>
        <input type="text" class="form-control" name="spend_aport" id="spend_aport"
               required/>
    </div>

    <div class="form-group">
        <label for="patient_phone_water">Ingrese el numero de telefono del usuario</label>
        <input type="number" class="form-control" name="patient_phone_water" id="patient_phone_water"/>
    </div>

    <div class="form-group">
        <label for="patient_input_water">Cantidad si aporto algo el usuario</label>
        <input type="number" class="form-control" name="patient_input_water" id="patient_input_water"/>
    </div>

    <div class="form-group">
        <label for="asistant_water">Asistente</label>
        <select class="form-control" id="asistant_water" name="asistant_water">
            <option value="null" selected disabled>-- Seleccione al asistente --</option>
            <option value="no_one">NINGUN ASISTENTE</option>
            @foreach($officials as $official)
                <option value="{{ $official->id }}">{{ $official->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="asistant_id_two_water">Segundo asistente</label>
        <select class="form-control" id="asistant_id_two_water" name="asistant_id_two_water">
            <option value="no_one" selected>SIN SEGUNDO ASISTENTE</option>
            @foreach($officials as $official)
                <option value="{{ $official->id }}">{{ $official->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="pilot_water">Piloto</label>
        <select class="form-control" id="pilot_water" name="pilot_water">
            <option value="null" selected disabled>-- Seleccione al piloto --</option>
            @foreach($pilots as $pilot)
                <option value="{{ $pilot->id }}">{{ $pilot->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="observations_water">Observaciones</label>
        <textarea class="form-control" id="observations_water" name="observations_water" rows="2"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>