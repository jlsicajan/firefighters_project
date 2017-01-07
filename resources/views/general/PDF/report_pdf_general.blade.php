<style>
    table {
        border-collapse: collapse;
    }

    table, td, th {
        border: 1px solid black;
    }

    h2{
        color: #293D3B;
    }
</style>
<div id="details" class="clearfix">
    <div id="invoice">
        <h2>REPORTE DESDE EL {{ $date_from }} HASTA EL {{ $date_to }}</h2>
    </div>
</div>
<table>
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
<div id="details" class="clearfix">
    {{--<div id="invoice">--}}
        {{--<h2>TOTAL APORTES: Q. {{ number_format($total_gas_general, 2) }}</h2>--}}
        {{--<hr>--}}
        {{--<h2>TOTAL SALIDAS AD21: {{ $total_out_ad21 }} </h2>--}}
        {{--<h2>TOTAL SALIDAS RD19: {{ $total_out_rd19 }}</h2>--}}
        {{--<h2>TOTAL SALIDAS MDP-22: {{ $total_out_mdp22 }}</h2>--}}
        {{--<h2>TOTAL SALIDAS TDP-22: {{ $total_out_tdp22 }}</h2>--}}
        {{--<h2>TOTAL SALIDAS EE-22: {{ $total_out_ee22 }}</h2>--}}
    {{--</div>--}}
</div>