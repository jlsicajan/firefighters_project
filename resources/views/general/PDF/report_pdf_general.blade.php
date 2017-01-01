<div id="details" class="clearfix">
    <div id="invoice">
        <h1></h1>
        <div class="date">:</div>
    </div>
</div>
<table border="1">
    <thead>
    <tr>
        <th>Fecha</th>
        <th>Unidad</th>
        <th>Nombre paciente</th>
        <th>Piloto</th>
        <th>Asistente</th>
        <th>Oficial que reporta</th>
        <th>Paciente aporte / telefono</th>
        <th>Caso</th>
    </tr>
    </thead>
    <tbody>
    @foreach(json_decode($unity_datas) as $unity_data)
        <tr>
            <td>{{ $unity_data->date }}</td>
            <td>{{  App\Unity::getNameById($unity_data->unity_id) }}</td>
            <td>{{ $unity_data->patient_name }}</td>
            <td>{{  App\User::getNameById($unity_data->pilot_id) }}</td>
            @if(App\User::getNameById($unity_data->asistant_id) != '')
                <td>{{  App\User::getNameById($unity_data->asistant_id) }}</td>
            @else
                <td>NINGUN ASISTENTE</td>
            @endif
            <td>{{  App\User::getNameById($unity_data->user_id) }}</td>
            <td>Q {{ $unity_data->patient_input }}/{{ $unity_data->patient_phone }}</td>
            <td>{{ $unity_data->patient_case }}</td>
        </tr>
    @endforeach
    </tbody>
</table>