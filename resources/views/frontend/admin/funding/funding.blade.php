@extends('layouts.admin')
@section('content')
<!-- Main content -->

@if(session('message'))
    <h6 class="alert alert-danger">
        {{ session('message') }}
    </h6>
@endif
<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Fundings</h3>
     
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>

    <div class="card-header">
      <!-- Search funding -->
      <nav class="navbar navbar-light bg-light">
        <form class="form-inline" action="{{ route('admin.funding.search') }}" method="GET">
            <div class="d-flex">
                <a href="{{ route('admin.funding.create') }}" class="btn btn-success ml-2 mr-2 my-2 my-sm-0">Buat
                    Order</a>
                <!-- Role filter -->
                @csrf
                <input class="form-control mr-sm-2 ms-2" type="search" placeholder="Cari Order"
                    aria-label="Search" name="funding-search" id="funding-search">
                <button class="btn btn-outline-success my-2 my-sm-0 ms-2" type="submit">Cari Order</button>
            </div>
        </form>
        <form action="{{ route('admin.funding') }}" id="funding-filter-form">
            <select class="form-control mr-sm-2 ms-2 ml-2" name="role" id="funding-filter">
                <option selected disabled>Pilih Status</option>
                <option value="">Semua Peran</option>
                <option value="active">Aktif</option>
                <option value="selesai">Selesai</option>
            </select>
        </form>
        <script>
          // Listen for change event on the role filter select element
          document.getElementById('funding-filter').addEventListener('change', function() {
              // Trigger form submission when the role filter changes
              document.getElementById('funding-filter-form').submit();
              if(selectedValue==null){
                location.reload();
              }
          });
      </script>
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
              Perusahaan
            </th>
            <th style="width: 20%">
              Barang Pesanan
            </th>
            <th style="width: 5%">
              Tanggal Terima
            </th>
            <th style="width: 20%" class="text-center">
              Status
            </th>
            <th style="width: 14%" class="text-center">
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($fundings as $key => $funding)
          <tr>
            <td>
              {{$fundings->firstItem() + $key}}
            </td>
            <td>
              <a>
                {{$funding->customerName}}
              </a>
            </td>
            <td>
              <a>
                {{$funding->customerOrder}}
              </a>
            </td>
            <td>
              <a>
                {{$funding->end_date}}
              </a>
            </td>
            <td class="project-state">
              <a>
                {{$funding->status}}
              </a>
            </td>
            <td class="project-actions text-center">
              <a class="btn btn-primary btn-sm" href="{{route('admin.funding.details', $funding->id)}}">
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
        <p> Page : {{$fundings->currentPage()}}</p> <br><br>
      </div>
      <div class="d-flex justify-content-center">
        {{$fundings->links()}}
      </div>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->
@stop