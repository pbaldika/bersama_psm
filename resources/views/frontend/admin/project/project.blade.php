@extends('layouts.admin')
@section('content')
<!-- Main content -->

@if(session('message'))
    <h6 class="alert alert-success">
        {{ session('message') }}
    </h6>
@endif
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
      <!-- Search project -->
      <nav class="navbar navbar-light bg-light">
        <form class="form-inline" action="{{route('admin.home')}}" method="GET">
          @csrf
          <input class="form-control mr-sm-2" type="search" placeholder="Search User" aria-label="Search" name="project-search" id="project-search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </nav>
      <a href="{{route('admin.project.store')}}" class="btn btn-success my-2 my-sm-0" type="submit">Create</a>
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
              Description
            </th>
            <th style="width: 5%">
              Required Capital
            </th>
            <th style="width: 20%" class="text-center">
              Current Capital
            </th>
            <th style="width: 20%" class="text-center">
              Status
            </th>
            <th style="width: 14%" class="text-center">
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($projects as $key => $project)
          <tr>
            <td>
              {{$projects->firstItem() + $key}}
            </td>
            <td>
              <a>
                {{$project->name}}
              </a>
            </td>
            <td>
              <a>
                {{$project->description}}
              </a>
            </td>
            <td>
              <a>
                {{$project->required_capital}}
              </a>
            </td>
            <td class="project-state">
              <a>
                {{$project->current_capital}}
              </a>
            </td>
            <td class="project-state">
              <a>
                {{$project->progress_status}}
              </a>
            </td>
            <td class="project-actions text-center">
              <a class="btn btn-primary btn-sm" href="{{route('admin.project.show', $project->id)}}">
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
        <p> Page : {{$projects->currentPage()}}</p> <br><br>
      </div>
      <div class="d-flex justify-content-center">
        {{$projects->links()}}
      </div>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->
@stop