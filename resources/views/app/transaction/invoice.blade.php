<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <title>{{ $data->id }}</title>
    <style>
        body {
            margin-top: 20px;
            background-color: #eee;
        }

        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: 1rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <h4 class="float-end font-size-15">Nota: #{{ $data->id }} </h4>
                            <div class="mb-4">
                                <h2 class="mb-1 text-muted">Apechi Cafe</h2>
                            </div>
                            <div class="text-muted">
                                <p class="mb-1">Gang Tempest, Blok G3 No 4</p>
                                <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i>{{ Auth()->user()->name }}
                                </p>
                                <p><i class="uil uil-phone me-1"></i> {{ Auth()->user()->email }}</p>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-6">
                                <div class="text-muted">
                                    <h5 class="font-size-16 mb-3">Ditagihkan Ke:</h5>
                                    <h5 class="font-size-15 mb-2">
                                        Nama:
                                        {{ $data->customer->name == 'umum' ? 'Pelanggan Umum' : $data->customer->name }}
                                    </h5>
                                    @if ($data->customer->name != 'umum')
                                        <p class="mb-1">Alamat: {{ $data->customer->address }}</p>
                                        <p class="mb-1">Email: {{ $data->customer->email }}</p>
                                        <p>No Telp: {{ $data->customer->no_telp }}</p>
                                    @endif
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-6">
                                <div class="text-muted text-sm-end">
                                    <div>
                                        <h5 class="font-size-15 mb-1">Nomor Faktur:</h5>
                                        <p>#{{ $data->id }}</p>
                                    </div>
                                    <div class="mt-4">
                                        <h5 class="font-size-15 mb-1">Tanggal Pembelian:</h5>
                                        <p>{{ \Carbon\Carbon::parse($data->date)->format('d M Y') }}</p>
                                    </div>

                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="py-2">
                            <h5 class="font-size-15">Order Summary</h5>

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
                                        @foreach ($data->transactionDetails as $item)
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
                                    {{ $data->total_price }}
                                </h4>
                            </div>


                            <div class="d-print-none mt-4">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success me-1"><i
                                            class="fa fa-print">Print</i></a>
                                    <a href="#" class="btn btn-primary w-md">Send</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
    </div>
</body>

</html>
