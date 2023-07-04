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
                        <input id="telephone" type="text" class="form-control" name="telephone" required>

                        @error('telephone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputGender">Jenis Kelamin</label>
                        <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender" required>
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
                    <div class="form-group">
                        <label for="inputAdress">Alamat</label>
                        <textarea type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" required></textarea>

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                <span>
                                @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputProjectLeader">Tanggal Lahir</label>
                        <input id="dob" type="date" class="form-control" name="dob" required>

                        @error('dob')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputStatus">Peran</label>
                        <select id="inputStatus" name="role" class="form-control custom-select">
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
            </div>

            <input id="verified" type="hidden" name="verified" value="belum">


            <input type="submit" value="Buat Akun" class="btn btn-success float-right">
            </form>
            <!-- /.card-body -->
        </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@stop
