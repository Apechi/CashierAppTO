@php $editing = isset($type) @endphp

<div class="row">
    <div class="col-sm-12">
        <label for="name" class="form-label">Nama</label>
        <div class="input-group">
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                wire:model.lazy='name' value="{{ old('name', $editing ? $type->name : '') }}" placeholder="Nama Tipe"
                required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-lg-5">
        <label for="icon" class="form-label">Icon</label>
        <div class="input-group">
            <input type="text" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror"
                wire:model.lazy='icon' value="{{ old('icon', $editing ? $type->icon : '') }}"
                placeholder="font-awesome icon" required>
            @error('icon')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <label for="category_id" class="form-label">Kategori</label>
        <div class="input-group">
            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror"
                wire:model.lazy='category_id' required>
                <option disabled {{ empty(old('category_id', $editing ? $type->category_id : '')) ? 'selected' : '' }}>
                    Silahkan
                    Pilih Kategorinya</option>
                @foreach ($categories as $value => $label)
                    <option value="{{ $value }}"
                        {{ old('catetgory_id', $editing ? $type->catetgory_id : '') == $value ? 'selected' : '' }}>
                        {{ $label }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
