<form action="#" autocomplete="off" method="POST" class="form_basic_service">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <input type="hidden" name="unity_id_service" id="unity_id_service" value="{{ $unity_set }}"/>
    <input type="hidden" name="general_case_service" id="general_case_service" value="{{ $general_case }}"/>
    <div class="form-group">
        <label for="date_service">Fecha</label>
        <input type="date" class="form-control date" name="date_service" id="date_service" required/>
    </div>

    <div class="form-group">
        <label for="timeout_service">Hora salida</label>
        <input type="text" class="form-control" name="timeout_service" id="timeout_service" required placeholder="00:00"/>
    </div>

    <div class="form-group">
        <label for="timein_service">Hora entrada</label>
        <input type="text" class="form-control" name="timein_service" id="timein_service" required placeholder="00:00"/>
    </div>

    <div class="form-group">
        <label for="kmout_service">Kilometraje salida</label>
        <input type="number" class="form-control" name="kmout_service" id="kmout_service" required/>
    </div>

    <div class="form-group">
        <label for="kmin_service">Kilometraje entrada</label>
        <input type="number" class="form-control" name="kmin_service" id="kmin_service" required/>
    </div>

    <div class="form-group">
        <label for="service_type">Tipo de servicio social</label>
        <input type="text" class="form-control" name="service_type" id="service_type" required/>
    </div>

    <div class="form-group">
        Paciente<label class="checkbox-inline">
            <input type="radio" class="form-check-input" name="patient_check_service"
                   id="patient_name_check_service" value="yes" checked>
            Nombre del paciente
        </label>
        <label class="checkbox-inline">
            <input type="radio" class="form-check-input" name="patient_check_service"
                   id="patient_responsible_check_service" value="no">
            Encargado o responsable del paciente
        </label>
    </div>

    <div class="form-group" id="name_patient_div_service">
        <label for="patient_name_service">Nombre del paciente</label>
        <input type="text" class="form-control" name="patient_name_service" id="patient_name_service"/>
    </div>

    <div class="form-group" id="name_responsible_div_service">
        <label for="patient_responsible_service">Responsable o encargado del paciente</label>
        <input type="text" class="form-control" name="patient_responsible_service" id="patient_responsible_service"/>
    </div>

    <div class="form-group">
        <label for="patient_age_service">Edad del paciente</label>
        <input type="text" placeholder="edad del paciente" class="form-control" name="patient_age_service" id="patient_age_service"
               required/>
    </div>

    <div class="form-group">
        <label for="patient_case_service">Caso del paciente</label>
        <textarea class="form-control" id="patient_case_service" name="patient_case_service" rows="2"
                  required placeholder="Descripcion de lo que le sucedio al paciente"></textarea>
    </div>

    <div class="form-group">
        <label for="patient_address_service">Direccion del paciente</label>
        <input type="text" class="form-control" name="patient_address_service"
               id="patient_address_service" required/>
    </div>

    <div class="form-group">
        <label for="patient_address_from_service">Lugar de donde salio el paciente</label>
        <input type="text" class="form-control" name="patient_address_from_service"
               id="patient_address_from_service" required/>
    </div>

    <div class="form-group">
        <label for="patient_destiny_service">Lugar al que se traslado el paciente</label>
        <input class="form-control" id="patient_destiny_service" name="patient_destiny_service" rows="2"
               required/>
    </div>

    <div class="form-group">
        <label for="patient_phone_service">Ingrese el numero de telefono del paciente</label>
        <input type="number" class="form-control" name="patient_phone_service" id="patient_phone_service"/>
    </div>

    <div class="form-group">
        <label for="patient_input_service">Cantidad si aporto algo el paciente</label>
        <input type="number" class="form-control" name="patient_input_service" id="patient_input_service"/>
    </div>

    <div class="form-group">
        <label for="asistant_service">Asistente</label>
        <select class="form-control" id="asistant_service" name="asistant_service">
            <option value="null" selected disabled>-- Seleccion el asistente --</option>
            <option value="no_one">NINGUN ASISTENTE</option>
            @foreach($officials as $official)
                <option value="{{ $official->id }}">{{ $official->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="asistant_id_two_service">Segundo asistente</label>
        <select class="form-control" id="asistant_id_two_service" name="asistant_id_two_service">
            <option value="no_one" selected>SIN SEGUNDO ASISTENTE</option>
            @foreach($officials as $official)
                <option value="{{ $official->id }}">{{ $official->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="pilot_service">Piloto</label>
        <select class="form-control" id="pilot_service" name="pilot_service">
            <option value="null" selected disabled>-- Seleccion piloto --</option>
            @foreach($pilots as $pilot)
                <option value="{{ $pilot->id }}">{{ $pilot->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="observations_service">Observaciones</label>
        <textarea class="form-control" id="observations_service" name="observations_service" rows="2"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>