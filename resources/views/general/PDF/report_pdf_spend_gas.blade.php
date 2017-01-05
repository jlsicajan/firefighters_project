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
        <th>Unidad</th>
        <th>No. factura</th>
        <th>Gasolinera</th>
        <th>Gastado</th>
        <th>Oficial que reporta</th>
        <th>Nota</th>
    </tr>
    </thead>
    <tbody>
    @foreach(json_decode($gas_spends) as $gas_spend)
        <tr>
            <td>{{ $gas_spend->date }}</td>
            <td>{{  App\Unity::getNameById($gas_spend->unity_id) }}</td>
            <td>{{ $gas_spend->bill_number }}</td>
            <td>{{ $gas_spend->gas_name }}</td>
            <td>Q. {{ number_format($gas_spend->gas_spend, 2) }}</td>
            <td>{{  App\User::getNameById($gas_spend->user_id) }}</td>
            <td>{{ $gas_spend->note_gas }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div id="details" class="clearfix">
    <div id="invoice">
        <h2>TOTAL GASTADO EN COMBUSTIBLE: Q. {{ number_format($total_gas_general, 2) }}</h2>
    </div>
</div>