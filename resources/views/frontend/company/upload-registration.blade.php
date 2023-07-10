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
                <h2>Upload Foto Registrasi Perusahaan Anda</h2>
                <p>Mohon berikan bukti pendaftaran perusahaan anda agar dapat mengajukan pembelian barang. Bukti bisa berupa
                    NPWP perusahaan ataupun Nomor Induk Perusahaan.</p>
            </div>

            @if (Auth::user()->verified == null)
                <div class="container">
                    <form method="post" action="{{ route('verification-upload-comp') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label">Jenis Identitas</label>
                                <input type="text" class="form-control" id="registration_type" name="registration_type" required>
                                @error('registration_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label">Nomor Identitas</label>
                                <input type="text" class="form-control" name="registration_number" required>
                                @error('registration_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label">Upload Foto Identitas</label>
                                <input type="file" class="form-control" name="registration_photo" required>

                                @error('registration_photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <input id="verified" type="hidden" name="verified" value="request">
                        </div>


                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success btn-lg">Upload Registrasi</button>
                        </div>
                    </form>
                </div>
            @elseif (Auth::user()->verified == 'request')
                <div class="container">
                    <h6 class="alert alert-primary">
                        Verifikasi anda sedang berjalan, mohon tunggu sampai anda terverifikasi.
                    </h6>
                </div>
            @elseif (Auth::user()->verified == 'tolak')
                <div class="container">
                    <h6 class="alert alert-danger">
                        Verifikasi anda ditolak, mohon untuk mengupload verifikasi baru!
                    </h6>
                </div>

                <div class="container">
                    <form method="post" action="{{ route('verification-upload-comp') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label">Jenis Identitas</label>
                                <input type="text" class="form-control" id="registration_type" name="registration_type">
                                @error('registration_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label">Nomor Identitas</label>
                                <input type="text" class="form-control" required name="registration_number">
                                @error('registration_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-outline mb-3">
                                <label class="form-label">Upload Foto Identitas</label>
                                <input type="file" class="form-control" required name="registration_photo">

                                @error('registration_photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <input id="verified" type="hidden" name="verified" value="request">
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success btn-lg">Upload Registrasi</button>
                        </div>
                    </form>
                </div>
            @endif



            <div class="row mt-2 justify-content-center">
                <h3 class="text-center">Contoh Bukti Registrasi Perusahaan</h3>
                <div class="col-md-6 form-outline mt-3 text-center">
                    <p>Contoh Foto Nomor Induk Berusaha (NIB)</p>
                    <img src="{{ url('Image/contoh NIB.jpg') }}" class="mx-auto d-block img-fluid mb-3"
                        style="border: 0.5px solid #000000; max-height: 15cm" alt="contoh foto identitas">
                </div>

                <div class="col-md-6 form-outline mt-3 text-center">
                    <p>Contoh Foto NPWP (NIB)</p>
                    <img src="{{ url('Image/contoh npwp.png') }}" class="mx-auto d-block img-fluid mb-3"
                        style="border: 0.5px solid #000000; max-height: auto; max-width: 100%"
                        alt="contoh foto identitas">
                </div>
            </div>

        </div>
    </section>
@stop
