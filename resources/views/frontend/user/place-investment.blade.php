@extends('layouts.user')
@section('content')
    <section id="contact" class="contact">
        @if (session('message'))
            <h6 class="alert alert-success">
                {{ session('message') }}
            </h6>
        @endif
        <div class="container">

            <div class="section-header">
                <h2>Buat Pemesenan Investasi</h2>
            </div>

        </div>
        <div class="container">

            <div class="row gy-5 gx-lg-5">

                <div class="col-lg-4">

                    <div class="info">
                        <h3>{{ $project->name }}</h3>
                        <p>{{ $project->description }}</p>

                        <div class="info-item d-flex">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h4>Company:</h4>
                                <p>{{ $company->name }}</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h4>Maksimum Ajuan Investasi</h4>
                                @php
                                    $available = $project->required_capital - $project->current_capital;
                                @endphp
                                <p>Rp. {{ number_format($available, 0, '.', '.') }}</p>
                            </div>
                        </div><!-- End Info Item -->

                    </div>

                </div>

                <div class="col-lg-8">
                    <form action="{{ route('place-investment', $project->id) }}" method="post">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="form-group mt-3">
                                <label>Masukan Jumlah Ajuan</label>
                                <input type="text" name="total" class="form-control mt-3" id="total"
                                    placeholder="Mohon Masukan Jumlah" required>
                            </div>
                        </div>

                        <input type="hidden" name="status" id="status" value="request">
                        <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}">


                        <!-- <div class="my-3">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your order has been processed. Thank you!</div>
                      </div> -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Ajukan</button>
                        </div>
                    </form>
                </div><!-- End Contact Form -->
            @stop
