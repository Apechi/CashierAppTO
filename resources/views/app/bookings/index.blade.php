@extends('appLayout.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="d-flex justify-content-end">

                <div class="ctext-right">
                    <a href="pemesanan/exportpdf" class="btn btn-dark">
                        <i class="bi bi-file-pdf"></i> @lang('crud.common.export.pdf')
                    </a>
                    <a href="booking/export/" class="btn btn-dark">
                        <i class="bi bi-file-excel"></i> @lang('crud.common.export.excel')
                    </a>
                    <a href="" class="btn btn-warning">
                        <i class="bi bi-file-excel"></i> @lang('crud.common.import')
                    </a>
                    @can('create', App\Models\Booking::class)
                        <a href="{{ route('bookings.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.bookings.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table id="tableBooking" class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.bookings.inputs.bookers_name')
                                </th>
                                <th class="text-left">
                                    @lang('crud.bookings.inputs.date')
                                </th>
                                <th class="text-left">
                                    @lang('crud.bookings.inputs.table_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.bookings.inputs.start_time')
                                </th>
                                <th class="text-left">
                                    @lang('crud.bookings.inputs.end_time')
                                </th>
                                <th class="text-right">
                                    @lang('crud.bookings.inputs.total_customer')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->bookers_name ?? '-' }}</td>
                                    <td>{{ $booking->date ?? '-' }}</td>
                                    <td>{{ optional($booking->table)->id ?? '-' }}</td>
                                    <td>{{ $booking->start_time ?? '-' }}</td>
                                    <td>{{ $booking->end_time ?? '-' }}</td>
                                    <td>{{ $booking->total_customer ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $booking)
                                                <a href="{{ route('bookings.edit', $booking) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $booking)
                                                <a href="{{ route('bookings.show', $booking) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $booking)
                                                <form action="{{ route('bookings.destroy', $booking) }}" method="POST"
                                                    class="delete-form">
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
            $('#tableBooking').DataTable();
        });

        $('.delete-form').submit(function(event) {
            event.preventDefault(); // Prevent form submission

            Swal.fire({
                title: 'Are you sure?',
                text: "{{ __('crud.common.are_you_sure') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33', // Mengubah warna tombol konfirmasi menjadi merah
                cancelButtonColor: '#3085d6', // Mengubah warna tombol cancel menjadi biru
                confirmButtonText: 'Ya, Hapus item ini!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    $(this).unbind('submit').submit();
                }
            });
        });
    </script>
@endpush
