@extends('appLayout.app')

@section('content')
    <div class="container">
        <div class=" mt-0 mb-4">
            <div class="d-flex justify-content-end">
                <div class=" text-right">
                    <a href="" class="btn btn-dark">
                        <i class="bi bi-file-pdf"></i> @lang('crud.common.export.pdf')
                    </a>
                    <a href="" class="btn btn-dark">
                        <i class="bi bi-file-excel"></i> @lang('crud.common.export.excel')
                    </a>
                    <a href="" class="btn btn-warning">
                        <i class="bi bi-file-excel"></i> @lang('crud.common.import')
                    </a>
                    @can('create', App\Models\Menu::class)
                        <a href="{{ route('menus.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.menus.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table id="tableMenu" class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.menus.inputs.name')
                                </th>
                                <th class="text-left">
                                    @lang('crud.menus.inputs.price')
                                </th>
                                <th class="text-left">
                                    @lang('crud.menus.inputs.image')
                                </th>
                                <th class="text-left">
                                    @lang('crud.menus.inputs.description')
                                </th>
                                <th class="text-left">
                                    @lang('crud.menus.inputs.type_id')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($menus as $menu)
                                <tr>
                                    <td>{{ $menu->name ?? '-' }}</td>
                                    <td>{{ $menu->price ?? '-' }}</td>
                                    <td>
                                        <x-partials.thumbnail src="{{ $menu->image ? \Storage::url($menu->image) : '' }}" />
                                    </td>
                                    <td>{{ $menu->description ?? '-' }}</td>
                                    <td>{{ optional($menu->type)->name ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $menu)
                                                <a href="{{ route('menus.edit', $menu) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $menu)
                                                <a href="{{ route('menus.show', $menu) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $menu)
                                                <form action="{{ route('menus.destroy', $menu) }}" method="POST"
                                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-light text-danger">
                                                        <i class="icon ion-md-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tableMenu').DataTable();
        });
    </script>
@endpush
