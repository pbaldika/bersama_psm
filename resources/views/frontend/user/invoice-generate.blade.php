<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bersama</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ public_path('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ public_path('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ public_path('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ public_path('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ public_path('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ public_path('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ public_path('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ public_path('plugins/summernote/summernote-bs4.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
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

    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ public_path('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ public_path('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ public_path('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ public_path('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ public_path('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ public_path('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ public_path('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ public_path('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ public_path('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ public_path('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ public_path('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ public_path('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ public_path('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ public_path('dist/js/adminlte.js') }}"></script>
    {{-- <!-- AdminLTE for demo purposes -->
  <script src="{{public_path('dist/js/demo.js')}}"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ public_path('dist/js/pages/dashboard.js') }}"></script>
</body>

</html>
