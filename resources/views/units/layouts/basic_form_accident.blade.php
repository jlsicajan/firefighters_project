<form action="#" autocomplete="off" method="POST" class="form_basic_accident">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <input type="hidden" name="unity_id_a" id="unity_id_a" value="{{ $unity_set }}"/>
    <input type="hidden" name="general_case_a" id="general_case_a" value="{{ $general_case }}"/>
    <div class="form-group">
        <label for="date_a">Fecha</label>
        <input type="text" class="form-control" name="date" id="date" required value="{{ $date_today }}" disabled/>
    </div>

    <div class="form-group">
        <label for="timeout_a">Hora salida</label>
        <input type="text" class="form-control" name="timeout_a" id="timeout_a" required placeholder="00:00"/>
    </div>

    <div class="form-group">
        <label for="timein_a">Hora entrada</label>
        <input type="text" class="form-control" name="timein_a" id="timein_a" required placeholder="00:00"/>
    </div>

    <div class="form-group">
        <label for="kmout_a">Kilometraje salida</label>
        <input type="number" class="form-control kmout" name="kmout_a" id="kmout_a" value="{{ $kmin_all }}" required/>
    </div>

    <div class="form-group">
        <label for="kmin_a">Kilometraje entrada</label>
        <input type="number" class="form-control" name="kmin_a" id="kmin_a" required/>
    </div>

    <div class="form-group">
        Paciente<label class="checkbox-inline">
            <input type="radio" class="form-check-input" name="patient_check_a"
                   id="patient_name_check_a" value="yes" checked>
            Nombre del paciente
        </label>
        <label class="checkbox-inline">
            <input type="radio" class="form-check-input" name="patient_check_a"
                   id="patient_responsible_check_a" value="no">
            Encargado o responsable del paciente
        </label>
    </div>

    <div class="form-group" id="name_patient_div_a">
        <label for="patient_name_a">Nombre del paciente</label>
        <input type="text" class="form-control" name="patient_name_a" id="patient_name_a"/>
    </div>

    <div class="form-group" id="name_responsible_div_a">
        <label for="patient_responsible_a">Responsable o encargado del paciente</label>
        <input type="text" class="form-control" name="patient_responsible_a" id="patient_responsible_a"/>
    </div>

    <div class="form-group">
        <label for="patient_age_a">Edad del paciente</label>
        <input type="text" placeholder="edad del paciente" class="form-control" name="patient_age_a" id="patient_age_a"
               required/>
    </div>

    <div class="form-group">
        <label for="patient_case_a">Caso del paciente</label>
        <textarea class="form-control" id="patient_case_a" name="patient_case_a" rows="2"
                  required placeholder="Descripcion de lo que le sucedio al paciente"></textarea>
    </div>

    <div class="form-group">
        <label for="patient_address_a">Direccion del paciente</label>
        <input type="text" class="form-control" name="patient_address_a"
               id="patient_address_a" required/>
    </div>

    <div class="form-group">
        <label for="patient_address_from_a">Lugar de donde salio el paciente</label>
        <input type="text" class="form-control" name="patient_address_from_a"
               id="patient_address_from_a" required/>
    </div>

    <div class="form-group">
        <label for="patient_destiny_a">Lugar al que se traslado el paciente</label>
        <input class="form-control" id="patient_destiny_a" name="patient_destiny_a" rows="2"
               required/>
    </div>

    <div class="form-group">
        <label for="patient_phone_a">Ingrese el numero de telefono del paciente</label>
        <input type="number" class="form-control" name="patient_phone_a" id="patient_phone_a"/>
    </div>

    <div class="form-group">
        <label for="patient_input_a">Cantidad si aporto algo el paciente</label>
        <input type="number" class="form-control" name="patient_input_a" id="patient_input_a"/>
    </div>

    <div class="form-group">
        <label for="asistant_a">Asistente</label>
        <select class="form-control" id="asistant_a" name="asistant_a">
            <option value="null" selected disabled>-- Seleccione al asistente --</option>
            <option value="no_one">NINGUN ASISTENTE</option>
            @foreach($officials as $official)
                <option value="{{ $official->id }}">{{ $official->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="asistant_id_two_a">Segundo asistente</label>
        <select class="form-control" id="asistant_id_two_a" name="asistant_id_two_a">
            <option value="no_one" selected>SIN SEGUNDO ASISTENTE</option>
            @foreach($officials as $official)
                <option value="{{ $official->id }}">{{ $official->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="pilot_a">Piloto</label>
        <select class="form-control" id="pilot_a" name="pilot_a">
            <option value="null" selected disabled>-- Seleccione al piloto --</option>
            @foreach($pilots as $pilot)
                <option value="{{ $pilot->id }}">{{ $pilot->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="observations_a">Observaciones</label>
        <textarea class="form-control" id="observations_a" name="observations_a" rows="2"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>