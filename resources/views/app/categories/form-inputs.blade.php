@php $editing = isset($category) @endphp

<div class="row">
    <div class="col-sm-12">
        <div class="input-group mb-3">
            <span class="input-group-text">Nama</span>
            <input type="text" name="name" wire:model="name"
                value="{{ old('name', $editing ? $category->name : '') }}"
                class="form-control @error('name') is-invalid @enderror" maxlength="255" placeholder="Nama Tipe" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-12 col-lg-5">
        <div class="input-group mb-3">
            <span class="input-group-text">Icon</span>
            <input type="text" name="icon" wire:model="icon"
                value="{{ old('icon', $editing ? $category->icon : '') }}"
                class="form-control @error('icon') is-invalid @enderror" maxlength="255"
                placeholder="font-awesome/bootstrap icon" required>
            @error('icon')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
