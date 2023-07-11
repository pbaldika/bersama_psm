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
                        <h3 class="text-center mt-2">Pendanaan Yang Telah Diajukan</h3>
                    </div>


                    @if (isset($funding))
                        <h3 class="text-center">Ayok Mulai Berinvestasi! Mari Kita Maju Bersama</h3>
                    @else
                        @foreach ($fundings as $key => $funding)
                           
                            <div class="accordion accordion-flush px-xl-5" id="faqlist">
                                <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
                                    <h3 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faq-content-{{ $key }}">
                                            {{-- <div class="column">
                                            <div class="row"> --}}
                                            <div class="col-lg-6">
                                                <i class="bi bi-handbag-fill"></i>
                                                {{ $funding ? $funding->name : '' }}
                                            </div>
                                            <div class="col-lg-6 text-end">
                                                @if (!isset($funding->payment_proof))
                                                    <i class="bi bi-exclamation-circle-fill text-danger"></i> Mohon Lakukan
                                                    Pembayaran!</i>
                                                @elseif($funding->status == 'request')
                                                    <i class="bi bi-exclamation-circle-fill text-secondary"></i> Investasi
                                                    Masih
                                                    Dalam Verifikasi</i>
                                                @elseif($funding->status == 'active' && $funding->status == 'aktif')
                                                    <i class="bi bi-exclamation-circle-fill text-primary"></i> Investasi
                                                    Sedang
                                                    Berjalan</i>
                                                @else
                                                    <i class="bi bi-exclamation-circle-fill text-success"></i> Investasi
                                                    Telah
                                                    Selesai</i>
                                                @endif
                                            </div>
                                            {{-- </div>
                                        </div> --}}
                                        </button>

                                    </h3>
                                    <div id="faq-content-{{ $key }}" class="accordion-collapse collapse"
                                        data-bs-parent="#faqlist">
                                        <div class="accordion-body">
                                            <h4 class="text-center">
                                                Informasi Projek
                                            </h4>
                                            <div class="tab-content">
                                                <div class="tab-pane container bg-light mt-4 active">
                                                    <p class="fst-italic mt-">{{ $funding->description }}
                                                    </p>
                                                    <div class="pt-2">
                                                        {{-- <p class="mb-2">Dana Telah Terkumpulkan {{ $value }}%</p>
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: {{ $value }}%;"
                                                                aria-valuenow={{ $value }} aria-valuemin="0"
                                                                aria-valuemax="100">
                                                                {{ number_format($value, 2) }}%</div>
                                                        </div> --}}
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="d-flex flex-column mt-3 mb-3">
                                                                <p class="mb-2">Dana Yang Diperlukan</p>
                                                                <p class="fw-bold mb-2">Rp.
                                                                    {{ number_format($funding->required_capital, 0, '.', '.') }}
                                                                </p>
                                                            </div>
                                                            <div class="d-flex flex-column mt-3 mb-1">
                                                                <p class="mb-2">Margin Nisbah</p>
                                                                <p class="mb-0">Investor:
                                                                    <b>{{ $funding->profit_margin_investor }}%</b>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="d-flex flex-column mt-3 mb-3">
                                                                <p class="mb-2">Dana Yang Telah Terkumpulkan</p>
                                                                <p class="fw-bold mb-2">Rp.
                                                                    {{ number_format($funding->current_capital, 0, '.', '.') }}
                                                                </p>
                                                            </div>
                                                            <div class="d-flex flex-column mt-3 mb-3">
                                                                <p class="mb-2">Status</p>
                                                                <p class="fw-bold mb-2">
                                                                    {{ $funding->progress_status }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="text-center mt-4">
                                                Informasi Investasi
                                            </h4>
                                            <div class="row tab-content">
                                                <div class="col-lg-12 container bg-light mt-4 active">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="d-flex flex-column mt-3 mb-3">
                                                                <p class="mb-2">Total Investasi</p>
                                                                <p class="fw-bold mb-2">Rp.
                                                                    {{ number_format($funding->total, 0, '.', '.') }}
                                                                </p>
                                                            </div>
                                                            <div class="d-flex flex-column mt-3 mb-1">
                                                                <p class="mb-2">Keuntungan</p>
                                                                @if ($funding->profit == null)
                                                                    <p><b>Projek belum selesai.</b></p>
                                                                @else
                                                                    <p class="fw-bold mb-2">Rp.
                                                                        {{ number_format($funding->profit, 0, '.', '.') }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="d-flex flex-column mt-3 mb-3">
                                                                <p class="mb-2">Status</p>
                                                                <p class="fw-bold mb-2">{{ $funding->status }}</p>
                                                            </div>
                                                            <div class="d-flex flex-column mt-3 mb-3">
                                                                <p class="mb-2">Diajukan Pada</p>
                                                                <p class="fw-bold mb-2">
                                                                    {{ $funding->created_at->format('Y-m-d') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-lg-6">
                                                    @if (!isset($funding->payment_proof))
                                                        <a href="{{ route('proof-add', $funding->id) }}">
                                                            <button type="button" class="btn btn-primary">Upload
                                                                Bukti</button>
                                                        </a>
                                                        <p><i class="bi bi-exclamation-circle-fill text-danger"></i>
                                                            Investasi
                                                            anda belum ditambahkan karena belum terverifikasi</p>
                                                    @elseif($funding->status == 'request')
                                                        <p><b>Pembayaran anda sedang di verifikasi</b></p>
                                                        <p><i class="bi bi-exclamation-circle-fill text-danger"></i>
                                                            Investasi
                                                            anda belum ditambahkan karena belum terverifikasi</p>
                                                    @elseif($funding->status == 'active' && $funding->progress_status == 'aktif')
                                                        <p><b>Pembayaran anda telah di verifikasi</b></p>
                                                        <p><i class="bi bi-exclamation-circle-fill text-primary"></i>
                                                            Investasi
                                                            anda sedang berjalan</p>
                                                    @else
                                                        <p><i class="bi bi-exclamation-circle-fill text-success"></i>
                                                            Investasi
                                                            anda telah selesai</p>
                                                    @endif
                                                </div>
                                                <div class="col-lg-6">
                                                    <a href="{{ route('invoice', $funding->id) }}" rel="noopener"
                                                        target="_blank">
                                                        <button type="button" class="btn btn-primary">Cetak
                                                            Invoice</button>
                                                    </a>
                                                </div>
                                            </div>

                                        </div><!-- .accordion-body -->
                                    </div><!-- .accordion-collapse -->
                                </div><!-- .accordion-item -->
                            </div><!-- .accordion -->
                        @endforeach
                    @endif
                </div><!-- .d-flex -->
            </div><!-- .container -->
        </div><!-- .container-fluid -->
    </section><!-- #faq -->
@endsection
