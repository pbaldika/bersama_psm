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
                <h3 class="card-title">Daftar User</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-header">
                <nav class="navbar navbar-light bg-light">
                    <form class="form-inline" action="{{ route('admin.user.search') }}" method="GET">
                        <div class="d-flex">
                            <a href="{{ route('admin.user.create') }}" class="btn btn-success ml-2 mr-2 my-2 my-sm-0">Buat
                                User</a>
                            <!-- Role filter -->
                            @csrf
                            <input class="form-control mr-sm-2 ms-2" type="search" placeholder="Cari User"
                                aria-label="Search" name="user-search" id="user-search">
                            <button class="btn btn-outline-success my-2 my-sm-0 ms-2" type="submit">Cari User</button>
                        </div>
                    </form>
                    <form action="{{ route('admin.user') }}" id="user-filter-form">
                        <select class="form-control mr-sm-2 ms-2 ml-2" name="role" id="role-filter">
                            <option selected disabled>Pilih Peran</option>
                            <option value="">Semua Peran</option>
                            <option value="user">Investor</option>
                            <option value="company">Company</option>
                            <option value="admin">Admin</option>
                        </select>
                    </form>
                </nav>

                <script>
                    // Listen for change event on the role filter select element
                    document.getElementById('role-filter').addEventListener('change', function() {
                        // Trigger form submission when the role filter changes
                        document.getElementById('user-filter-form').submit();
                        if(selectedValue==null){
                          location.reload();
                        }
                    });
                </script>
            </div>
            <div class="card-body p-0">
                <div id="user-list-container">
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
                                    Email
                                </th>
                                <th style="width: 5%">
                                    Peran
                                </th>
                                <th style="width: 20%" class="text-center">
                                    Telefon
                                </th>
                                <th style="width: 20%" class="text-center">
                                    Alamat
                                </th>
                                <th style="width: 14%" class="text-center">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>
                                        {{ $users->firstItem() + $key }}
                                    </td>
                                    <td>
                                        <a>
                                            {{ $user->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a>
                                            {{ $user->email }}
                                        </a>
                                    </td>
                                    <td>
                                        <a>
                                            {{ $user->role }}
                                        </a>
                                    </td>
                                    <td class="project-state">
                                        <a>
                                            {{ $user->telephone }}
                                        </a>
                                    </td>
                                    <td class="project-state">
                                        <a>
                                            {{ $user->address }}
                                        </a>
                                    </td>
                                    <td class="project-actions text-center">
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.user.show', $user->id) }}">
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
                        <p> Page : {{ $users->currentPage() }}</p> <br><br>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@stop
