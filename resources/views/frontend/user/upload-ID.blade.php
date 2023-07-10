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
                <h2>Upload Foto Identitas Kamu</h2>
                <p>Kamu harus mengupload foto identitas kamu dan dengan diri sendiri agar dapat menggunakan Bersama secara
                    penuh.</p>
            </div>

            @if (Auth::user()->verified == null)
                <div class="container">
                    <form method="post" action="{{ route('verification-upload') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label">Jenis Identitas</label>
                                <select class="form-select @error('identity_type') is-invalid @enderror"
                                    name="identity_type" id="identity_type">
                                    <option selected disabled>Pilih Salah Satu</option>
                                    <option value="ktp">KTP</option>
                                    <option value="paspor">Paspor</option>
                                </select>
                                @error('identity_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label">Nomor Identitas</label>
                                <input type="text" class="form-control" required name="identity_number">
                                @error('identity_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label">Upload Foto Identitas</label>
                                <img src="{{ url('Image/contoh ktp.png') }}" class="mx-auto img-fluid mb-3"
                                    alt="contoh foto identitas" style="height:80%">
                                <input type="file" class="form-control" required name="identity_photo">

                                @error('identity_photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label">Upload Foto Selfie</label>
                                <img src="{{ url('Image/contoh selfie ktp.png') }}" class="mx-auto img-fluid mb-3"
                                    alt="contoh foto identitas" style="height:80%">
                                <input type="file" class="form-control" required name="identity_selfie">

                                @error('identity_selfie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input id="verified" type="hidden" name="verified" value="request">
                        </div>


                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success btn-lg">Upload Identitas</button>
                        </div>
                    </form>
                </div>
            @elseif (Auth::user()->verified == 'request')
                <div class="container">
                    <h6 class="alert alert-primary">
                        Verifikasi anda sedang berjalan, mohon tunggu sampai kamu terverifikasi.
                    </h6>
                </div>
            @elseif (Auth::user()->verified == 'verified')
                <div class="container">
                    <h6 class="alert alert-success">
                        Verifikasi anda telah berhasil, selamat menggunakan bersama.
                    </h6>
                </div>
            @elseif (Auth::user()->verified == 'tolak')
                <div class="container">
                    <h6 class="alert alert-danger">
                        Verifikasi anda ditolak, mohon untuk mengupload verifikasi baru!
                    </h6>
                </div>

                <div class="container">
                    <form method="post" action="{{ route('verification-upload') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label">Jenis Identitas</label>
                                <select class="form-select @error('identity_type') is-invalid @enderror"
                                    name="identity_type" id="identity_type">
                                    <option selected disabled>Pilih Salah Satu</option>
                                    <option value="ktp">KTP</option>
                                    <option value="paspor">Paspor</option>
                                </select>
                                @error('identity_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label">Nomor Identitas</label>
                                <input type="text" class="form-control" required name="identity_number">
                                @error('identity_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label">Upload Foto Identitas</label>
                                <img src="{{ url('Image/contoh ktp.png') }}" class="mx-auto img-fluid mb-3"
                                    alt="contoh foto identitas" style="height:80%">
                                <input type="file" class="form-control" required name="identity_photo">

                                @error('identity_photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label">Upload Foto Selfie</label>
                                <img src="{{ url('Image/contoh selfie ktp.png') }}" class="mx-auto img-fluid mb-3"
                                    alt="contoh foto identitas" style="height:80%">
                                <input type="file" class="form-control" required name="identity_selfie">

                                @error('identity_selfie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input id="verified" type="hidden" name="verified" value="request">
                        </div>


                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success btn-lg">Upload Identitas</button>
                        </div>
                    </form>
                </div>
            @endif

        </div>
    </section>
@stop
