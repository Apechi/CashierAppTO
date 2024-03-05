@php $editing = isset($customer) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="name" label="Nama" :value="old('name', $editing ? $customer->name : '')" maxlength="255" placeholder="Nama Pelanggan"
            required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.email name="email" label="Email" :value="old('email', $editing ? $customer->email : '')" maxlength="255" placeholder="Email Pelanggan"
            required></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number name="no_telp" label="No Telp" :value="old('no_telp', $editing ? $customer->no_telp : '')" placeholder="No Telp"
            required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="address" label="Alamat" maxlength="255"
            required>{{ old('address', $editing ? $customer->address : '') }}</x-inputs.textarea>
    </x-inputs.group>
</div>
