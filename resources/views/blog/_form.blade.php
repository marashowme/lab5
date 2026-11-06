<div style="margin-bottom: 15px;">
    <label for="title" style="display:block; font-weight:bold;">Заголовок</label>
    <input type="text" id="title" name="title" value="{{ old('title', $blog->title ?? '') }}" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
    @error('title')
    <p style="color:red; margin:4px 0 0;">{{ $message }}</p>
    @enderror
</div>

<div style="margin-bottom: 15px;">
    <label for="category_id" style="display:block; font-weight:bold;">Категорія</label>
    <select id="category_id" name="category_id" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
        <option value="">- Без категорії -</option>
        @foreach ($categories as $id => $name)
            <option value="{{ $id }}" @selected(old('category_id', $blog->category_id ?? '') == $id)>
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
    <p style="color:red; margin:4px 0 0;">{{ $message }}</p>
    @enderror
</div>

<div style="margin-bottom: 15px;">
    <label for="description" style="display:block; font-weight:bold;">Короткий опис</label>
    <textarea id="description" name="description" rows="3" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">{{ old('description', $blog->description ?? '') }}</textarea>
    @error('description')
    <p style="color:red; margin:4px 0 0;">{{ $message }}</p>
    @enderror
</div>

<div style="margin-bottom: 15px;">
    <label for="text" style="display:block; font-weight:bold;">Повний текст</label>
    <textarea id="text" name="text" rows="6" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">{{ old('text', $blog->text ?? '') }}</textarea>
    @error('text')
    <p style="color:red; margin:4px 0 0;">{{ $message }}</p>
    @enderror
</div>
