@extends('layouts.admin')
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
                        <i class="fas fa-globe"></i> Bersama
                        <small class="float-right">Date: {{now()->toDateString()}}</small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Dari
                    <address>
                        <strong>PT. Berkah Hasanah Bisa Bersama</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        Telefon: (804) 123-5432<br>
                        Email: info@almasaeedstudio.com
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    Untuk
                    <address>
                        <strong>{{ $user->name }}</strong><br>
                        {{ $user->address }}<br>
                        Telefon: {{ $user->telephone }}<br>
                        Email: {{ $user->email }}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice </b><br>
                    <br>
                    <b>ID Investasi:</b> {{ $investment->id }}<br>
                    @if ($investment->payment_proof == null)
                        <b>Tanggal Pembayaran: </b>N/A<br>
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
                <div class="col-12 table-responsive">
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
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <div class="col-12 mb-2 mt-2">
                        <h3>Foto Bukti Pembayaran</h3>
                        <img src="data:image/jpeg;base64,{{ $imageData }}" class="product-image" alt="User ID Photo">
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <p class="lead">Detail Invetasi</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Total Pemasukan Projek:</th>
                                <td>Rp. {{ number_format($project->profit, 0, '.', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Margin Investor</th>
                                <td>{{$project->profit_margin_investor}}%</td>
                            </tr>
                            <tr>
                                <th>Total Keuntungan Semua Investor ({{$project->profit_margin_investor}} %)</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Total Keuntungan Investor </th>
                                <td>Rp. {{ number_format($investment->profit, 0, '.', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                            class="fas fa-print"></i> Print</a>
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                        <i class="fas fa-download"></i> Generate PDF
                    </button>
                </div>
            </div>
        </div>
        <!-- /.invoice -->
        </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@stop
