@extends('appLayout.app')

@section('content')
    <div class="container">

        <div class="searchbar mt-0 mb-4">
            <div class="d-flex justify-content-end">

                <div class="text-right">
                    <a href="" class="btn btn-dark">
                        <i class="bi bi-file-pdf"></i> @lang('crud.common.export.pdf')
                    </a>
                    <a href="" class="btn btn-dark">
                        <i class="bi bi-file-excel"></i> @lang('crud.common.export.excel')
                    </a>

                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.transaction.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table id="tableBooking" class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.transaction.inputs.id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.transaction.inputs.date')
                                </th>
                                <th class="text-left">
                                    @lang('crud.transaction.inputs.customer')
                                </th>
                                <th class="text-left">
                                    @lang('crud.transaction.inputs.payment_method')
                                </th>
                                <th class="text-left">
                                    @lang('crud.transaction.inputs.keterangan')
                                </th>
                                <th class="text-right">
                                    @lang('crud.transaction.inputs.total_price')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->id ?? '-' }}</td>
                                    <td>{{ $transaction->date ?? '-' }}</td>
                                    <td>{{ $transaction->customer->name ?? '-' }}</td>
                                    <td>{{ $transaction->payment_method ?? '-' }}</td>
                                    <td>{{ $transaction->keterangan ?? '-' }}</td>
                                    <td>{{ $transaction->total_price ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group d-flex gap-2">
                                            @can('view', $transaction)
                                                <a href="/transaction/show/{{ $transaction->id }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                <a class="buka-invoice" data-no_invoice="{{ $transaction->id ?? '' }}">
                                                    <button type="button" class="btn btn-primary">
                                                        <i class="bi bi-receipt"></i>
                                                    </button>
                                                </a>
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




        $('.buka-invoice').click(function(e) {


            let no_faktur = $(this).data('no_invoice');

            window.open("/transaksi/invoice/" + no_faktur, "_blank",
                "width=500px,height=700px");

        });
    </script>
@endpush
