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
                <h3 class="card-title">General</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.project.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="inputName">Nama Projek</label>
                        <input id="inputName" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputName">Deskripsi Projek</label>
                        <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                            name="description" required autocomplete="description" autofocus></textarea>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputDescription">Modal Yang Diperlukan</label>
                        <input id="required_capital" type="text"
                            class="form-control @error('required_capital') is-invalid @enderror" name="required_capital"
                            required autocomplete="required_capital">

                        @error('required_capital')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label>Status Projek</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="progress_status" id="progress_status_aktif"
                                value="aktif">
                            <label class="form-check-label" for="progress_status_aktif">
                                Aktif
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="progress_status"
                                id="progress_status_tidak_aktif" value="tidak aktif">
                            <label class="form-check-label" for="progress_status_tidak_aktif">
                                Tidak Aktif
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="progress_status"
                                id="progress_status_selesai" value="selesai">
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

                    <div class="form-group">
                        <label>Foto Project</label>
                        <input type="file" class="form-control" name="project_photo" id="project_photo">
                        @error('project_photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <input type="submit" value="Save Changes" class="btn btn-success float-right">
                </form>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@stop
