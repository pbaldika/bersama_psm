@extends('layouts.user')
@section('content')

    <!-- ======= Recent Blog Posts Section ======= -->
    <section id="recent-blog-posts" class="recent-blog-posts">

      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Available Investments</h2>
          <p>Recent posts form our Blog</p>
        </div>
        
        <div class="row">
        @foreach($projects as $key => $project)
          <div class="col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="post-box">
              <div class="post-img"><img src="assets/img/blog/blog-1.jpg" class="img-fluid" alt=""></div>
              <div class="meta">
                <span class="post-date">Tue, December 12</span>
                <span class="post-author">{{$project->name}}</span>
              </div>
              <h3 class="post-title">Eum ad dolor et. Autem aut fugiat debitis voluptatem consequuntur sit</h3>
              <p>Illum voluptas ab enim placeat. Adipisci enim velit nulla. Vel omnis laudantium. Asperiores eum ipsa est officiis. Modi cupiditate exercitationem qui magni est...</p>
              <a href="{{route('investment-details', $project->id)}}" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          @endforeach
        </div>
        

      </div>

    </section><!-- End Recent Blog Posts Section -->
@stop