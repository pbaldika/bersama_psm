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
                            <div class="post-box">
                                <div class="post-img d-flex justify-content-center align-items-center">
                                    <img class="mx-auto img-fluid mb-3 project-image"
                                        src="{{ url('pro/' . $project->project_photo) }}">
                                </div>
                                <h3 class="post-title">{{ $project->name }}
                                </h3>
                                <p>{{ Str::limit($project->description, 45) }}</p>
                                <a href="{{ route('investment-details', $project->id) }}"
                                    class="readmore stretched-link"><span>Read More</span><i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

        </div>

    </section><!-- End Recent Blog Posts Section -->
@stop
