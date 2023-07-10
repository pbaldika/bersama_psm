@extends('layouts.admin')
@section('content')


    <section class="content">
        <!-- Main content -->
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> Bersama
                        <small class="float-right">Date: {{ now()->toDateString() }}</small>
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
                    <b>ID Order:</b> {{ $funding->id }}<br>
                    <b>Tanggal Permintaan: {{ $funding->start_date }}<br>
                        @if ($funding->status != 'selesai')
                            <b>Tanggal Pengiriman: </b> Belum Terkirimkan<br>
                        @elseif($funding->status == 'selesai')
                            <b>Tanggal Pengiriman: </b> {{ $funding->end_date->format('Y-m-d') }}<br>
                        @endif
                </div>
                <!-- /.col -->
                <div class="col invoice-col">
                    @if ($funding->status == 'request')
                        <form method="post" action="{{ route('admin.funding.verify', $funding) }}">
                            @csrf
                            @method('PUT')
                            <button name="status" type="submit" class="btn btn-success btn-lg btn-flat"
                                value="active">Verifikasi</button>
                            <button name="status" type="submit" class="btn btn-danger btn-lg btn-flat"
                                value="denied">Tolak</button>
                        </form>
                    @elseif($funding->status == 'active')
                        <h2>Order User telah diterima</h2>
                    @elseif($funding->status == 'denied')
                        <h2>Order User telah ditolak!</h2>
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
                                <th>ID Order</th>
                                <th>Barang</th>
                                <th>Deskripsi</th>
                                <th>Informasi Tambahan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $funding->id }}</td>
                                <td>{{ $funding->customerOrder }}</td>
                                <td>{{ $funding->description }}</td>
                                @if (isset($funding->additional_info))
                                    <td>{{ $funding->additional_info }}</td>
                                @else
                                    <td>N/A</td>
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
                        @if (!isset($errorMessage))
                            s
                            <h3>Contoh Foto Order</h3>
                            <img src="data:image/jpeg;base64,{{ $imageData }}" class="product-image"
                                alt="User ID Photo">
                        @endif
                    </div>
                </div>
                <!-- /.col -->

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
