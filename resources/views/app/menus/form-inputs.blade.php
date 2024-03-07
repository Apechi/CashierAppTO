@php $editing = isset($menu) @endphp

<div class="row">
    <div class="col-sm-12">
        <label for="name" class="form-label">Nama</label>
        <div class="input-group">
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                maxlength="255" value="{{ old('name', $editing ? $menu->name : '') }}" placeholder="Nama Menu" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <label for="price" class="form-label">Harga</label>
        <div class="input-group">
            <input type="number" name="price" id="price"
                class="form-control @error('price') is-invalid @enderror" step="0.01"
                value="{{ old('price', $editing ? $menu->price : '') }}" placeholder="Harga Menu" required>
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <label for="image" class="form-label">Gambar Menu</label>
        <div class="input-group">
            <input type="file" name="image" id="image"
                class="form-control @error('image') is-invalid @enderror" @change="fileChosen">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mt-2">
            @if ($editing && $menu->image)
                <img src="{{ \Storage::url($menu->image) }}" class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;" />
            @else
                <div class="border rounded border-gray-200 bg-gray-100" style="width: 100px; height: 100px;"></div>
            @endif
        </div>
    </div>

    <div class="col-sm-12">
        <label for="description" class="form-label">Deskripsi</label>
        <div class="input-group">
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                maxlength="255" required>{{ old('description', $editing ? $menu->description : '') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <label for="type_id" class="form-label">Tipe Menu</label>
        <div class="input-group">
            <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror" required>
                <option disabled {{ empty(old('type_id', $editing ? $menu->type_id : '')) ? 'selected' : '' }}>
                    Silahkan Pilih Tipe dari Menu ini
                </option>
                @foreach ($types as $value => $label)
                    <option value="{{ $value }}"
                        {{ old('type_id', $editing ? $menu->type_id : '') == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('type_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
