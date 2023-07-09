@extends('layouts.admin')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-project-img img-fluid" src="{{ url('pro/' . $project->project_photo) }}"
                                    alt="project profile picture">
                            </div>

                            <h3 class="profile-projectname text-center">{{ $project->name }}</h3>


                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Keperluan Total</b> <a class="float-right text-primary">Rp.
                                        {{ number_format($project->required_capital, 0, '.', '.') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Dana Terkumpulkan</b> <a class="float-right">Rp.
                                        {{ number_format($project->current_capital, 0, '.', '.') }}</a>
                                </li>
                                <li class="list-group-item">
                                    @php
                                        $currentCapital = (float) $project->current_capital;
                                        $requiredCapital = (float) $project->required_capital;
                                        $value = ($currentCapital / $requiredCapital) * 100;
                                        
                                        $keperluan = $requiredCapital - $currentCapital;
                                    @endphp
                                    <div class="pt-1">
                                        <b>Dana Telah Terkumpulkan: {{ number_format($value, 2) }} %</b>
                                        <div class="progress mt-1">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $value }}%;" aria-valuenow={{ $value }}
                                                aria-valuemin="0" aria-valuemax="100">
                                                {{ number_format($value, 2) }}%
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <b>Dana Yang Masih Diperlukan</b> <a class="float-right">Rp.
                                        {{ number_format($keperluan, 0, '.', '.') }}</a>
                                </li>
                            </ul>

                            <div class="row row-cols-1">
                                <div class="col mb-2">
                                    <form action="{{ route('admin.project.delete', $project) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-block"><b>Hapus Projek</b></a>
                                    </form>
                                </div>
                                <div class="col mb-2">
                                    @if ($project->progress_status == 'aktif')
                                        <a href="{{ route('admin.project', $project) }}" class="btn btn-warning btn-block"
                                            data-toggle="modal" data-target="#completeProjectModal"><b>Selesaikan
                                                Projek</b></a>
                                    @else
                                    <button class="btn btn-warning btn-block" disabled><b>Projek Selesai</b></button>
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
                            <h3 class="card-title">Informasi Projek</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i>Status</strong>

                            <p class="text-muted">
                                {{ $project->progress_status }}
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i>Dibuat Pada</strong>

                            <p class="text-muted">
                                {{ $project->created_at->format('Y-m-d') }}
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
                                <li class="nav-item"><a class="nav-link active" href="#investment" data-toggle="tab">Daftar
                                        Investasi</a></li>
                                <li class="nav-item"><a class="nav-link" href="#details" data-toggle="tab">Detail Informasi
                                        Projek</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="investment">
                                    <table class="table table-striped projects">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">
                                                    #
                                                </th>
                                                <th style="width: 15%">
                                                    Nama Investor
                                                </th>
                                                <th style="width: 20%">
                                                    Total
                                                </th>
                                                <th style="width: 20%" class="text-center">
                                                    Status
                                                </th>
                                                <th style="width: 20%" class="text-center">
                                                    Tanggal Pengajuan
                                                </th>
                                                <th style="width: 14%" class="text-center">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($investments as $key => $investment)
                                                <tr>
                                                    <td>
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td>
                                                        <a>
                                                            {{ $investment->name }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a>
                                                            Rp. {{ number_format($investment->total, 0, '.', '.') }}
                                                        </a>
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
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="details">
                                    <form class="form-horizontal"
                                        action="{{ route('admin.project.update', $project->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Nama" value="{{ $project->name }}">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Deskripsi
                                                Project</label>
                                            <div class="col-sm-10">
                                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                                    name="description" required autocomplete="description" style="height: 4cm">{{ $project->description }}</textarea>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Modal Yang
                                                Diperlukan</label>
                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-text">Rp.</span>
                                                    <input id="required_capital" type="text"
                                                        onkeyup="formatCurrency(this)" onblur="removeSeparators(this)"
                                                        class="form-control @error('required_capital') is-invalid @enderror"
                                                        name="required_capital" required autocomplete="required_capital"
                                                        value="{{ $project->required_capital }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="profit_margin_bersama">Margin Keuntungan
                                                            Bersama</label>
                                                        <div class="input-group">
                                                            <input id="profit_margin_bersama" type="number"
                                                                min="0" max="100"
                                                                class="form-control @error('profit_margin_bersama') is-invalid @enderror"
                                                                name="profit_margin_bersama" required
                                                                autocomplete="profit_margin_bersama"
                                                                value="{{ $project->profit_margin_bersama }}" readonly>

                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                        @error('profit_margin_bersama')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="profit_margin_investor">Margin Keuntungan
                                                            Investor</label>
                                                        <div class="input-group">
                                                            <input id="profit_margin_investor" type="number"
                                                                min="0" max="100"
                                                                class="form-control @error('profit_margin_investor') is-invalid @enderror"
                                                                name="profit_margin_investor" required
                                                                autocomplete="profit_margin_investor"
                                                                value="{{ $project->profit_margin_investor }}" readonly>

                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                        @error('profit_margin_investor')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputGender" class="col-sm-2 col-form-label">Status Projek</label>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="progress_status"
                                                        id="progress_status_aktif" value="aktif"
                                                        {{ $project->progress_status === 'aktif' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="progress_status_aktif">
                                                        Aktif
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="progress_status"
                                                        id="progress_status_tidak_aktif" value="tidak aktif"
                                                        {{ $project->progress_status === 'tidak aktif' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="progress_status_tidak_aktif">
                                                        Tidak Aktif
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="progress_status"
                                                        id="progress_status_selesai" value="selesai"
                                                        {{ $project->progress_status === 'selesai' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="progress_status_selesai">
                                                        Selesai
                                                    </label>
                                                </div>

                                                @error('progress_status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- <div class="form-group row">
                                            <label for="inputExperience" class="col-sm-2 col-form-label">Foto
                                                Projek</label>
                                            <div class="col-sm-10">
                                                <div class="custom-file">
                                                    <input type="file"
                                                        class="custom-file-input @error('project_photo') is-invalid @enderror"
                                                        name="project_photo" id="project_photo">
                                                    <label class="custom-file-label" for="project_photo">Choose
                                                        file</label>
                                                </div>
                                                @error('project_photo')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> --}}
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-success">Perbarui Informasi
                                                    Projek</button>
                                            </div>
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

    <!-- Complete Project Modal -->
    <form id="completeProjectForm" action="{{ route('admin.project.complete', $project->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal fade" id="completeProjectModal" tabindex="-1" role="dialog"
            aria-labelledby="completeProjectModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="completeProjectModalLabel">Selesaikan Projek</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($project->required_capital == $project->current_capital)
                            <p>Anda yakin ingin menyelesaikan projek ini? <b>Dana sudah terkumpul sepenuhnya!</b></p>
                            <p>Proses ini tidak dapat diubah.</p>
                        @else
                            <div>
                                <p>Anda yakin ingin menyelesaikan projek ini? Dana belum terkumpul sepenuhnya</p>
                                <p>Proses ini tidak dapat diubah.</p>
                                <div style="margin-bottom: 10px;">
                                    <div class="pt-1">
                                        <b>Dana Telah Terkumpulkan: {{ number_format($value, 2) }} %</b>
                                        <div class="progress mt-1">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $value }}%;" aria-valuenow={{ $value }}
                                                aria-valuemin="0" aria-valuemax="100">
                                                {{ number_format($value, 2) }}%
                                            </div>
                                        </div>
                                        <div>
                                            <b>Dana Yang Masih Diperlukan</b> <a class="float-right">Rp.
                                                {{ number_format($keperluan, 0, '.', '.') }}</a>
                                        </div>
                                    </div>
                        @endif
                        <div class="form-group">
                            <label for="profit">Total Keuntungan Bersih Projek</label>
                            <p>Mohon masukan keuntungan bersih, bukan pemasukan dari projek!</p>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input id="profit" type="text" onkeyup="formatCurrency(this)"
                                    onblur="removeSeparators(this)"
                                    class="form-control @error('required_capital') is-invalid @enderror" name="profit">
                            </div>
                            @error('required_capital')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="completeProjectButton">Selesaikan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <script>
        // Wait for the document to be ready
        document.addEventListener('DOMContentLoaded', function() {
            // Get the required capital and current capital values
            var requiredCapital = {{ $project->required_capital }};
            var currentCapital = {{ $project->current_capital }};

            // Get the complete project button
            var completeProjectButton = document.getElementById('completeProjectButton');

            // Add a click event listener to the complete project button
            completeProjectButton.addEventListener('click', function() {
                // Check if the current capital matches the required capital
                if (currentCapital === requiredCapital) {
                    // If it matches, submit the form
                    document.getElementById('completeProjectForm').submit();
                } else {
                    // If it doesn't match, prevent the modal from being shown
                    event.preventDefault();
                    alert('Current capital does not match the required capital.');
                }
            });
        });
    </script>
@stop
