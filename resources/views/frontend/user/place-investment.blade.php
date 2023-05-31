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
          <h2>Contact Us</h2>
          <p>Ea vitae aspernatur deserunt voluptatem impedit deserunt magnam occaecati dssumenda quas ut ad dolores adipisci aliquam.</p>
        </div>

      </div>

      <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
      </div><!-- End Google Maps -->

      <div class="container">

        <div class="row gy-5 gx-lg-5">

          <div class="col-lg-4">

            <div class="info">
              <h3>{{$project->name}}</h3>
              <p>{{$project->description}}</p>

              <div class="info-item d-flex">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h4>Company:</h4>
                  <p>{{$project->investor}}</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h4>Email:</h4>
                  <p>info@example.com</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-phone flex-shrink-0"></i>
                <div>
                  <h4>Call:</h4>
                  <p>+1 5589 55488 55</p>
                </div>
              </div><!-- End Info Item -->

            </div>

          </div>

          <div class="col-lg-8">
            <form action="{{route('place-investment', $project->id)}}" method="post">
            @csrf
            @method("POST")
              <div class="row">
                <div class="form-group mt-3">
                    <label>Investment Total</label>
                  <input type="text" name="total" class="form-control mt-3" id="total" placeholder="Enter the amount (IDR)" value = "" required>
                </div>
              </div>

              <input type="hidden" name="status" id="status" value = "active">
              <input type="hidden" name="user_id" id="user_id" value = "{{ Auth::user()->id }}">
              <input type="hidden" name="project_id" id="project_id" value = "{{$project->id}}">
              
              
              <!-- <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your order has been processed. Thank you!</div>
              </div> -->
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div><!-- End Contact Form -->
@stop