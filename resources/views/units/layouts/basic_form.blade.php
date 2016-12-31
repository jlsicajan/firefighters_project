<form action="#" autocomplete="off" method="POST" class="form_basic">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <input type="hidden" name="unity_id" id="unity_id" value="{{ $unity_set }}"/>
    <div class="form-group">
        <label for="date">Fecha</label>
        <input type="date" class="form-control date" name="date" id="date" required/>
    </div>

    <div class="form-group">
        <label for="kmout">Hora salida</label>
        <input type="text" class="form-control" name="timeout" id="timeout" required placeholder="00:00"/>
    </div>

    <div class="form-group">
        <label for="kmout">Hora entrada</label>
        <input type="text" class="form-control" name="timein" id="timein" required placeholder="00:00"/>
    </div>

    <div class="form-group">
        <label for="kmout">Kilometraje salida</label>
        <input type="number" class="form-control" name="kmout" id="kmout" required/>
    </div>

    <div class="form-group">
        <label for="kmin">Kilometraje entrada</label>
        <input type="number" class="form-control" name="kmin" id="kmin" required/>
    </div>

    <div class="form-group">
        Paciente<label class="checkbox-inline">
            <input type="radio" class="form-check-input" name="patient_check"
                   id="patient_name_check" value="yes" checked>
            Nombre del paciente
        </label>
        <label class="checkbox-inline">
            <input type="radio" class="form-check-input" name="patient_check"
                   id="patient_responsible_check" value="no">
            Encargado o responsable del paciente
        </label>
    </div>

    <div class="form-group" id="name_patient_div">
        <label for="patient_name">Nombre del paciente</label>
        <input type="text" class="form-control" name="patient_name" id="patient_name"/>
    </div>

    <div class="form-group" id="name_responsible_div">
        <label for="patient_responsible">Responsable o encargado del paciente</label>
        <input type="text" class="form-control" name="patient_responsible" id="patient_responsible"/>
    </div>

    <div class="form-group">
        <label for="patient_age">Edad del paciente</label>
        <input type="text" placeholder="edad del paciente" class="form-control" name="patient_age" id="patient_age"
               required/>
    </div>

    <div class="form-group">
        <label for="patient_case">Caso del paciente</label>
        <textarea class="form-control" id="patient_case" name="patient_case" rows="2"
                  required placeholder="Descripcion de lo que le sucedio al paciente"></textarea>
    </div>

    <div class="form-group">
        <label for="patient_address">Direccion del paciente</label>
        <input type="text" class="form-control" name="patient_address"
               id="patient_address" required/>
    </div>

    <div class="form-group">
        <label for="patient_address_from">Lugar de donde salio el paciente</label>
        <input type="text" class="form-control" name="patient_address_from"
               id="patient_address_from" required/>
    </div>

    <div class="form-group">
        <label for="patient_destiny">Lugar al que se traslado el paciente</label>
        <input class="form-control" id="patient_destiny" name="patient_destiny" rows="2"
               required/>
    </div>

    <div class="form-group">
        Aporto algo el paciente<label class="checkbox-inline">
            <input type="radio" class="form-check-input" name="input_patient"
                   id="yes_input" value="yes" checked>
            Si
        </label>
        <label class="checkbox-inline">
            <input type="radio" class="form-check-input" name="input_patient"
                   id="no_input" value="no">
            No
        </label>
    </div>

    <div class="form-group" id="div_phone_patient">
        <label for="patient_phone">Ingrese el numero de telefono del paciente</label>
        <input type="number" class="form-control" name="patient_phone" id="patient_phone"/>
    </div>

    <div class="form-group" id="div_patient_input">
        <label for="patient_input">Ingrese la cantidad que aporto</label>
        <input type="number" class="form-control" name="patient_input" id="patient_input"/>
    </div>

    <div class="form-group">
        <label for="unity">Asistente</label>
        <select class="form-control" id="asistant" name="asistant">
            <option value="null" selected disabled>-- Seleccion el asistente --</option>
            <option value="no_one">NINGUN ASISTENTE</option>
            @foreach($officials as $official)
                <option value="{{ $official->id }}">{{ $official->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="unity">Piloto</label>
        <select class="form-control" id="pilot" name="pilot">
            <option value="null" selected disabled>-- Seleccion piloto --</option>
            @foreach($pilots as $pilot)
                <option value="{{ $pilot->id }}">{{ $pilot->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>