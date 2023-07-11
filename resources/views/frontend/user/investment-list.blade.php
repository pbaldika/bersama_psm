@extends('layouts.user')
@section('content')

    <!-- ======= Recent Blog Posts Section ======= -->
    <section id="projects" class="projects">

        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Daftar Projek</h2>
                <p>Berbagai Projek yang bisa kalian pilih untuk berinvestasi</p>
            </div>

            <div class="row">
                @foreach ($projects as $key => $project)
                    @if ($project->progress_status === 'aktif')
                    <div class="col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="200">
                        <div class="post-box bg-light">
                            <div class="img d-flex justify-content-center align-items-center mt-1">
                                <img class="img-fluid mb-3 project-image" src="{{ url('pro/' . $project->project_photo) }}" style="max-height: 200px; max-width: 100%;">
                            </div>
                            <div class="details position-relative">
                                <div class="container bg-light">
                                    @php
                                        $currentCapital = (float) $project->current_capital;
                                        $requiredCapital = (float) $project->required_capital;
                                        $value = ($currentCapital / $requiredCapital) * 100;
                                    @endphp
                                    <div class="pt-2">
                                        <a href="{{ route('investment-details', $project->id) }}" class="stretched-link">
                                            <h3>{{ $project->name }}</h3>
                                        </a>
                                        <p class="mb-2">Dana Telah Terkumpulkan {{ $value }}%</p>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $value }}%;" aria-valuenow="{{ $value }}" aria-valuemin="0" aria-valuemax="100">
                                                {{ number_format($value, 2) }}%
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="d-flex flex-column mt-3 mb-3">
                                                <p class="mb-2">Jumlah Dana</p>
                                                <p class="fw-bold mb-2">Rp. {{ number_format($project->required_capital, 0, '.', '.') }}</p>
                                            </div>
                                            <div class="d-flex flex-column mt-3 mb-1">
                                                <p class="mb-2">Margin Nisbah</p>
                                                <p class="mb-0">Bersama: <b>{{ $project->profit_margin_bersama }}%</b></p>
                                                <p class="mb-0">Investor: <b>{{ $project->profit_margin_investor }}%</b></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="d-flex flex-column mt-3 mb-3">
                                                <p class="mb-2">Terkumpulkan</p>
                                                <p class="fw-bold mb-2">Rp. {{ number_format($project->current_capital, 0, '.', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>

        </div>

    </section><!-- End Recent Blog Posts Section -->
@stop
