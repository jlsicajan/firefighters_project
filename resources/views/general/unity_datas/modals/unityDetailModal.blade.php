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