@php $editing = isset($booking) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="bookers_name" label="Nama Pemesan" :value="old('bookers_name', $editing ? $booking->bookers_name : '')" placeholder="Nama Pemesan"
            required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date name="date" label="Tanggal Booking"
            value="{{ old('date', $editing ? optional($booking->date)->format('Y-m-d') : '') }}"
            required></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="table_id" label="Meja" required>
            @php $selected = old('table_id', ($editing ? $booking->table_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>SIlahkan Pilih Meja yang Ingin Di Pesan</option>
            @foreach ($tables as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <div class="col-sm-12">
        <label for="start_time" class="form-label">Jam Mulai</label>
        <div class="input-group">
            <input type="time" name="start_time" id="start_time"
                class="form-control @error('start_time') is-invalid @enderror"
                value="{{ old('start_time', $editing ? $booking->start_time : '') }}" placeholder="Start Time" required>
            @error('start_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <label for="end_time" class="form-label">Jam Akhir</label>
        <div class="input-group d-flex flex-row">
            <input type="time" name="end_time" id="end_time"
                class="form-control @error('end_time') is-invalid @enderror"
                value="{{ old('end_time', $editing ? $booking->end_time : '') }}" placeholder="End Time" required>
            @error('end_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number name="total_customer" label="Total Pelanggan" :value="old('total_customer', $editing ? $booking->total_customer : '')" max="255"
            placeholder="Total Pelanggan" required></x-inputs.number>
    </x-inputs.group>
</div>
