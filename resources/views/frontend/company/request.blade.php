@extends('layouts.user')
@section('content')
<!-- ======= Contact Section ======= -->
@if(session('message'))
<h6 class="alert alert-success">
        {{ session('message') }}
    </h6>
@endif

<section id="contact" class="contact">
      <div class="container">

        <div class="section-header">
          <h2>Request a Purchase</h2>
          <p>Want to request a purchase? place the details of your purchase here by filling in the information</p>
        </div>

      </div>

      <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
      </div><!-- End Google Maps -->

      <div class="container">

        <div class="row gy-5 gx-lg-5">

          <div class="col-lg-4">

            </div>

          </div>

          <div class="col-lg-8">
            <form action="{{route('create-funding')}}" method="post">
            @csrf
            @method("POST")

              <div class="row">
                <div class="form-group mt-3">
                    <label>Nama Barang</label>
                  <input type="text" name="customerOrder" class="form-control mt-3" id="customerOrder" placeholder="Masukan Nama Barang Yang Ingin Dipesan" required>
                </div>
              </div>

              <div class="row">
                <div class="form-group mt-3">
                    <label>Deskripsi Barang</label>
                  <textarea name="description" class="form-control mt-3" id="description" placeholder="Masukan deskripsi barang yang diperlukan (dan bila ada, masukan referensi barang)" required></textarea>
                </div>
              </div>
              
              <div class="row">
                <div class="form-group mt-3">
                    <label>Tanggal Permintaan</label>
                    <input type="date" name="start_date" class="form-control mt-3" id="start_date" placeholder="Masukan Tanggal Permintaan Pembelian" required>
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
                    <label></label>
                </div>
              </div>

              <div class="row">
                <div class="form-group mt-3">
                    <label></label>
                </div>
              </div>

              <div class="row">
                <div class="form-group mt-3">
                    <label></label>
                </div>
              </div>

              <div class="row">
                <div class="form-group mt-3">
                    <label></label>
                </div>
              </div>

              <div class="row">
                <div class="form-group mt-3">
                    <label></label>
                </div>
              </div>

              <input type="hidden" name="customerName" id="customerName" value = "{{ Auth::user()->name}}">
              <input type="hidden" name="customer_id" id="customer_id" value = "{{ Auth::user()->id}}">
              <input type="hidden" name="status" id="status" value ="request">
              <input type="hidden" name="company_registration_number" id="company_registration_number" value = "{{ Auth::user()->IDNumber}}">
              

              <div class="text-center"><button type="submit">Kirim Permintaan</button></div>
              
              <!-- <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your order has been processed. Thank you!</div>
              </div> -->
            </form>
          </div><!-- End Contact Form -->
@stop