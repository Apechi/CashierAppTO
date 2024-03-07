@php $editing = isset($permission) @endphp

<div class="row">
    <div class="col-sm-12">
        <label for="name" class="form-label">Name</label>
        <div class="input-group">
            <input type="text" name="name" id="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', ($editing ? $permission->name : '')) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group col-sm-12 mt-4">
        <h4>Assign @lang('crud.roles.name')</h4>

        @foreach ($roles as $role)
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="role{{ $role->id }}"
                        name="roles[]" value="{{ $role->id }}"
                        {{ isset($permission) ? ($role->hasPermissionTo($permission) ? 'checked' : '') : '' }}>
                    <label class="form-check-label" for="role{{ $role->id }}">
                        {{ ucfirst($role->name) }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>
