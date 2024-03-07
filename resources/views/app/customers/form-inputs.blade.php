@php $editing = isset($customer) @endphp

<div class="row">
    <div class="col-sm-12">
        <label for="name" class="form-label">Nama</label>
        <div class="input-group">
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                maxlength="255" value="{{ old('name', $editing ? $customer->name : '') }}" placeholder="Nama Pelanggan"
                required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <label for="email" class="form-label">Email</label>
        <div class="input-group">
            <input type="email" name="email" id="email"
                class="form-control @error('email') is-invalid @enderror" maxlength="255"
                value="{{ old('email', $editing ? $customer->email : '') }}" placeholder="Email Pelanggan" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <label for="no_telp" class="form-label">No Telp</label>
        <div class="input-group">
            <input type="number" name="no_telp" id="no_telp"
                class="form-control @error('no_telp') is-invalid @enderror"
                value="{{ old('no_telp', $editing ? $customer->no_telp : '') }}" placeholder="No Telp" required>
            @error('no_telp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12">
        <label for="address" class="form-label">Alamat</label>
        <div class="input-group">
            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" maxlength="255"
                required>{{ old('address', $editing ? $customer->address : '') }}</textarea>
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
