@extends('layouts.user')
@section('content')

    <section id="verification" class="d-flex justify-content-center align-items-center">
        <div class="container" data-aos="fade-up">

            @if (session('message'))
                <div class="container">
                    <h6 class="alert alert-success">
                        {{ session('message') }}
                    </h6>
                </div>
            @endif

            <div class="section-header">
                <h2>Upload Bukti Transfer</h2>
                <p>Mohon Untuk Upload Bukti Pembayaran Investasi Anda. Investasi Anda Akan Disetujui Bila Pembayaran Telah
                    Diterima Dengan Buktinya.</p>

                @if (Auth::user()->bank_account_number == null)
                    <br>
                    <p><i class="bi bi-exclamation-circle-fill text-primary"></i> <b>Anda harus menambahkan nomor rekening
                            Anda sebelum mengunggah bukti pembayaran. Kami perlu
                            memverifikasi agar Anda hanya menggunakan rekening yang sama untuk pembayaran dalam akun ini.
                            Nomor rekening akan
                            digunakan oleh kami untuk mendistribusikan hasil dari investasi Anda.</b></p>
                @endif
            </div>

            <div class="container">
                @if (!isset($investment->payment_proof) && Auth::user()->bank_account_number == null)
                <form method="post" action="{{ route('proof-upload', $investment) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class=" form-outline mb-3">
                        <label class="form-label">Upload Nomor Rekening Anda</label>
                        <input type="text" class="form-control @error('bank_account_number') is-invalid @enderror"
                            name="bank_account_number" required>

                        @error('bank_account_number')
                            <span cl ass="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                        <p><i class="bi bi-exclamation-circle-fill text-primary"></i> Anda hanya perlu menambakan nomor rekening sekali</p>
                    </div>
                    <div class=" form-outline mb-3">
                        <label class="form-label">Upload Bukti Pembayaran</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                            required>

                        @error('image')
                            <span cl ass="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-success btn-lg">Upload Bukti</button>
                    </div>
                </form>
                @elseif (!isset($investment->payment_proof))
                    <form method="post" action="{{ route('proof-upload', $investment) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class=" form-outline mb-3">
                            <label class="form-label">Upload Bukti Pembayaran</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                                required>

                            @error('image')
                                <span cl ass="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success btn-lg">Upload Bukti</button>
                        </div>
                    </form>
                @else
                    <div class="container">
                        <h6 class="alert alert-primary">
                            Verifikasi investasi anda sedang berjalan, mohon tunggu sampai terverifikasi.
                        </h6>
                    </div>
                @endif
                <div class="row mt-4 justify-content-center">
                    <h3 class="text-center">Contoh Bukti Transfer Bank</h3>
                    <div class="col-md-6 form-outline mt-3 text-center">
                        <p>Contoh Foto Transfer Online</p>
                        <img src="{{ url('Image/contoh transfer m bangking.png') }}" class="mx-auto d-block img-fluid mb-3"
                            style="border: 0.5px solid #000000; max-height: 15cm" alt="contoh foto transfer online">
                    </div>

                    <div class="col-md-6 form-outline mt-3 text-center">
                        <p>Contoh Foto Transfer Bank</p>
                        <img src="{{ url('Image/contoh transfer bank.jpeg') }}" class="mx-auto d-block img-fluid mb-3"
                            style="border: 0.5px solid #000000; max-height: auto; max-width: 100%"
                            alt="contoh foto transfer bank">
                    </div>
                </div>
            </div>


        </div>
    </section>
@stop
