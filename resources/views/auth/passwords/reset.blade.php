@extends('layouts.app')
@section('content')
    <section class="h-100 gradient-form" style="background-color: #eee;">
        @if (session('message'))
            <h6 class="alert alert-success">
                {{ session('message') }}
            </h6>
        @endif
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="{{asset('Image/logo.png')}}"
                                        style="height: 4cm;" alt="logo">
                                        <h4 class="mt-1 mb-1">Bersama</h4>
                                        <p class="mb-4">Bekerja bersama, maju bersama</p>
                                    </div>

                                    <form method="POST" action="{{ route('password.update') }}">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                        <h3 class="text-center"><b>Ubah Password</b></h3>
                                        <p>Kalian Telah Lupa Password? Buat Password Baru Disini</p>

                                        <div class="form-outline mb-4">
                                            <input id="email" type="hidden"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ $request->email }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="new-password" placeholder="Password Baru">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password">
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <p>Sudah Daftar? <br> <a class="text-muted" href="{{ route('login') }}">Masuk
                                                    disini</a></p>
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                                type="submit">{{ __('Ubah Password') }}</button>
                                            <p>Belum Daftar? <br> <a class="text-muted"
                                                    href="{{ route('register') }}">Register Disini</a></p>
                                        </div>

                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center bg-light vstack">
                                <div class="">
                                    <img src="{{asset('img/registere.png')}}" class="rounded mx-auto d-block img-fluid">
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
