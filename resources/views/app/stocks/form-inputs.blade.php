@php $editing = isset($stock) @endphp

<div class="row">
    <div class="col-sm-12">
        <label for="menu_id" class="form-label">Pilih Menu</label>
        <div class="input-group">
            <select name="menu_id" id="menu_id" class="form-select @error('menu_id') is-invalid @enderror" required>
                <option disabled {{ empty(old('menu_id', $editing ? $stock->menu_id : '')) ? 'selected' : '' }}>
                    Silahkan Pilih Menu
                </option>
                @foreach ($menus as $value => $label)
                    <option value="{{ $value }}"
                        {{ old('menu_id', $editing ? $stock->menu_id : '') == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('menu_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <label for="quantity" class="form-label">Kuantitas</label>
        <div class="input-group">
            <input type="number" name="quantity" id="quantity"
                class="form-control @error('quantity') is-invalid @enderror"
                value="{{ old('quantity', $editing ? $stock->quantity : '') }}" placeholder="Kuantitas Menu" required>
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
