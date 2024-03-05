@extends('appLayout.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('transaction.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                    @lang('crud.transaction.show_title')
                </h4>

                <div class="mt-4">
                    <div class="row">
                        <div class="left col-6">
                            <div class="mb-4">
                                <h5>@lang('crud.transaction.inputs.id')</h5>
                                <span>{{ $transaction->id ?? '-' }}</span>
                            </div>
                            <div class="mb-4">
                                <h5>@lang('crud.transaction.inputs.date')</h5>
                                <span>{{ $transaction->date ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="right col-6">
                            <div class="mb-4">
                                <h5>@lang('crud.transaction.inputs.customer')</h5>
                                <span>{{ $transaction->customer->name ?? '-' }}</span>
                            </div>
                            <div class="mb-4">
                                <h5>@lang('crud.transaction.inputs.payment_method')</h5>
                                <span>{{ $transaction->payment_method ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h5>@lang('crud.transaction.inputs.keterangan')</h5>
                        <span>{{ $transaction->keterangan ?? '-' }}</span>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap table-centered mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 70px;">No.</th>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th class="text-end" style="width: 120px;">Total</th>
                                </tr>
                            </thead><!-- end thead -->
                            <tbody>
                                @foreach ($transaction->transactionDetails as $item)
                                    <tr>
                                        <th scope="row">0{{ $loop->index + 1 }}</th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14 mb-1">
                                                    {{ $item->menu->name }}
                                                </h5>
                                                <p class="text-muted mb-0">{{ $item->menu->description }}</p>
                                            </div>
                                        </td>
                                        <td>Rp. {{ $item->unitPrice }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td class="text-end">Rp. {{ $item->subTotal }}</td>
                                    </tr>
                                @endforeach
                                <!-- end tr -->



                                <!-- end tr -->

                                <!-- end tr -->
                            </tbody><!-- end tbody -->
                        </table><!-- end table -->
                    </div><!-- end table responsive -->
                    <div class="total d-flex gap-4 m-3 justify-content-end">
                        <h4 class="border-0 text-end">Total: </h4>
                        <h4 class="m-0 fw-semibold text-end" colspan="3">Rp
                            {{ $transaction->total_price }}
                        </h4>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="/transaction/index" class="btn btn-light">
                        <i class="icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    <a id="buka-invoice" data-no_faktur="{{ $transaction->id }}" class="btn btn-primary">
                        <i class="bi bi-receipt"></i>
                        Buka Invoice
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#buka-invoice').click(function(e) {
            let no_faktur = $(this).data('no_faktur');

            window.open("/transaksi/invoice/" + no_faktur, "_blank",
                "width=500px,height=700px");
        });
    </script>
@endpush
