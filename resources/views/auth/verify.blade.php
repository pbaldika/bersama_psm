@extends('layouts.user')
@section('content')

    <section id="verification" class="d-flex justify-content-center align-items-center">
        @if (session('message'))
            <h6 class="alert alert-success">
                {{ session('message') }}
            </h6>
        @endif
        <div class="container" data-aos="fade-up">

            @if (session('message'))
                <div class="container">
                    <h6 class="alert alert-success">
                        {{ session('message') }}
                    </h6>
                </div>
            @endif

            <div class="section-header">
                <h2>Verifikasi Email</h2>
                <p>Mohon Untuk Verifikasi Email Anda Sebelum Lanjut</p>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('Verifikasi Email Anda') }}</div>
            
                            <div class="card-body">
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                                @endif
            
                                {{ __('
                                Sebelum melanjutkan, mohon lakukan verifikasi email Anda. Silakan cek kotak masuk email Anda untuk menemukan email verifikasi yang baru.') }}
                                {{ __('Jika Anda tidak menerima email') }},
                                <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('klik disini untuk email baru') }}</button>.
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

