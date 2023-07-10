@extends('layouts.user')
@section('content')
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        @if (session('message'))
        <h6 class="alert alert-success">
            {{ session('message') }}
        </h6>
    @endif
        <div class="container">
            <div class="section-header">
                <h2>Permohonan Pembelian Barang</h2>
                <p>Ingin membuat pemesanan barang? Isi details disini untuk mengajukan permintaan</p>
            </div>
        </div>
        <div class="container">
        </div>

        <div class="container col-lg-8">
            <form action="{{ route('create-funding') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="form-group mt-3">
                        <label>Nama Barang</label>
                        <input type="text" name="customerOrder" class="form-control mt-3" id="customerOrder"
                            placeholder="Masukan Nama Barang Yang Ingin Dipesan" required>
                        @error('customerOrder')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group mt-3">
                        <label>Deskripsi Barang</label>
                        <textarea name="description" class="form-control mt-3" id="description"
                            placeholder="Masukan deskripsi barang yang diperlukan (dan bila ada, masukan referensi barang)" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group mt-3">
                        <label>Tanggal penerimaan</label>
                        <input type="date" name="end_date" class="form-control mt-3" id="end_date" placeholder="Masukan Estimasi Tanggal Barang Diterima" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group mt-3">
                        <label>Informasi Tambahan</label>
                        <p><small><em>Masukan Informasi Tambahan Seperti Link Pejelasan Barang</em></small></p>
                        <input type="text" name="information" class="form-control mt-3" id="information"
                            placeholder="www.example.com">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group mt-3">
                        <label>Upload Contoh Gambar Barang</label>
                        <p><small><em>Masukan Contoh Foto Pesanan</em></small></p>
                        <input type="file" class="form-control" name="image">

                        @error('registration_photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <input id="verified" type="hidden" name="verified" value="request">
        </div>
        <input type="hidden" name="customerName" id="customerName" value="{{ Auth::user()->name }}">
        <input type="hidden" name="customer_id" id="customer_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="status" id="status" value="request">
        <input type="hidden" name="start_date" id="start_date" value="{{ now() }}">
        <input type="hidden" name="company_registration_number" id="company_registration_number"
            value="{{ Auth::user()->IDNumber }}">

        <div class="text-center mt-5">
            <button type="submit" class="btn btn-success btn-lg">Upload Pemesanan</button>
        </div>

        <!-- <div class="my-3">
                                                    <div class="loading">Loading</div>
                                                    <div class="error-message"></div>
                                                    <div class="sent-message">Your order has been processed. Thank you!</div>
                                                  </div> -->
        </form>
        </div><!-- End Contact Form -->
    @stop
