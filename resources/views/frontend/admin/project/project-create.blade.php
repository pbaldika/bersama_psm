@extends('layouts.admin')
@section('content')

@if(session('message'))
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
            <form method="POST" action="{{ route('admin.project.create')}}">
            @csrf
            @method("POST")
              <div class="form-group">
                <label for="inputName">Name</label>
                <input id="inputName" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>
                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror            
            </div>

              <div class="form-group">
                <label for="inputName">Description</label>
                <input id="description" type="text" class="form-control @error('name') is-invalid @enderror" name="description" required autocomplete="description" autofocus>
                <!-- @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror             -->
            </div>

              <div class="form-group">
                <label for="inputDescription">Required Capital</label>
                <input id="required_capital" type="text" class="form-control @error('required_capital') is-invalid @enderror" name="required_capital" required autocomplete="required_capital">

                <!-- @error('required_capital')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
               -->
            </div>
              <div class="form-group">
                <label for="inputStatus">Progress Status</label>
                <input id="progress_status" type="text" class="form-control" name="progress_status" ">
<!-- 
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror -->
              </div>
              <div class="form-group">
                <label for="inputClientCompany">Investor</label>
                                <input id="investor" type="text" class="form-control" name="investor">
<!-- 
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror -->
              </div>

          <input type="submit" value="Save Changes" class="btn btn-success float-right">
        </form>
            <!-- /.card-body -->
          </div>
             </div>
          <!-- /.card -->
    </section>
    <!-- /.content -->
@stopß