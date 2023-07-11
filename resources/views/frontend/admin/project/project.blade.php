@extends('layouts.admin')
@section('content')
    <!-- Main content -->

    @if (session('message'))
        <h6 class="alert alert-success">
            {{ session('message') }}
        </h6>
    @endif
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Projek</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-header">
                <nav class="navbar navbar-light bg-light">
                    <form class="form-inline" action="{{ route('admin.project.search') }}" method="GET">
                        <div class="d-flex">
                            <a href="{{ route('admin.project.show-create') }}" class="btn btn-success ml-2 mr-2 my-2 my-sm-0">Buat
                                Projek</a>
                            <!-- Role filter -->
                            @csrf
                            <input class="form-control mr-sm-2 ms-2" type="search" placeholder="Cari project"
                                aria-label="Search" name="project-search" id="project-search">
                            <button class="btn btn-outline-success my-2 my-sm-0 ms-2" type="submit">Cari Projek</button>
                        </div>
                    </form>
                    {{-- <form action="{{ route('admin.project') }}" id="project-filter-form">
                        <select class="form-control mr-sm-2 ms-2 ml-2" name="status" id="status-filter">
                            <option selected disabled>Pilih Status</option>
                            <option value="">Semua Status</option>
                            <option value="project">Aktif</option>
                            <option value="company">Selesai</option>
                        </select>
                    </form> --}}
                </nav>

                <script>
                    // Listen for change event on the role filter select element
                    document.getElementById('role-filter').addEventListener('change', function() {
                        // Trigger form submission when the role filter changes
                        document.getElementById('project-filter-form').submit();
                        if(selectedValue==null){
                          location.reload();
                        }
                    });
                </script>
            </div>
            <div class="card-body p-0">
                <div id="project-list-container">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    #
                                </th>
                                <th style="width: 15%">
                                    Nama
                                </th>
                                <th style="width: 20%">
                                    Deskripsi
                                </th>
                                <th style="width: 5%">
                                    Status
                                </th>
                                <th style="width: 20%" class="text-center">
                                    Dana Terkumpul
                                </th>
                                <th style="width: 20%" class="text-center">
                                    Dana Diperlukan
                                </th>
                                <th style="width: 14%" class="text-center">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $key => $project)
                                <tr>
                                    <td>
                                        {{ $projects->firstItem() + $key }}
                                    </td>
                                    <td>
                                        <a>
                                            {{ $project->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a>
                                          {{ Str::limit($project->description, 45) }}
                                        </a>
                                    </td>
                                    <td>
                                        <a>
                                            {{ $project->progress_status }}
                                        </a>
                                    </td>
                                    <td class="project-state">
                                        @if ($project->current_capital == null)
                                        <a>
                                          Belum Terkumpul
                                        </a>
                                        @else
                                        <a>
                                          Rp. {{ number_format($project->current_capital, 0, '.', '.') }}
                                        </a>
                                        @endif
                                    </td>
                                    <td class="project-state">
                                        <a>
                                          Rp. {{ number_format($project->required_capital, 0, '.', '.') }}
                                        </a>
                                    </td>
                                    <td class="project-actions text-center">
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.project.details', $project->id) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            Detail
                                        </a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center mt-3">
                        <p> Halaman : {{ $projects->currentPage() }}</p> <br><br>
                        {{ $projects->links() }}
                    </div>
                    
                       
                    
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@stop

