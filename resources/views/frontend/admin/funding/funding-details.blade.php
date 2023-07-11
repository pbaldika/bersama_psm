@extends('layouts.admin')
@section('content')
    <section class="content">
        @if (session('message'))
            <h6 class="alert alert-success">
                {{ session('message') }}
            </h6>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img src="data:image/jpeg;base64,{{ $imageData }}" class="product-image"
                                    alt="funding picture">
                            </div>

                            <h3 class="profile-fundingname text-center">{{ $funding->funName }}</h3>


                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Keperluan Total</b> <a class="float-right text-primary">Rp.
                                        {{ number_format($funding->fund_required, 0, '.', '.') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Diajukan Oleh</b> <a class="float-right text-primary">
                                        {{ $user->name }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Tanggal Penyelesaian</b> <a class="float-right text-primary">
                                        {{ $funding->end_date }}</a>
                                </li>
                                @if ($funding->status == 'aktif')
                                    {{-- <li class="list-group-item">
                                        <b>Dana Terkumpulkan</b> <a class="float-right">Rp.
                                            {{ number_format($project->current_capital, 0, '.', '.') }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        @php
                                            $currentCapital = (float) $funding->current_capital;
                                            $requiredCapital = (float) $funding->required_capital;
                                            $value = ($currentCapital / $requiredCapital) * 100;
                                            
                                            $keperluan = $requiredCapital - $currentCapital;
                                        @endphp
                                        <div class="pt-1">
                                            <b>Dana Telah Terkumpulkan: {{ number_format($value, 2) }} %</b>
                                            <div class="progress mt-1">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $value }}%;" aria-valuenow={{ $value }}
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    {{ number_format($value, 2) }}%
                                                </div>
                                            </div>
                                        </div>
                                    </li> --}}
                                    {{-- <li class="list-group-item">
                                        <b>Dana Yang Masih Diperlukan</b> <a class="float-right">Rp.
                                            {{ number_format($keperluan, 0, '.', '.') }}</a>
                                    </li> --}}
                                @endif
                            </ul>

                            <div class="row row-cols-1">
                                <div class="col mb-2">
                                    <form action="{{ route('admin.funding', $funding) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-block"><b>Hapus Funding</b></a>
                                    </form>
                                </div>
                                <div class="col mb-2">
                                    @if ($funding->status == 'aktif')
                                        <a href="{{ route('admin.funding', $funding) }}" class="btn btn-warning btn-block"
                                            data-toggle="modal" data-target="#completefundingModal"><b>Selesaikan
                                                Funding</b></a>
                                    @elseif($funding->status == 'request')
                                        <form action="{{ route('admin.funding.verify', $funding->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" id="status" value="aktif">
                                            <button type="submit" class="btn btn-warning btn-block"><b>Verifikasi
                                                    Funding</b></a>
                                        </form>
                                    @else
                                        <button class="btn btn-warning btn-block" disabled><b>Funding Selesai</b></button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Funding</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i>Status</strong>

                            <p class="text-muted">
                                {{ $funding->status }}
                            </p>

                            <hr>

                            <strong><i class="fas fa-book mr-1"></i>Pemesan Barang</strong>

                            <p class="text-muted">
                                {{ $funding->customerName }}
                            </p>

                            <hr>

                            <strong><i class="fas fa-book mr-1"></i>Barang Pemesanan</strong>

                            <p class="text-muted">
                                {{ $funding->customerOrder }}
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i>Dibuat Pada</strong>

                            <p class="text-muted">
                                {{ $funding->created_at->format('Y-m-d') }}
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#details" data-toggle="tab">Detail
                                        Informasi
                                        Projek</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="details">
                                    <form class="form-horizontal" action="{{ route('admin.funding', $funding->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Nama" value="{{ $funding->fundName }}" disabled>
                                                @error('fundName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Deskripsi
                                                funding</label>
                                            <div class="col-sm-10">
                                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                                    name="description" required autocomplete="description" style="height: 4cm" disabled>{{ $funding->description }}</textarea>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Modal Yang
                                                Diperlukan</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text">Rp.</span>
                                                    <input id="required_capital" type="text"
                                                        onkeyup="formatCurrency(this)" onblur="removeSeparators(this)"
                                                        class="form-control @error('required_capital') is-invalid @enderror"
                                                        name="required_capital" required autocomplete="required_capital"
                                                        value="{{ $funding->fund_required }}" disabled>

                                                    @error('profit_margin_bersama')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Tanggal Mulai
                                                Pendanaan</label>
                                            <div class="col-sm-10">
                                                <input id="start_date" type="date"
                                                    class="form-control @error('start_date') is-invalid @enderror"
                                                    name="start_date" required value="{{ $funding->start_date }}"
                                                    disabled>

                                                @error('start_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Tanggal Selesai
                                                Pendanaan</label>
                                            <div class="col-sm-10">
                                                <input id="end_date" type="date"
                                                    class="form-control @error('start_date') is-invalid @enderror"
                                                    name="end_date" required value="{{ $funding->end_date }}" disabled>

                                                @error('end_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Nama Pengaju
                                                Pembelian</label>
                                            <div class="col-sm-10">
                                                <input id="customerName" type="text"
                                                    class="form-control @error('customerName') is-invalid @enderror"
                                                    name="customerName" required value="{{ $funding->customerName }}"
                                                    disabled>

                                                @error('customerName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Barang Pengaju
                                                Pembelian</label>
                                            <div class="col-sm-10">
                                                <input id="customerOrder" type="text"
                                                    class="form-control @error('customerName') is-invalid @enderror"
                                                    name="customerOrder" required value="{{ $funding->customerOrder }}"
                                                    disabled>

                                                @error('customeOrder')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        {{-- <div class="form-group row">
                                                <label for="inputExperience" class="col-sm-2 col-form-label">Foto
                                                    Projek</label>
                                                <div class="col-sm-10">
                                                    <div class="custom-file">
                                                        <input type="file"
                                                            class="custom-file-input @error('funding_photo') is-invalid @enderror"
                                                            name="funding_photo" id="funding_photo">
                                                        <label class="custom-file-label" for="funding_photo">Choose
                                                            file</label>
                                                    </div>
                                                    @error('funding_photo')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div> --}}

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#funding" data-toggle="tab">Daftar
                                        Pemasukan Dana</a></li>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="funding">
                                    @if ($funding->status == 'aktif')
                                        <table class="table table-striped fundings">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%">
                                                        #
                                                    </th>
                                                    <th style="width: 15%">
                                                        Nama Investor
                                                    </th>
                                                    <th style="width: 20%">
                                                        Total
                                                    </th>
                                                    <th style="width: 20%" class="text-center">
                                                        Status
                                                    </th>
                                                    <th style="width: 20%" class="text-center">
                                                        Tanggal Pengajuan
                                                    </th>
                                                    <th style="width: 14%" class="text-center">
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach ($fundings as $key => $funding)
                                                <tr>
                                                    <td>
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td>
                                                        <a>
                                                            {{ $funding->name }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a>
                                                            Rp. {{ number_format($funding->total, 0, '.', '.') }}
                                                        </a>
                                                    </td>
                                                    <td class="funding-state">
                                                        <a>
                                                            {{ $funding->status }}
                                                        </a>
                                                    </td>
                                                    <td class="funding-state">
                                                        <a>
                                                            {{ $funding->created_at }}
                                                        </a>
                                                    </td>
                                                    <td class="funding-actions text-center">
                                                        <a class="btn btn-primary btn-sm"
                                                            href="{{ route('admin.user.funding', $funding->id) }}">
                                                            <i class="fas fa-folder">
                                                            </i>
                                                            View
                                                        </a>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                            </tbody>
                                        </table>
                                    @elseif($funding->status == 'request')
                                        <p>Funding Belum Terverifikasi</p>
                                    @elseif($funding->status == 'selesai')
                                        <p>Funding Belum Terverifikasi</p>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <!-- Complete funding Modal -->
    <form id="completefundingForm" action="{{ route('admin.funding', $funding->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal fade" id="completefundingModal" tabindex="-1" role="dialog"
            aria-labelledby="completefundingModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="completefundingModalLabel">Selesaikan Projek</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($funding->required_capital == $funding->current_capital)
                            <p>Anda yakin ingin menyelesaikan funding ini? <b>Dana sudah terkumpul sepenuhnya!</b></p>
                            <p>Proses ini tidak dapat diubah.</p>
                        @else
                            <div>
                                <p>Anda yakin ingin menyelesaikan funding ini? Dana belum terkumpul sepenuhnya</p>
                                <p>Proses ini tidak dapat diubah.</p>
                                <div style="margin-bottom: 10px;">
                                    <div class="pt-1">
                                        <b>Dana Telah Terkumpulkan: {{ number_format($value, 2) }} %</b>
                                        <div class="progress mt-1">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $value }}%;" aria-valuenow={{ $value }}
                                                aria-valuemin="0" aria-valuemax="100">
                                                {{ number_format($value, 2) }}%
                                            </div>
                                        </div>
                                        <div>
                                            <b>Dana Yang Masih Diperlukan</b> <a class="float-right">Rp.
                                                {{ number_format($keperluan, 0, '.', '.') }}</a>
                                        </div>
                                    </div>
                        @endif
                        <div class="form-group">
                            <label for="profit">Total Keuntungan Bersih Projek</label>
                            <p>Mohon masukan keuntungan bersih, bukan pemasukan dari projek!</p>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input id="profit" type="text" onkeyup="formatCurrency(this)"
                                    onblur="removeSeparators(this)"
                                    class="form-control @error('required_capital') is-invalid @enderror" name="profit">
                            </div>
                            @error('required_capital')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="completefundingButton">Selesaikan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <script>
        // Wait for the document to be ready
        document.addEventListener('DOMContentLoaded', function() {
            // Get the required capital and current capital values
            var requiredCapital = {{ $funding->required_capital }};
            var currentCapital = {{ $funding->current_capital }};

            // Get the complete funding button
            var completefundingButton = document.getElementById('completefundingButton');

            // Add a click event listener to the complete funding button
            completefundingButton.addEventListener('click', function() {
                // Check if the current capital matches the required capital
                if (currentCapital === requiredCapital) {
                    // If it matches, submit the form
                    document.getElementById('completefundingForm').submit();
                } else {
                    // If it doesn't match, prevent the modal from being shown
                    event.preventDefault();
                    alert('Current capital does not match the required capital.');
                }
            });
        });
    </script>
@stop
