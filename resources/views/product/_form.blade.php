@php
    $translation = isset($product) ? $product->getTranslation('uk') : null;
@endphp

<div>
    <label>Назва:</label><br>
    <input type="text" name="name" value="{{ old('name', $translation->name ?? '') }}">
    @error('name') <p style="color:red">{{ $message }}</p> @enderror
</div>
<div>
    <label>Ціна:</label><br>
    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}">
    @error('price') <p style="color:red">{{ $message }}</p> @enderror
</div>
<div>
    <label>Опис:</label><br>
    <textarea name="description">{{ old('description', $translation->description ?? '') }}</textarea>
</div>
<div>
    <label>Кількість:</label><br>
    <input type="number" name="quantity" value="{{ old('quantity', $product->quantity ?? 0) }}">
    @error('quantity') <p style="color:red">{{ $message }}</p> @enderror
</div><br>

<div style="margin-bottom: 15px;">
    <label for="filters" style="display:block; font-weight:bold;">Мітки товару</label>
    <select id="filters" name="filters[]" multiple style="width:100%;">
        @foreach ($filters as $id => $name)
            <option value="{{ $id }}" @selected(in_array($id, old('filters', $selected ?? [])))>
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('filters') <p style="color:red; font-size:0.9em;">{{ $message }}</p> @enderror
    @error('filters.*') <p style="color:red; font-size:0.9em;">{{ $message }}</p> @enderror
</div>
