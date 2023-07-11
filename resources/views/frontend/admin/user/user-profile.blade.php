@extends('layouts.admin')
@section('content')
@if (session('message'))
        <h6 class="alert alert-success">
            {{ session('message') }}
        </h6>
    @endif
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $user->name }}</h3>


                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Peran</b> <a class="float-right text-primary">{{ $user->role }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Telefon</b> <a class="float-right">{{ $user->telephone }}</a>
                                </li>
                            </ul>

                            <div class="row row-cols-1">
                                <div class="col mb-2">
                                    <form action="{{ route('admin.user.delete', $user) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-block"><b>Hapus User</b></a>
                                    </form>
                                </div>
                                <div class="col mb-2">
                                    @if ($user->role == 'user')
                                        <a href="{{ route('admin.user.show-verify', $user) }}"
                                            class="btn btn-warning btn-block"><b>Verifikasi</b></a>
                                    @elseif ($user->role == 'company')
                                        <a href="{{ route('admin.user.show-verify-comp', $user) }}"
                                            class="btn btn-warning btn-block"><b>Verifikasi</b></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Status User</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i>Verifikasi</strong>

                            <p class="text-muted">
                                @if ($user->verified == null)
                                    Belum Mengupload Verifikasi
                                @else
                                    {{ $user->verified }}
                                @endif
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i>Verifikasi Email</strong>

                            <p class="text-muted">
                                @if ($user->verified == null)
                                    Email Belum Diverifikasi
                                @else
                                    {{ $user->email_verified_at }}
                                @endif
                            </p>

                            <hr>

                            <strong><i class="fas fa-pencil-alt mr-1"></i> Alamat</strong>

                            <p class="text-muted">
                                {{ $user->address }}
                            </p>

                            <hr>

                            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                            <p class="text-muted">
                                @if ($user->verified == 'request')
                                    User Perlu Diverikasi! Mohon Tinjau Request User!<br>
                                @elseif ($user->verified == 'tolak')
                                    Verikasi Ditolak, Tunggu User Verifikasi Ulang<br>
                                @else
                                    Tidak Ada note.
                                @endif
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#investment"
                                        data-toggle="tab">Investasi</a></li>
                                <li class="nav-item"><a class="nav-link" href="#details" data-toggle="tab">Detail Informasi
                                        Akun</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                @if ($user->role == 'user')
                                    <div class="active tab-pane" id="investment">
                                        @if (empty($investments))
                                            <h4>User Belum Mengajukan Investasi.</h4>
                                        @else
                                            <table class="table table-striped projects">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 1%">
                                                            #
                                                        </th>
                                                        <th style="width: 15%">
                                                            Project
                                                        </th>
                                                        <th style="width: 20%">
                                                            Total
                                                        </th>
                                                        <th style="width: 5%">
                                                            Profit
                                                        </th>
                                                        <th style="width: 20%" class="text-center">
                                                            Status
                                                        </th>
                                                        <th style="width: 20%" class="text-center">
                                                            Created At
                                                        </th>
                                                        <th style="width: 14%" class="text-center">
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($investments as $key => $investment)
                                                        <tr>
                                                            <td>

                                                            </td>
                                                            <td>
                                                                <a>
                                                                    {{ $investment->name }}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a>
                                                                    {{ $investment->total }}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                @if ($investment->profit == null)
                                                                    <a>
                                                                        None
                                                                    </a>
                                                                @else
                                                                    <a>
                                                                        {{ $investment->profit }}
                                                                    </a>
                                                                @endif
                                                            </td>
                                                            <td class="project-state">
                                                                <a>
                                                                    {{ $investment->status }}
                                                                </a>
                                                            </td>
                                                            <td class="project-state">
                                                                <a>
                                                                    {{ $investment->created_at }}
                                                                </a>
                                                            </td>
                                                            <td class="project-actions text-center">
                                                                <a class="btn btn-primary btn-sm"
                                                                    href="{{ route('admin.user.investment', $investment->id) }}">
                                                                    <i class="fas fa-folder">
                                                                    </i>
                                                                    View
                                                                </a>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                        @endif
                                        </tbody>
                                        </table>
                                    </div>
                                @elseif($user->role == 'company')
                                    <div class="active tab-pane" id="investment">
                                        @if (empty($fundings))
                                            <h4>User Belum Mengajukan Pembelian.</h4>
                                        @else
                                            <table class="table table-striped projects">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 1%">
                                                            #
                                                        </th>
                                                        <th style="width: 15%">
                                                            Order
                                                        </th>
                                                        <th style="width: 40%">
                                                            Deskripsi
                                                        </th>
                                                        <th style="width: 10%">
                                                            Tanggal Dipesan
                                                        </th>
                                                        <th style="width: 10%" class="text-center">
                                                            Tanggal Penerimaan
                                                        </th>
                                                        <th style="width: 14%" class="text-center">
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($fundings as $key => $funding)
                                                        <tr>
                                                            <td>

                                                            </td>
                                                            <td>
                                                                <a>
                                                                    {{ $funding->customerOrder }}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a>
                                                                    {{ $funding->description }}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a>
                                                                    {{ $funding->start_date }}
                                                                </a>
                                                            </td>
                                                            <td class="project-state">
                                                                <a>
                                                                    {{ $funding->end_date }}
                                                                </a>
                                                            </td>
                                                            <td class="project-actions text-center">
                                                                {{-- <a class="btn btn-primary btn-sm"
                                                                    href="{{ route('admin.user.funding', $funding->id) }}">
                                                                    <i class="fas fa-folder">
                                                                    </i>
                                                                    View
                                                                </a> --}}
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                        @endif
                                        </tbody>
                                        </table>
                                    </div>
                                @endif
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="details">
                                    <form class="form-horizontal" method="POST"
                                        action="{{ route('admin.user.update', $user) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                                    name="name" placeholder="Nama" value="{{ $user->name }}">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10" value="{{ $user->email }}">
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="email" name="email" placeholder="Email"
                                                    value="{{ $user->email }}">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Telefon</label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                    class="form-control @error('telephone') is-invalid @enderror"
                                                    id="telephone" name="telephone" placeholder="Telefon"
                                                    value="{{ $user->telephone }}">
                                                @error('telephone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputGender" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                            <div class="col-sm-10">
                                                <select class="form-control @error('gender') is-invalid @enderror"
                                                    name="gender" id="gender" required>
                                                    <option disabled>Pilih Salah Satu</option>
                                                    <option value="Laki-Laki"
                                                        {{ $user->gender === 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki
                                                    </option>
                                                    <option value="Perempuan"
                                                        {{ $user->gender === 'Perempuan' ? 'selected' : '' }}>Perempuan
                                                    </option>
                                                    <option value="N/A"
                                                        {{ $user->gender === 'N/A' ? 'selected' : '' }}>Memilih untuk tidak
                                                        mengatakan</option>
                                                </select>
                                                @error('gender')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputExperience" class="col-sm-2 col-form-label">Alamat</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control @error('gender') is-invalid @enderror" id="adress" name="adress"
                                                    placeholder="Alamat">{{ $user->address }}</textarea>
                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputProjectLeader" class="col-sm-2 col-form-label">Tanggal
                                                Lahir</label>
                                            <div class="col-sm-10">
                                                <input id="dob" type="date"
                                                    class="form-control @error('dob') is-invalid @enderror" name="dob"
                                                    required value="{{ $user->dob }}">

                                                @error('dob')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- <script>
                                            // Assuming you have a variable called 'dobValue' containing the date of birth from the database
                                            var dobValue = '{{ $user->dob }}';

                                            // Check if the 'dobValue' is not empty
                                            if (dobValue) {
                                                // Create a new Date object from the 'dobValue'
                                                var date = new Date(dobValue);

                                                // Format the date to 'YYYY-MM-DD'
                                                var formattedDate = date.toISOString().split('T')[0];

                                                // Set the 'formattedDate' as the value of the input field
                                                document.getElementById('dob').value = formattedDate;
                                            }
                                        </script> --}}


                                        <div class="form-group row">
                                            <label for="inputGender" class="col-sm-2 col-form-label">Peran</label>
                                            <div class="col-sm-10">
                                                <select id="inputStatus" name="role"
                                                    class="form-control custom-select">
                                                    <option disabled selected>Pilih Salah Satu</option>
                                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                                                        Investor
                                                    </option>
                                                    <option value="company"
                                                        {{ $user->role === 'company' ? 'selected' : '' }}>Company
                                                    </option>
                                                    <option value="admin"
                                                        {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                </select>
                                            </div>
                                        </div>

                                        <input type="hidden" id="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            value="{{ old('password') ?: $user->password }}" />

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        {{-- <input id="verified" type="hidden" name="verified" value="{{ $user->verified }}" > --}}


                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-success">Perbarui Akun
                                                    User</button>
                                            </div>

                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@stop
