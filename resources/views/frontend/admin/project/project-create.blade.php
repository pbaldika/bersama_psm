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
                <h3 class="card-title">Buat Projek Baru</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">

                <p>Bila kalian ingin membuat projek baru, mohon isi semua informasi dengan tepat dan sesuai.
                    Mohon untuk tidak mengisi form secara sembrono!</p>
                <form method="POST" action="{{ route('admin.project.create') }}" enctype="multipart/form-data">
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
                        <label for="inputDescription">Deskripsi Projek</label>
                        <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                            name="description" required autocomplete="description" autofocus style="height: 4cm"></textarea>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputFund">Modal Yang Diperlukan</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input id="required_capital" type="text" onkeyup="formatCurrency(this)" 
                                onblur="removeSeparators(this)"
                                class="form-control @error('required_capital') is-invalid @enderror" name="required_capital"
                                required autocomplete="required_capital">
                        </div>
                    
                        @error('required_capital')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="profit_margin_bersama">Margin Keuntungan Bersama</label>
                            <div class="input-group">
                                <input id="profit_margin_bersama" type="number" min="0" max="100"
                                    class="form-control @error('profit_margin_bersama') is-invalid @enderror"
                                    name="profit_margin_bersama" required autocomplete="profit_margin_bersama" oninput="updateMargins(this.id, this.value)">
                    
                                <span class="input-group-text">%</span>
                            </div>
                            @error('profit_margin_bersama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                        <div class="col-md-6">
                            <label for="profit_margin_investor">Margin Keuntungan Investor</label>
                            <div class="input-group">
                                <input id="profit_margin_investor" type="number" min="0" max="100"
                                    class="form-control @error('profit_margin_investor') is-invalid @enderror"
                                    name="profit_margin_investor" required autocomplete="profit_margin_investor" oninput="updateMargins(this.id, this.value)">
                    
                                <span class="input-group-text">%</span>
                            </div>
                            @error('profit_margin_investor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
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
                        <label for="project_photo">Foto Projek</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('project_photo') is-invalid @enderror"
                                name="project_photo" id="project_photo">
                            <label class="custom-file-label" for="project_photo">Choose file</label>
                        </div>
                        @error('project_photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="text-center mt-5">
                        <input type="submit" value="Save Changes" class="btn btn-success">
                    </div>
                    
                </form>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@stop


