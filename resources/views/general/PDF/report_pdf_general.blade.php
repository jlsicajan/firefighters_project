<style>
    table {
        border-collapse: collapse;
        font-size: 12px;
        text-align: center;
    }

    .th_list{
        text-align: unset;
    }

    table, td, th {
        border: 1px solid #2B2B2B;
        color: #2B2B2B;
    }

    h2 {
        color: #006200;
    }

    .address_from{
        color: #006200;
    }

    .address_to{
        color: #930000;
    }

    .page-break {
        page-break-after: always;
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
            <th>Km salida</th>
            <th>Km entrada</th>
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
                    <td><strong >{{ $unity_data->kmout }}</strong></td>
                    <td><strong >{{ $unity_data->kmin }}</strong></td>
                    <td><strong >{{ $unity_data->water_spend }}</strong></td>
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
                    <td><strong >{{ $unity_data->kmout }}</strong></td>
                    <td><strong >{{ $unity_data->kmin }}</strong></td>
                    <td><strong >{{ $unity_data->general_case }}</strong></td>
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
            @foreach($unities as $unity_one)
                <tr>
                    <td><strong >TOTAL INGRESOS {{ $unity_one->name }}:</strong></td>
                    <td><strong >Q. {{ number_format($total_in[$unity_one->code], 2) }}</strong></td>
                </tr>
            @endforeach
            <tr>
                <td><strong>TOTAL: </strong></td>
                <td><strong>Q. {{ number_format($total_in_all, 2) }}</strong></td>
            </tr>
        </table>
    </div>
</div>
