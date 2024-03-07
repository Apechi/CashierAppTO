@php $editing = isset($table) @endphp

<div class="row">
    <div class="col-sm-12">
        <label for="table_number" class="form-label">Nomor Meja</label>
        <div class="input-group">
            <input type="number" name="table_number" id="table_number"
                class="form-control @error('table_number') is-invalid @enderror"
                value="{{ old('table_number', $editing ? $table->table_number : '') }}" max="255"
                placeholder="Nomor Meja" required>
            @error('table_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <label for="capacity" class="form-label">Kapasitas</label>
        <div class="input-group">
            <input type="number" name="capacity" id="capacity"
                class="form-control @error('capacity') is-invalid @enderror"
                value="{{ old('capacity', $editing ? $table->capacity : '') }}" max="255"
                placeholder="Kapasitas Meja" required>
            @error('capacity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <label for="status" class="form-label">Status Meja</label>
        <div class="input-group">
            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                <option value="isi" {{ old('status', $editing ? $table->status : '') == 'isi' ? 'selected' : '' }}>
                    Isi</option>
                <option value="kosong"
                    {{ old('status', $editing ? $table->status : '') == 'kosong' ? 'selected' : '' }}>Kosong</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
