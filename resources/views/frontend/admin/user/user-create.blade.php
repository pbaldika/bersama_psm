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
            <form method="POST" action="{{ route('admin.user.create')}}">
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
                <label for="inputDescription">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">

                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
              
            </div>
              <div class="form-group">
                <label for="inputStatus">Telephone</label>
                <input id="telephone" type="text" class="form-control" name="telephone" ">
<!-- 
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror -->
              </div>
              <div class="form-group">
                <label for="inputClientCompany">Gender</label>
                                <input id="gender" type="text" class="form-control" name="gender">
<!-- 
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror -->
              </div>
              <div class="form-group">
                <label for="inputProjectLeader">Address</label>
                <input id="address" type="text" class="form-control" name="address">
<!-- 
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror -->
              </div>

              <div class="form-group">
                <label for="inputProjectLeader">Address</label>
                <input id="dob" type="date" class="form-control" name="dob">
<!-- 
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror -->
              </div>

              <div class="form-group">
                <label for="inputStatus">Role</label>
                <select id="inputStatus" name="role" class="form-control custom-select">
                  <option disabled>Select one</option>
                  <option selected>User</option>
                  <option>Company</option>
                  <option>Admin</option>
                </select>
              </div>
            </div>

            <input id="verified" type="hidden" name="verified" value="belum">


          <input type="submit" value="Save Changes" class="btn btn-success float-right">
        </form>
            <!-- /.card-body -->
          </div>
             </div>
          <!-- /.card -->
    </section>
    <!-- /.content -->
@stop