@php $editing = isset($menu) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="name" label="Nama" :value="old('name', $editing ? $menu->name : '')" maxlength="255" placeholder="Nama Menu"
            required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number name="price" label="Harga" :value="old('price', $editing ? $menu->price : '')" step="0.01" placeholder="Harga Menu"
            required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <div x-data="imageViewer('{{ $editing && $menu->image ? \Storage::url($menu->image) : '' }}')">
            <x-inputs.partials.label name="image" label="Gambar Menu"></x-inputs.partials.label><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img :src="imageUrl" class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;" />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div class="border rounded border-gray-200 bg-gray-100" style="width: 100px; height: 100px;"></div>
            </template>

            <div class="mt-2">
                <input type="file" name="image" id="image" @change="fileChosen" />
            </div>

            @error('image')
                @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="description" label="Deskripsi" maxlength="255"
            required>{{ old('description', $editing ? $menu->description : '') }}</x-inputs.textarea>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="type_id" label="Tipe Menu" required>
            @php $selected = old('type_id', ($editing ? $menu->type_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Silahkan Piliih Tipe dari Menu ini</option>
            @foreach ($types as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
