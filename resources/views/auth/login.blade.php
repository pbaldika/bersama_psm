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

                <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <p>Mohon isi informasi personal anda untuk masuk</p>

                  <div class="form-outline mb-4">
                    <input type="email" id="email" name= "email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}"/>

                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                  </div>


                  <div class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="new-password"/>

                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <a class="text-muted" href="{{ route('password.request') }}">Lupa Password</a>
                    <br>
                    <br>
                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">{{ __('Login') }}</button>
                    <br>
                    <br>
                    <p>Belum Daftar? <br> <a class="text-muted" href="{{ route('register') }}">Register Disini</a></p>
                  </div>
                  
                </form>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center bg-light vstack">
              <div class="">
                <img src="img/registere.png" class="rounded mx-auto d-block img-fluid" >
              </div>  
              <div class="text-black px-3 py-4 p-md-5 mx-md-4">
                <h2 class="mb-4">Tumbuhkan Investasi Anda Dengan Hasanah dan Amanah</h2>
                <p class="small mb-0">Bersama akan selalu menemani anda untuk menumbuhkan investasi yang telah diberikan. Dengan kepercayaan anda, kami menunaikan kerja dengan cara yang islami. Pembagian keuntungan selalu akan dibagi secara rata dan adil</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
