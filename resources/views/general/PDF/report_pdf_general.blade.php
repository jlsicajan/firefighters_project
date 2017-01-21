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

    .page-break {
        page-break-after: always;
    }
</style>
@foreach($unities as $unity_one)
    <table>
        <tr>
            <td align="right" style="color: red"><strong>REPORTE DESDE EL {{ $date_from }} HASTA
                    EL {{ $date_to }}</strong></td>
        </tr>
        <tr>
            <td align="center" style="color: red"><strong>{{ App\Unity::findNameByCode($unity_one->code) }}</strong>
            </td>
        </tr>
    </table><br>
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
            <th style="color: blue"> @if($unity_one->code == "TDP22") Cantidad de agua @else CASO @endif</th>
        </tr>
        </thead>
        <tbody>
        @foreach($unity_datas[$unity_one->code] as $unity_data)
            @if($unity_one->code == "TDP22")
                <tr>
                    <td style="color: blue">{{ $unity_data->date }}</td>
                    <td style="color: blue">{{  $unity_data->unity->code  }}</td>
                    <td style="color: blue">@if($unity_data->patient_name == " ") {{ $unity_data->general_case }} @else {{ $unity_data->patient_name }} @endif</td>
                    <td style="color: blue">{{  $unity_data->pilot->name }}</td>
                    @if(App\User::getNameById($unity_data->asistant_id) != '')
                        <td style="color: blue">{{  $unity_data->asistant->name }}</td>
                    @else
                        <td style="color: blue">NINGUN ASISTENTE</td>
                    @endif
                    <td style="color: blue">{{  $unity_data->user->name }}</td>
                    <td style="color: blue">Q. {{ number_format($unity_data->patient_input , 2) }}
                        / {{ $unity_data->patient_phone }}</td>
                    <td style="color: blue">{{ $unity_data->patient_case }} / <p
                                style="color: green">{{ $unity_data->observations }}</p></td>
                    <td><strong style="color: blue">{{ $unity_data->kmout }}</strong></td>
                    <td><strong style="color: blue">{{ $unity_data->kmin }}</strong></td>
                    <td><strong style="color: blue">{{ $unity_data->water_spend }}</strong></td>
                </tr>
            @else
                <tr>
                    <td style="color: blue">{{ $unity_data->date }}</td>
                    <td style="color: blue">{{ $unity_data->unity->code }}</td>
                    <td style="color: blue">{{ $unity_data->patient_name }}</td>
                    <td style="color: blue">{{ $unity_data->pilot->name }}</td>
                    @if(App\User::getNameById($unity_data->asistant_id) != '')
                        <td style="color: blue">{{  $unity_data->asistant->name }}</td>
                    @else
                        <td style="color: blue">NINGUN ASISTENTE</td>
                    @endif
                    <td style="color: blue">{{ $unity_data->user->name }}</td>
                    <td style="color: blue">Q. {{ number_format($unity_data->patient_input , 2) }}
                        / {{ $unity_data->patient_phone }}</td>
                    <td style="color: blue">{{ $unity_data->patient_case }} / <p
                                style="color: green">{{ $unity_data->observations }}</p></td>
                    <td><strong style="color: blue">{{ $unity_data->kmout }}</strong></td>
                    <td><strong style="color: blue">{{ $unity_data->kmin }}</strong></td>
                    <td><strong style="color: blue">{{ $unity_data->general_case }}</strong></td>
                </tr>
            @endif
            <?php $kmtour = $unity_data->kmin - $km_first[$unity_one->code] ?>
        @endforeach
        </tbody>
    </table><br>
    <table>
        <tr>
            <td align="left" style="color: blue"><strong>TOTAL INGRESO POR
                    APORTES {{ App\Unity::findNameByCode($unity_one->code) }}: </strong></td>
            <td align="right" style="color: red"><strong>Q. {{ number_format($total_in[$unity_one->code], 2) }}</strong>
            </td>
        </tr>
        <tr>
            <td align="left" style="color: blue"><strong>KILOMETROS
                    RECORRIDOS {{ App\Unity::findNameByCode($unity_one->code) }}: </strong></td>
            <td align="right" style="color: red"><strong> @if(isset($kmtour)) {{ number_format($kmtour) }} @else
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
                    <td><strong style="color: blue">TOTAL INGRESOS {{ $unity_one->name }}:</strong></td>
                    <td><strong style="color: blue">Q. {{ number_format($total_in[$unity_one->code], 2) }}</strong></td>
                </tr>
            @endforeach
            <tr>
                <td><strong style="color: red">TOTAL: </strong></td>
                <td><strong style="color: red">Q. {{ number_format($total_in_all, 2) }}</strong></td>
            </tr>
        </table>
    </div>
</div>
