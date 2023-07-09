@extends('layouts.admin')
@section('content')

    @if (session('message'))
        <h6 class="alert alert-success">
            {{ session('message') }}
        </h6>
    @endif

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Buat Akun User Baru</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.user.create') }}">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <p><i class="bi bi-exclamation-circle-fill text-danger"></i>
                            Password User Adalah: <b>qwertyuiop</b></p>
                        <label for="inputName">Nama</label>
                        <input id="inputName" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputTelephone">Telefon</label>
                        <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror"
                            name="telephone" required>

                        @error('telephone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputGender">Jenis Kelamin</label>
                        <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender"
                            required>
                            <option selected disabled>Pilih Salah Satu</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                            <option value="N/A">Memilih untuk tidak mengatakan</option>
                        </select>

                        @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Alamat</label>
                        <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror" required></textarea>

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputDob">Tanggal Lahir</label>
                        <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror"
                            name="dob" required>

                        @error('dob')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputRole">Peran</label>
                        <select id="role" name="role" class="form-control custom-select" required>
                            <option selected disabled>Pilih Salah Satu</option>
                            <option value="user">Investor</option>
                            <option value="company">Company</option>
                            <option value="admin">Admin</option>
                        </select>

                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example11">Password</label>

                        <input type="text" id="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password" required
                            autocomplete="new-password" value="qwertyuiop" disabled/>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example11">Konfirmasi Password</label>

                        <input type="text" id="password-confirm" name="password_confirmation" class="form-control"`
                            placeholder="Confirm Password" required autocomplete="new-password" value="qwertyuiop" disabled/>
                    </div>

                    <input id="verified" type="hidden" name="verified" value="belum">
                    <input type="submit" value="Buat Akun" class="btn btn-success float-right">
                </form>

            </div>
            <!-- /.card-body -->
        </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@stop
