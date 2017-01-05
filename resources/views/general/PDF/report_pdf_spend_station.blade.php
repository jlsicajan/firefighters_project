<style>
    table {
        border-collapse: collapse;
    }

    table, td, th {
        border: 1px solid black;
    }
</style>
<div id="details" class="clearfix">
    <div id="invoice">
        <h1></h1>
        <div class="date"></div>
    </div>
</div>
<table>
    <thead>
    <tr>
        <th>Fecha</th>
        <th>No. factura</th>
        <th>Gastado</th>
        <th>Oficial que reporta</th>
        <th>Nota</th>
    </tr>
    </thead>
    <tbody>
    @foreach(json_decode($station_spends) as $station_spend)
        <tr>
            <td>{{ $station_spend->date }}</td>
            <td>{{ $station_spend->bill_number }}</td>
            <td>Q. {{ number_format($station_spend->station_spend, 2) }}</td>
            <td>{{  App\User::getNameById($station_spend->user_id) }}</td>
            <td>{{ $station_spend->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div id="details" class="clearfix">
    <div id="invoice">
        <h2>TOTAL GASTADO EN LA ESTACION: Q. {{ number_format($total_station_general, 2) }}</h2>
    </div>
</div>