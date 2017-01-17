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
        <th style="color: blue">Unidad</th>
        <th style="color: blue">No. factura</th>
        <th style="color: blue">Gasolinera</th>
        <th style="color: blue">Gastado</th>
        <th style="color: blue">Oficial que reporta</th>
        <th style="color: blue">Nota</th>
    </tr>
    </thead>
    <tbody>
    @foreach(json_decode($gas_spends) as $gas_spend)
        <tr>
            <td style="color: blue">{{ $gas_spend->date }}</td>
            <td style="color: blue">{{  App\Unity::getNameById($gas_spend->unity_id) }}</td>
            <td style="color: blue">{{ $gas_spend->bill_number }}</td>
            <td style="color: blue">{{ $gas_spend->gas_name }}</td>
            <td style="color: blue">Q. {{ number_format($gas_spend->gas_spend, 2) }}</td>
            <td style="color: blue">{{  App\User::getNameById($gas_spend->user_id) }}</td>
            <td style="color: blue">{{ $gas_spend->note_gas }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div id="details" class="clearfix">
    <div id="invoice">
        <h2>TOTAL EGRESOS EN COMBUSTIBLE: Q. {{ number_format($total_gas_general, 2) }}</h2>
    </div>
</div>
