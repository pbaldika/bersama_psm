@extends('layouts.invoice')
@section('content')
    <section class="content">
        @if (isset($errorMessage))
            <div class="alert alert-danger">
                {{ $errorMessage }}
            </div>
        @endif
        <!-- Main content -->
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fa fa-globe"></i> Bersama
                        <small class="float-right">Tanggal: {{ now()->toDateString() }}</small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <strong>Dari</strong>
                    <address>
                        PT. Berkah Hasanah Bisa Bersama<br>
                        Vila Nusa Indah Blok S6/10<br>
                        Kab. Bogor, Jawa Barat<br>
                        Telefon: (62) 81288215165<br>
                        Email: bersama@gmail.com
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <strong>Untuk</strong>
                    <address>
                        <strong>{{ Auth::user()->name }}</strong><br>
                        {{ Auth::user()->address }}<br>
                        Telefon: {{ Auth::user()->telephone }}<br>
                        Email: {{ Auth::user()->email }}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice: </b> {{ $invoice->id }}<br>
                    <br>
                    <b>ID Investasi:</b> {{ $investment->id }}<br>
                    @if ($investment->payment_proof == null)
                        <b>Tanggal Pembayaran: </b>Belum Terbayar<br>
                    @else
                        <b>Tanggal Payment Made: </b> {{ $investment->updated_at->format('Y-m-d') }}<br>
                    @endif
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    @if ($investment->status == 'request' && $investment->payment_proof != null)
                        <form method="post" action="{{ route('admin.investment.verify', $investment) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="project_id" id="project_id" value={{ $project->id }}>
                            <button name="status" type="submit" class="btn btn-success btn-lg btn-flat"
                                value="active">Verifikasi</button>
                            <button name="status" type="submit" class="btn btn-danger btn-lg btn-flat"
                                value="denied">Tolak</button>
                        </form>
                    @elseif($investment->status == 'active')
                        <h2>Investasi User telah diterima</h2>
                    @elseif($investment->status == 'denied')
                        <h2>Investasi User telah ditolak!</h2>
                    @endif
                </div>
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID Projek</th>
                                    <th>Projek</th>
                                    <th>Total Investasi</th>
                                    <th>Total Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>Rp. {{ number_format($investment->total, 0, '.', '.') }}</td>
                                    @if ($investment->profit == null)
                                        <td>Projek Masih Berlanjut</td>
                                    @else
                                        <td>Rp. {{ number_format($investment->profit, 0, '.', '.') }}</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-sm-6">
                    <div class="mb-2 mt-2">
                        @if (!isset($investment->payment_proof))
                            <h3>Foto Bukti Pembayaran Belum Diupload</h3>
                        @else
                            <h3>Foto Bukti Pembayaran</h3>
                            <img src="data:image/jpeg;base64,{{ $imageData }}" class="product-image"
                                alt="User ID Photo">
                        @endif
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <p class="lead">Detail Investasi</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Total Pemasukan Projek:</th>
                                @if (!isset($project->profit))
                                    <td>Projek Belum Memiliki Keuntungan</td>
                                @else
                                    <td>Rp. {{ number_format($project->profit, 0, '.', '.') }}</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Margin Investor</th>
                                <td>{{ $project->profit_margin_investor }}%</td>
                            </tr>
                            <tr>
                                <th>Total Keuntungan Semua Investor ({{ $project->profit_margin_investor }} %)</th>
                                @php
                                    $profit_all_investor = ($project->profit_margin_investor / 100) * $project->profit;
                                @endphp
                                @if (!isset($project->profit))
                                    <td>Semua Investor Belum Memiliki Keuntungan</td>
                                @else
                                    <td>{{ $profit_all_investor }}</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Total Keuntungan Investor </th>
                                @if (!isset($project->profit))
                                    <td>Investor Belum Memiliki Keuntungan</td>
                                @else
                                    <td>Rp. {{ number_format($investment->profit, 0, '.', '.') }}</td>
                                @endif
                            </tr>
                            <tr>
                                <th>
                                    <a href="{{ route('print-invoice', $investment->id) }}" rel="noopener" target="_blank"
                                        class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                                </th>
                                <th>
                                    <a href="{{ route('generate-invoice', $investment->id) }}"rel="noopener"
                                        class="btn btn-primary">
                                        <i class="fa fa-download"></i> Download
                                    </a>
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.invoice -->
    </section>
    <!-- /.content -->
@endsection
