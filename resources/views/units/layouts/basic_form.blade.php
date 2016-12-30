<form action="#" autocomplete="off" method="POST" class="form_basic">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="form-group">
        <label for="date">Fecha</label>
        <input type="date" class="form-control date" name="date" id="date" required/>
    </div>
    <div class="form-group">
        <label for="kmout">Hora salida</label>
        <input type="text" class="form-control" name="timeout" id="timeout" required/>
    </div>
    <div class="form-group">
        <label for="kmout">Hora entrada</label>
        <input type="text" class="form-control" name="timein" id="timein" required/>
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
        <label for="patient_name">Nombre del paciente</label>
        <input type="text" class="form-control" name="patient_name" id="patient_name"
               required/>
    </div>
    <div class="form-group">
        <label for="patient_age">Edad del paciente</label>
        <input type="number" class="form-control" name="patient_age" id="patient_age"
               required/>
    </div>
    <div class="form-group">
        <label for="patient_case">Caso del paciente</label>
        <textarea class="form-control" id="patient_case" name="patient_case" rows="2"
                  required></textarea>
    </div>
    <div class="form-group">
        <label for="patient_address">Direccion del paciente</label>
        <input type="text" class="form-control" name="patient_address"
               id="patient_address" required/>
    </div>
    <div class="form-group">
        <label for="patient_destiny">Lugar al que se traslado el paciente</label>
        <input class="form-control" id="patient_destiny" name="patient_destiny" rows="2"
               required/>
    </div>
    <div class="form-group">
        Aporto algo el paciente<label class="checkbox-inline">
            <input type="radio" class="form-check-input" name="optionsRadios"
                   id="optionsRadios1" value="yes" checked>
            Si
        </label>
        <label class="checkbox-inline">
            <input type="radio" class="form-check-input" name="optionsRadios"
                   id="optionsRadios2" value="no">
            No
        </label>
    </div>
    <div class="form-group">
        <label for="patient_phone">Ingrese numero del paciente</label>
        <input type="number" class="form-control" name="patient_phone" id="patient_phone"/>
    </div>
    <div class="form-group">
        <label for="patient_input">Ingrese la cantidad que aporto</label>
        <input type="number" class="form-control" name="patient_input" id="patient_input"/>
    </div>
    <div class="form-group">
        <label for="unity">Asistente</label>
        <select class="form-control" id="unity" name="unity">
            <option value="null" selected disabled>-- Seleccion el asistente --</option>
            @foreach($officials as $official)
                <option value="{{ $official->number }}">{{ $official->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="unity">Piloto</label>
        <select class="form-control" id="unity" name="unity">
            <option value="null" selected disabled>-- Seleccion piloto --</option>
            @foreach($officials as $official)
                <option value="piloto-{{ $official->number }}">{{ $official->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>