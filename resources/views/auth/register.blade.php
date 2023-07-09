@extends('layouts.app')

@section('content')
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                                            style="width: 185px;" alt="logo">
                                        <h4 class="mt-1 mb-1">Bersama</h4>
                                        <p class="mb-4">Bekerja bersama, maju bersama</p>
                                    </div>

                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <p>Mohon isi informasi personal anda untuk register</p>

                                        <div class="form row  mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form2Example11">Nama Penuh</label>
                                                <input type="text" id="form2Example11" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name') }}" />

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example11">Email</label>
                                            <input type="email" id="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" />

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example11">Nomor Telepon</label>
                                            <input type="text" id="telephone" name="telephone"
                                                class="form-control @error('telephone') is-invalid @enderror"
                                                value="{{ old('telephone') }}" />

                                            @error('telephone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example11">Jenis Akun</label>
                                            <select class="form-select @error('role') is-invalid @enderror" name="role"
                                                id="role">
                                                <option selected disabled>Pilih Salah Satu</option>
                                                <option value="user">Investor</option>
                                                <option value="company">Perusahaan</option>

                                                @error('role')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </select>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example11">Jenis Kelamin</label>
                                            <select class="form-select @error('gender') is-invalid @enderror" name="gender"
                                                id="gender">
                                                <option selected disabled>Pilih Salah Satu</option>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                                <option value="N/A">Memilih untuk tidak mengatakan</option>

                                                @error('gender')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </select>
                                        </div>


                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example11">Alamat</label>

                                            <textarea type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror"
                                                required></textarea>

                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4" id='datetimepicker3'>
                                            <label class="form-label" for="form2Example11">Tanggal Lahir</label>

                                            <input type="date" id="dob" name="dob"
                                                class="form-control @error('dob') is-invalid @enderror" />

                                            @error('dob')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example11">Password</label>

                                            <input type="password" id="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Password" required autocomplete="new-password" />

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example11">Konfirmasi Password</label>

                                            <input type="password" id="password-confirm" name="password_confirmation"
                                                class="form-control"` placeholder="Confirm Password" required
                                                autocomplete="new-password" />
                                        </div>

                                        <input id="verified" type="hidden" name="verified" value="belum">

                                        <div class="text-center mt-2 pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                                type="submit">{{ __('Register') }}</button>
                                            <br>
                                            <br>
                                            <p>Sudah Daftar? <br> <a class="text-muted" href="{{ route('login') }}">Masuk
                                                    disini</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center bg-light vstack">
                                <div class="">
                                    <img src="img/registere.png" class="rounded mx-auto d-block img-fluid">
                                </div>
                                <div class="text-black px-3 py-4 p-md-5 mx-md-4">
                                    <h2 class="mb-4">Tumbuhkan Investasi Anda Dengan Hasanah dan Amanah</h2>
                                    <p class="small mb-0">Bersama akan selalu menemani anda untuk menumbuhkan investasi
                                        yang telah diberikan. Dengan kepercayaan anda, kami menunaikan kerja dengan cara
                                        yang islami. Pembagian keuntungan selalu akan dibagi secara rata dan adil</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
