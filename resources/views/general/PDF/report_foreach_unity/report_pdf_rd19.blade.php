<style>
    table {
        border-collapse: collapse;
    }

    table, td, th {
        border: 1px solid blue;
    }

    h2 {
        color: green;
    }
</style>
<div id="details" class="clearfix">
    <div id="invoice">
        <h2>UNIDAD RD-19</h2>
        <h2>REPORTE DESDE EL {{ $date_from }} HASTA EL {{ $date_to }}</h2>
    </div>
</div>
<table>
    <thead>
    <tr>
        <th style="color: blue">Fecha</th>
        <th style="color: blue">Unidad</th>
        <th style="color: blue">Nombre paciente</th>
        <th style="color: blue">Piloto</th>
        <th style="color: blue">Asistente</th>
        <th style="color: blue">Oficial que reporta</th>
        <th style="color: blue">Paciente aporte / telefono</th>
        <th style="color: blue">Caso / <p style="color: green">Observaciones</p></th>
        <th style="color: blue">Km salida</th>
        <th style="color: blue">Km entrada</th>
        <th style="color: blue">CASO</th>
    </tr>
    </thead>
    <tbody>
    @foreach(json_decode($unity_datas) as $unity_data)
        <tr>
            <td style="color: blue">{{ $unity_data->date }}</td>
            <td style="color: blue">{{  App\Unity::getNameById($unity_data->unity_id) }}</td>
            <td style="color: blue">{{ $unity_data->patient_name }}</td>
            <td style="color: blue">{{  App\User::getNameById($unity_data->pilot_id) }}</td>
            @if(App\User::getNameById($unity_data->asistant_id) != '')
                <td style="color: blue">{{  App\User::getNameById($unity_data->asistant_id) }}</td>
            @else
                <td style="color: blue">NINGUN ASISTENTE</td>
            @endif
            <td style="color: blue">{{  App\User::getNameById($unity_data->user_id) }}</td>
            <td style="color: blue">Q. {{ number_format($unity_data->patient_input , 2) }}
                / {{ $unity_data->patient_phone }}</td>
            <td style="color: blue">{{ $unity_data->patient_case }} / <p
                        style="color: green">{{ $unity_data->observations }}</p></td>
            <td><strong style="color: blue">{{ $unity_data->kmout }}</strong></td>
            <td><strong style="color: blue">{{ $unity_data->kmin }}</strong></td>
            <td><strong style="color: blue">{{ $unity_data->general_case }}</strong></td>
        </tr>
        <?php $kmtour = $unity_data->kmin - $km_first?>
    @endforeach
    </tbody>
</table>
<div id="details" class="clearfix">
    <div id="invoice">
        <h2>TOTAL INGRESO POR APORTES: Q. {{ number_format($total_in, 2) }}</h2>
        <h2>CON UN TOTAL DE @if(isset($kmtour)) {{ $kmtour }} @else 0 @endif KILOMETROS RECORRIDOS</h2>
    </div>
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
