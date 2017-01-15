<form class="form-inline">
    <div class="form-group">
        <label for="date">Fecha</label>
        <input size="20" class="form-control" id="date" type="text" value="{{ $unity_data->date }}" disabled>
    </div>
    <div class="form-group">
        <label for="unity">Unidad</label>
        <input size="10" class="form-control" id="unity" type="text" value="{{  App\Unity::getNameById($unity_data->unity_id) }}" disabled>
    </div>
    <div class="form-group">
        <label for="user_id">Oficial que reporta</label>
        <input size="30" class="form-control" id="user_id" type="text" value="{{  App\User::getNameById($unity_data->user_id) }}" disabled>
    </div>
</form>
<form action="#" autocomplete="off" method="POST" id="form_collections">
    <div class="col-xs-4">

    </div>
    <div class="col-xs-2">

    </div>
    <div class="col-xs-3">

    </div>
    <div class="form-group">
        <label for="quantity">Cuanto se recaudo (Q)</label>
        <input type="number" class="form-control" name="quantity" id="quantity" required/>
    </div>
    <div class="form-group">Breve desripcion</label>
        <textarea class="form-control" id="station_description" name="station_description"
                  required rows="8"></textarea>
    </div>
</form>