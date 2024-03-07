@php $editing = isset($role) @endphp

<div class="row">
    <div class="col-sm-12">
        <label for="name" class="form-label">Name</label>
        <div class="input-group">
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $editing ? $role->name : '') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group col-sm-12 mt-4">
        <h4>Assign @lang('crud.permissions.name')</h4>

        @foreach ($permissions as $permission)
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="permission{{ $permission->id }}"
                        name="permissions[]" value="{{ $permission->id }}"
                        {{ isset($role) ? ($role->hasPermissionTo($permission) ? 'checked' : '') : '' }}>
                    <label class="form-check-label" for="permission{{ $permission->id }}">
                        {{ ucfirst($permission->name) }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
</div>
