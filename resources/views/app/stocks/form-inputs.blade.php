@php $editing = isset($stock) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="menu_id" label="Pilih Menu" required>
            @php $selected = old('menu_id', ($editing ? $stock->menu_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Silahkan Pilih Menu</option>
            @foreach ($menus as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number name="quantity" label="Kuantitas" :value="old('quantity', $editing ? $stock->quantity : '')" placeholder="Kuantitas Menu"
            required></x-inputs.number>
    </x-inputs.group>
</div>
