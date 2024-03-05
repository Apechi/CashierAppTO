@extends('appLayout.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('tables.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    @lang('crud.tables.show_title')
                </h4>

                <div class="mt-4">
                    <div class="mb-4">
                        <h5>@lang('crud.tables.inputs.table_number')</h5>
                        <span>{{ $table->table_number ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.tables.inputs.capacity')</h5>
                        <span>{{ $table->capacity ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.tables.inputs.status')</h5>
                        <span>{{ $table->status ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('tables.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Table::class)
                        <a href="{{ route('tables.create') }}" class="btn btn-light">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
