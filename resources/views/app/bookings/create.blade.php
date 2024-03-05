@extends('appLayout.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('bookings.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    @lang('crud.bookings.create_title')
                </h4>

                <form method="POST" action="{{ route('bookings.store') }}" class="mt-4">
                    @csrf
                    @include('app.bookings.form-inputs')

                    <div class="mt-4">
                        <a href="{{ route('bookings.index') }}" class="btn btn-light">
                            <i class="icon ion-md-return-left text-primary"></i>
                            @lang('crud.common.back')
                        </a>

                        <button type="submit" class="btn btn-primary float-right">
                            <i class="icon ion-md-save"></i>
                            @lang('crud.common.create')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
