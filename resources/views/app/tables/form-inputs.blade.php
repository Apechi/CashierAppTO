@php $editing = isset($table) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="table_number"
            label="Nomor Meja"
            :value="old('table_number', ($editing ? $table->table_number : ''))"
            max="255"
            placeholder="Nomor Meja"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="capacity"
            label="Kapasitas"
            :value="old('capacity', ($editing ? $table->capacity : ''))"
            max="255"
            placeholder="Kapasitas Meja"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="status" label="Status Meja">
            @php $selected = old('status', ($editing ? $table->status : '')) @endphp
            <option value="isi" {{ $selected == 'isi' ? 'selected' : '' }} >Isi</option>
            <option value="kosong" {{ $selected == 'kosong' ? 'selected' : '' }} >Kosong</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
