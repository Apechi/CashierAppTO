@extends('appLayout.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('menus.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    @lang('crud.menus.edit_title')
                </h4>

                <form method="POST" action="{{ route('menus.update', $menu) }}" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    @method('PUT')
                    @include('app.menus.form-inputs')

                    <div class="mt-4">
                        <a href="{{ route('menus.index') }}" class="btn btn-light">
                            <i class="icon ion-md-return-left text-primary"></i>
                            @lang('crud.common.back')
                        </a>

                        <a href="{{ route('menus.create') }}" class="btn btn-light">
                            <i class="icon ion-md-add text-primary"></i>
                            @lang('crud.common.create')
                        </a>

                        <button type="submit" class="btn btn-primary float-right">
                            <i class="icon ion-md-save"></i>
                            @lang('crud.common.update')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
