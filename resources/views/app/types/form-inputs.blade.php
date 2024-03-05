<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="name" wire:model.lazy='name' label="Nama" placeholder="Nama Tipe"
            required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-5">
        <x-inputs.text name="icon" wire:model.lazy='icon' label="Icon" placeholder="font-awesome icon"
            required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="category_id" wire:model.lazy='category_id' label="Kategori" required>

            <option disabled {{ empty($selected) ? 'selected' : '' }}>Silahkan Pilih Kategorinya</option>
            @foreach ($categories as $value => $label)
                <option value="{{ $value }}">{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
