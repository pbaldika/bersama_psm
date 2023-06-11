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
                  <p>Please fill in the details to register</p>

                  <div class="form row  mb-4">
                  <div class="form-outline">
                  <label class="form-label" for="form2Example11">Fullname</label>
                    <input type="text" id="form2Example11" name ="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}"/>

                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                  </div>

                  </div>

                  <div class="form-outline mb-4">
                    <input type="email" id="email" name= "email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}"/>

                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                  </div>

                  <div class="form-outline mb-4">
                    <input type="text" id="telephone" name="telephone" class="form-control @error('telephone') is-invalid @enderror" placeholder="Telephone" value="{{ old('telephone') }}"/>

                    @error('telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                  </div>

                  <div class="form-outline mb-4">
                    <input list="gender" name="gender" class="form-control @error('gender') is-invalid @enderror" placeholder="Gender" value="{{ old('gender') }}"/>

                    <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender" placeholder="gender">
                    <option value="volvo">Male</option>
                    <option value="saab">Female</option>
                    <option value="opel">Prefer not to say</option>
                  </select>

                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                  </div>
                  

                  <div class="form-outline mb-4">
                    <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address" value="{{ old('address') }}"/>

                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                  </div>

                  <div class="form-outline mb-4 input-group date" id='datetimepicker3'>
                    <input type="date" id="dob" name="dob" class="form-control @error('dob') is-invalid @enderror" placeholder="Date of Birth" value="{{ old('dob') }}"/>

                    @error('dob')
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

                  <div class="form-outline mb-4">
                    <input type="password" id="password-confirm" name="password_confirmation" class="form-control"` placeholder="Confirm Password" required autocomplete="new-password"/>
                  </div>

                  <input id="role" type="hidden" class="form-control" name="role" value="user">
                  <input id="verified" type="hidden" name="verified" value="belum">

                  <div class="text-center pt-1 mb-5 pb-1">
                    <button type="submit" class="btn btn-outline-danger">{{ __('Register') }}</button>
                    <br>
                    <p>Already registered? <a class="text-muted" href="{{ route('login') }}">Sign in here</a></p>
                  </div>

                  

                  <!-- <div class="text-center pt-1 mb-5 pb-1">
                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="button">Log
                      in</button>
                    <a class="text-muted" href="#!">Forgot password?</a>
                  </div> -->
                  
                </form>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">We are more than just a company</h4>
                <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                  exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



@endsection