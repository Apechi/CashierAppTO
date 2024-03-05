@extends('appLayout.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="d-flex justify-content-end">
                <div class="text-right">
                    <a href="" class="btn btn-dark">
                        <i class="bi bi-file-pdf"></i> @lang('crud.common.export.pdf')
                    </a>
                    <a href="type/export/" class="btn btn-dark">
                        <i class="bi bi-file-excel"></i> @lang('crud.common.export.excel')
                    </a>
                    <a href="" class="btn btn-warning">
                        <i class="bi bi-file-excel"></i> @lang('crud.common.import')
                    </a>
                    @can('create', App\Models\Type::class)
                        <a href="{{ route('types.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.types.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table id="tableType" class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.types.inputs.name')
                                </th>
                                <th class="text-left">
                                    @lang('crud.types.inputs.icon')
                                </th>
                                <th class="text-left">
                                    @lang('crud.types.inputs.category_id')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($types as $type)
                                <tr>
                                    <td>{{ $type->name ?? '-' }}</td>
                                    <td>
                                        <button type="none" class="btn btn-light">
                                            <i class="{{ $type->icon ?? '-' }}"></i>
                                        </button>
                                    </td>
                                    <td>
                                        {{ optional($type->category)->name ?? '-' }}
                                    </td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $type)
                                                <a href="{{ route('types.edit', $type) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $type)
                                                <a href="{{ route('types.show', $type) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $type)
                                                <form action="{{ route('types.destroy', $type) }}" method="POST"
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
            $('#tableType').DataTable();
        });
    </script>
@endpush
