<style>
    table {
        border-collapse: collapse;
        font-size: 12px;
        text-align: center;
    }

    .th_list {
        text-align: unset;
    }

    table, td, th {
        border: 1px solid #2B2B2B;
        color: #2B2B2B;
    }

    h2 {
        color: #006200;
    }

    .address_from, .gain {
        color: #006200;
    }

    .address_to, .total_km, .lost {
        color: #930000;
    }

    .page-break {
        page-break-after: always;
    }

    .nowrap {
        white-space: nowrap;
    }

    .p-x-15{
        padding-left: 15px;
        padding-right: 15px;
    }

</style>
@foreach($unities as $unity_one)
    <table>
        <tr>
            <td align="right"><strong>REPORTE DESDE EL {{ $date_from }} HASTA
                    EL {{ $date_to }}</strong></td>
        </tr>
        <tr>
            <td align="center"><strong>{{ App\Unity::findNameByCode($unity_one->code) }}</strong>
            </td>
        </tr>
    </table><br>
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
            <th>Caso / <p style="color: green">Observaciones</p></th>
            <th class="th_list">
                <ul type="square">
                    <li class="address_from">Desde</li>
                    <li class="address_to">Hasta</li>
                </ul>
            </th>
            <th class="th_list nowrap">
                <ul type="square">
                    <li class="km_out">Km salida</li>
                    <li class="km_in">Km entrada</li>
                    <li class="total_km">Km recorridos</li>
                </ul>
            </th>
            <th> @if($unity_one->code == "TDP22") Cantidad de agua @else CASO @endif</th>
        </tr>
        </thead>
        <tbody>
        @foreach($unity_datas[$unity_one->code] as $unity_data)
            @if($unity_one->code == "TDP22")
                <tr>
                    <td>{{ $unity_data->date }}</td>
                    <td>{{  $unity_data->unity->code  }}</td>
                    <td>@if($unity_data->patient_name == " ") {{ $unity_data->general_case }} @else {{ $unity_data->patient_name }} @endif</td>
                    <td>{{  $unity_data->pilot->name }}</td>
                    @if(App\User::getNameById($unity_data->asistant_id) != '')
                        <td>{{  $unity_data->asistant->name or 'Sin asistente'}}</td>
                    @else
                        <td>NINGUN ASISTENTE</td>
                    @endif
                    <td>{{  $unity_data->user->name }}</td>
                    <td>Q. {{ number_format($unity_data->patient_input , 2) }}
                        / {{ $unity_data->patient_phone }}</td>
                    <td>{{ $unity_data->patient_case }} / <p
                                style="color: green">{{ $unity_data->observations }}</p></td>
                    <td class="th_list">
                        <ul type="square">
                            <li class="address_from">{{ $unity_data->patient_address_from }}</li>
                            <li class="address_to">{{ $unity_data->patient_destiny }}</li>
                        </ul>
                    </td>
                    <td class="th_list nowrap">
                        <ul type="square">
                            <li class="km_out">{{ $unity_data->kmout }}</li>
                            <li class="km_in">{{ $unity_data->kmin }}</li>
                            <li class="total_km">{{ $unity_data->kmin - $unity_data->kmout }} km recorridos</li>
                        </ul>
                    </td>
                    <td><strong>{{ $unity_data->water_spend }}</strong></td>
                </tr>
            @else
                <tr>
                    <td>{{ $unity_data->date }}</td>
                    <td>{{ $unity_data->unity->code }}</td>
                    <td>{{ $unity_data->patient_name }}</td>
                    <td>{{ $unity_data->pilot->name }}</td>
                    @if(App\User::getNameById($unity_data->asistant_id) != '')
                        <td>{{  $unity_data->asistant->name or 'Sin asistente' }}</td>
                    @else
                        <td>NINGUN ASISTENTE</td>
                    @endif
                    <td>{{ $unity_data->user->name }}</td>
                    <td>Q. {{ number_format($unity_data->patient_input , 2) }}
                        / {{ $unity_data->patient_phone }}</td>
                    <td>{{ $unity_data->patient_case }} / <p
                                style="color: green">{{ $unity_data->observations }}</p></td>
                    <td class="th_list">
                        <ul type="square">
                            <li class="address_from">{{ $unity_data->patient_address_from }}</li>
                            <li class="address_to">{{ $unity_data->patient_destiny }}</li>
                        </ul>
                    </td>
                    <td class="th_list nowrap">
                        <ul type="square">
                            <li class="km_out">{{ $unity_data->kmout }}</li>
                            <li class="km_in">{{ $unity_data->kmin }}</li>
                            <li class="total_km">{{ $unity_data->kmin - $unity_data->kmout }} km recorridos</li>
                        </ul>
                    </td>
                    <td><strong>{{ $unity_data->general_case }}</strong></td>
                </tr>
            @endif
            <?php $kmtour[$unity_one->code] = $unity_data->kmin - $km_first[$unity_one->code] ?>
        @endforeach
        </tbody>
    </table><br>
    <table>
        <tr>
            <td><strong>TOTAL INGRESO POR
                    APORTES {{ App\Unity::findNameByCode($unity_one->code) }}: </strong></td>
            <td><strong>Q. {{ number_format($total_in[$unity_one->code], 2) }}</strong>
            </td>
        </tr>
        <tr>
            <td><strong>KILOMETROS
                    RECORRIDOS {{ App\Unity::findNameByCode($unity_one->code) }}: </strong></td>
            <td><strong> @if(isset($kmtour[$unity_one->code])) {{ number_format($kmtour[$unity_one->code]) }} @else
                        0 @endif KM</strong></td>
        </tr>
    </table>
    <div class="page-break"></div>
@endforeach

<div id="details" class="clearfix">
    <div id="invoice">
        <table>
            <tr>
                <td class="p-x-15"><strong>UNIDAD</strong></td>
                <td class="p-x-15"><strong>INGRESOS</strong></td>
                <td class="p-x-15"><strong>EGRESOS POR GASOLINA</strong></td>
                <td class="p-x-15"><strong>GASTOS DE LA ESTACION</strong></td>
                <td class="p-x-15"><strong>SALDO</strong></td>
            </tr>
            @foreach($unities as $unity_one)
                <tr>
                    <td>{{ $unity_one->code }}:</strong></td>
                    <td>Q. {{ number_format($total_in[$unity_one->code], 2) }}</td>
                    <td>Q. {{ number_format($total_gas_out[$unity_one->code], 2) }}</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
            <tr>
                <td><strong>TOTAL: </strong></td>
                <td><strong class="gain">Q. {{ number_format($total_in_all, 2) }}</strong></td>
                <td><strong class="lost">Q. {{ number_format($total_gas_out_all, 2) }}</strong></td>
                <td><strong class="lost">Q. {{ number_format($total_station_spends, 2) }}</strong></td>
                <td><strong class="gain">Q. {{ number_format($total_in_all - ($total_gas_out_all + $total_station_spends), 2) }}</strong></td>
            </tr>
        </table>
    </div>
</div>
