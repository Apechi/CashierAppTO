@php $editing = isset($booking) @endphp

<div class="row">
    <div class="col-sm-12">
        <label for="bookers_name" class="form-label">Nama Pemesan</label>
        <div class="input-group">
            <input type="text" name="bookers_name" id="bookers_name"
                class="form-control @error('bookers_name') is-invalid @enderror"
                value="{{ old('bookers_name', $editing ? $booking->bookers_name : '') }}" placeholder="Nama Pemesan"
                required>
            @error('bookers_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <label for="date" class="form-label">Tanggal Booking</label>
        <div class="input-group">
            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror"
                value="{{ old('date', $editing ? optional($booking->date)->format('Y-m-d') : '') }}" required>
            @error('date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <label for="table_id" class="form-label">Meja</label>
        <div class="input-group">
            <select name="table_id" id="table_id" class="form-select @error('table_id') is-invalid @enderror" required>
                <option disabled {{ empty(old('table_id', $editing ? $booking->table_id : '')) ? 'selected' : '' }}>
                    Silahkan Pilih Meja yang Ingin Di Pesan
                </option>
                @foreach ($tables as $value => $label)
                    <option value="{{ $value }}"
                        {{ old('table_id', $editing ? $booking->table_id : '') == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('table_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

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
        <div class="input-group">
            <input type="time" name="end_time" id="end_time"
                class="form-control @error('end_time') is-invalid @enderror"
                value="{{ old('end_time', $editing ? $booking->end_time : '') }}" placeholder="End Time" required>
            @error('end_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <label for="total_customer" class="form-label">Total Pelanggan</label>
        <div class="input-group">
            <input type="number" name="total_customer" id="total_customer"
                class="form-control @error('total_customer') is-invalid @enderror"
                value="{{ old('total_customer', $editing ? $booking->total_customer : '') }}"
                placeholder="Total Pelanggan" required>
            @error('total_customer')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
