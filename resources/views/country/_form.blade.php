<div>
    <label>Код:</label><br>
    <input type="text" name="code" maxlength="2" value="{{ old('code', $country->code ?? '') }}">
    @error('code') <p style="color:red">{{ $message }}</p> @enderror
</div>
<div>
    <label>Назва:</label><br>
    <input type="text" name="name" value="{{ old('name', $country->name ?? '') }}">
    @error('name') <p style="color:red">{{ $message }}</p> @enderror
</div>
<div>
    <label>Населення:</label><br>
    <input type="number" name="population" value="{{ old('population', $country->population ?? 0) }}">
    @error('population') <p style="color:red">{{ $message }}</p> @enderror
</div><br>
