<div>
    <label>Назва:</label><br>
    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}">
    @error('name') <p style="color:red">{{ $message }}</p> @enderror
</div>
<div>
    <label>Ціна:</label><br>
    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}">
    @error('price') <p style="color:red">{{ $message }}</p> @enderror
</div>
<div>
    <label>Опис:</label><br>
    <textarea name="description">{{ old('description', $product->description ?? '') }}</textarea>
</div>
<div>
    <label>Кількість:</label><br>
    <input type="number" name="quantity" value="{{ old('quantity', $product->quantity ?? 0) }}">
</div><br>
