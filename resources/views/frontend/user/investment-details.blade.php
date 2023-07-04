@extends('layouts.user')
@section('content')
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2>Detail Projek</h2>
            </div>
            <div name="main" class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">
                <div class="col-lg-5">
                    <div class="about-img">
                        <img src="{{ url('pro/' . $project->project_photo) }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-7">
                    <h3 class="pt-0 pt-lg-5">{{ $project->name }}</h3>
                    <a href="{{ route('place-start', $project->id) }}"><button type="button" class="btn btn-primary">Invest
                            Now</button></a>
                    <!-- Tabs -->
                    <ul class="nav nav-pills mb-3">
                        <li><a class="nav-link active" data-bs-toggle="pill" href="#tab1">Ringkasan</a></li>
                        {{-- <li><a class="nav-link" data-bs-toggle="pill" href="#tab2">Tata Cara Berinvestasi</a></li> --}}
                    </ul><!-- End Tabs -->
                    <!-- Tab Content -->
                    <div class="tab-content">
                        <p class="fst-italic">{{ $project->description }}
                        </p>
                        <div class="container bg-light mt-4">
                            @php
                                $currentCapital = (float) $project->current_capital;
                                $requiredCapital = (float) $project->required_capital;
                                $value = ($currentCapital / $requiredCapital) * 100;
                            @endphp
                            <div class="pt-2">
                                <p class="mb-2">Dana Telah Terkumpulkan {{ $value }}%</p>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $value }}%;"
                                        aria-valuenow={{ $value }} aria-valuemin="0" aria-valuemax="100">
                                        {{ number_format($value, 2) }}%</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column mt-3 mb-3">
                                        <p class="mb-2">Dana Yang Diperlukan</p>
                                        <p class="fw-bold mb-2">Rp.
                                            {{ number_format($project->required_capital, 0, '.', '.') }}</p>
                                    </div>
                                    <div class="d-flex flex-column mt-3 mb-1">
                                        <p class="mb-2">Margin Nisbah</p>
                                        <p class="mb-0">Bersama: <b>{{ $project->profit_margin_bersama }}%</b></p>
                                        <p class="mb-0">Investor: <b>{{ $project->profit_margin_investor }}%</b></p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex flex-column mt-3 mb-3">
                                        <p class="mb-2">Dana Yang Telah Terkumpulkan</p>
                                        <p class="fw-bold mb-2">Rp.
                                            {{ number_format($project->current_capital, 0, '.', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="tab1">
                            {{-- <div class="d-flex align-items-center mt-4">
                                <i class="bi bi-check2"></i>
                                <h4>Incidunt non veritatis illum ea ut nisi</h4>
                            </div>
                            <p>Non quod totam minus repellendus autem sint velit. Rerum debitis facere soluta tenetur. Iure
                                molestiae assumenda sunt qui inventore eligendi voluptates nisi at. Dolorem quo tempora.
                                Quia et perferendis.</p>

                            <div class="d-flex align-items-center mt-4">
                                <i class="bi bi-check2"></i>
                                <h4>Omnis ab quia nemo dignissimos rem eum quos..</h4>
                            </div>
                            <p>Eius alias aut cupiditate. Dolor voluptates animi ut blanditiis quos nam. Magnam officia aut
                                ut alias quo explicabo ullam esse. Sunt magnam et dolorem eaque magnam odit enim quaerat.
                                Vero error error voluptatem eum.</p> --}}

                        </div><!-- End Tab 1 Content -->
                        <div class="tab-pane fade" id="tab2">
                            <p class="fst-italic">Consequuntur inventore voluptates consequatur aut vel et. Eos doloribus
                                expedita. Sapiente atque consequatur minima nihil quae aspernatur quo suscipit voluptatem.
                            </p>
                            <div class="d-flex align-items-center mt-4">
                                <i class="bi bi-check2"></i>
                                <h4>Repudiandae rerum velit modi et officia quasi facilis</h4>
                            </div>
                            <p>Laborum omnis voluptates voluptas qui sit aliquam blanditiis. Sapiente minima commodi dolorum
                                non eveniet magni quaerat nemo et.</p>
                            <div class="d-flex align-items-center mt-4">
                                <i class="bi bi-check2"></i>
                                <h4>Incidunt non veritatis illum ea ut nisi</h4>
                            </div>
                            <p>Non quod totam minus repellendus autem sint velit. Rerum debitis facere soluta tenetur. Iure
                                molestiae assumenda sunt qui inventore eligendi voluptates nisi at. Dolorem quo tempora.
                                Quia et perferendis.</p>

                            <div class="d-flex align-items-center mt-4">
                                <i class="bi bi-check2"></i>
                                <h4>Omnis ab quia nemo dignissimos rem eum quos..</h4>
                            </div>
                            <p>Eius alias aut cupiditate. Dolor voluptates animi ut blanditiis quos nam. Magnam officia aut
                                ut alias quo explicabo ullam esse. Sunt magnam et dolorem eaque magnam odit enim quaerat.
                                Vero error error voluptatem eum.</p>
                        </div><!-- End Tab 2 Content -->
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End About Section -->
@stop
