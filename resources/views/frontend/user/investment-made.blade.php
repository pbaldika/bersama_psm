@extends('layouts.user')

@section('content')
    <section id="faq" class="faq">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="container-fluid" data-aos="fade-up">
            <div class="container">
                <div class="d-flex flex-column justify-content-center align-items-stretch">
                    <div class="content px-xl-5">
                        <h3>Investasi Yang Telah Dibuat</h3>
                        <p>

                        </p>
                    </div>
                    @foreach ($investments as $key => $investment)
                        @php
                            $project = isset($projects[$investment->project_id]) ? $projects[$investment->project_id] : null;
                        @endphp
                        <div class="accordion accordion-flush px-xl-5" id="faqlist">
                            <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
                                <h3 class="accordion-header">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                  data-bs-target="#faq-content-{{ $key }}">
                              <div class="row">
                                  <div class="col-lg-6">
                                      <i class="bi bi-question-circle question-icon"></i>
                                      {{ $project ? $project->name : '' }}
                                  </div>
                                  <div class="col-lg-6 text-end ps-lg-4">
                                      @if (!isset($investment->payment_proof))
                                          <i class="bi bi-info-circle-fill"></i>
                                          <p>Mohon Lakukan Pembayaran!</p>
                                      @endif
                                  </div>
                              </div>
                          </button>
                          
                                </h3>
                                <div id="faq-content-{{ $key }}" class="accordion-collapse collapse"
                                    data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                {{ $investment->total }}
                                                {{ $investment->status }}
                                            </div>
                                        </div>
                                        @if (!isset($investment->payment_proof))
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <a href="{{ route('proof-add', $investment->id) }}">
                                                        <button type="button" class="btn btn-primary">Upload Payment Proof</button>
                                                    </a>
                                                </div>
                                            </div>
                                        @elseif(isset($investment->payment_proof))
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    Pembayaran anda sedang di verifikasi
                                                </div>
                                            </div>
                                        @endif
                                    </div><!-- .accordion-body -->
                                </div><!-- .accordion-collapse -->
                            </div><!-- .accordion-item -->
                        </div><!-- .accordion -->
                    @endforeach
                </div><!-- .d-flex -->
            </div><!-- .container -->
        </div><!-- .container-fluid -->
    </section><!-- #faq -->
@endsection
