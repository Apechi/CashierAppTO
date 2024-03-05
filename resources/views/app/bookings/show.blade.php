@extends('appLayout.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('bookings.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    @lang('crud.bookings.show_title')
                </h4>

                <div class="mt-4">
                    <div class="mb-4">
                        <h5>@lang('crud.bookings.inputs.bookers_name')</h5>
                        <span>{{ $booking->bookers_name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.bookings.inputs.date')</h5>
                        <span>{{ $booking->date ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.bookings.inputs.table_id')</h5>
                        <span>{{ optional($booking->table)->id ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.bookings.inputs.start_time')</h5>
                        <span>{{ $booking->start_time ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.bookings.inputs.end_time')</h5>
                        <span>{{ $booking->end_time ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.bookings.inputs.total_customer')</h5>
                        <span>{{ $booking->total_customer ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('bookings.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Booking::class)
                        <a href="{{ route('bookings.create') }}" class="btn btn-light">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
