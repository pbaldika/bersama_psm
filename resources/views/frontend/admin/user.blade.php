@extends('layouts.admin')
@section('content')
<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Users</h3>
     
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>

    <div class="card-header">
      <!-- Search user -->
      <nav class="navbar navbar-light bg-light">
        <form class="form-inline" action="{{route('admin.home')}}" method="GET">
          @csrf
          <input class="form-control mr-sm-2" type="search" placeholder="Search User" aria-label="Search" name="user-search" id="user-search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </nav>
    </div>
    <div class="card-body p-0">
      <table class="table table-striped projects">
        <thead>
          <tr>
            <th style="width: 1%">
              #
            </th>
            <th style="width: 15%">
              Name
            </th>
            <th style="width: 20%">
              Email
            </th>
            <th style="width: 5%">
              Role
            </th>
            <th style="width: 20%" class="text-center">
              Telephone
            </th>
            <th style="width: 20%" class="text-center">
              Address
            </th>
            <th style="width: 14%" class="text-center">
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $key => $user)
          <tr>
            <td>
              {{$users->firstItem() + $key}}
            </td>
            <td>
              <a>
                {{$user->name}}
              </a>
            </td>
            <td>
              <a>
                {{$user->email}}
              </a>
            </td>
            <td>
              <a>
                {{$user->role}}
              </a>
            </td>
            <td class="project-state">
              <a>
                {{$user->telephone}}
              </a>
            </td>
            <td class="project-state">
              <a>
                {{$user->address}}
              </a>
            </td>
            <td class="project-actions text-center">
              <a class="btn btn-primary btn-sm" href="{{route('admin.user.show', $user->id)}}">
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

      <div class="d-flex justify-content-center mt-3">
        <p> Page : {{$users->currentPage()}}</p> <br><br>
      </div>
      <div class="d-flex justify-content-center">
        {{$users->links()}}
      </div>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->
@stop