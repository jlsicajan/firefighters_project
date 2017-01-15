<style>
    table {
        border-collapse: collapse;
    }

    table, td, th {
        border: 1px solid blue;
    }

    h2{
        color: green;
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
        <th style="color: blue">Fecha</th>
        <th style="color: blue">No. factura</th>
        <th style="color: blue">Gastado</th>
        <th style="color: blue">Oficial que reporta</th>
        <th style="color: blue">Nota</th>
    </tr>
    </thead>
    <tbody>
    @foreach(json_decode($station_spends) as $station_spend)
        <tr>
            <td style="color: blue">{{ $station_spend->date }}</td>
            <td style="color: blue">{{ $station_spend->bill_number }}</td>
            <td style="color: blue">Q. {{ number_format($station_spend->station_spend, 2) }}</td>
            <td style="color: blue">{{  App\User::getNameById($station_spend->user_id) }}</td>
            <td style="color: blue">{{ $station_spend->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div id="details" class="clearfix">
    <div id="invoice">
        <h2>TOTAL EGRESOS EN LA ESTACION: Q. {{ number_format($total_station_general, 2) }}</h2>
    </div>
</div>
