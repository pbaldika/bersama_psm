@extends('layouts.user')
@section('content')


<section id="faq" class="faq">
<br>
<br>
<br>
<br>
<br>
<br>
      <div class="container-fluid" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

            <div class="content px-xl-5">
              <h3>Frequently Asked <strong>Questions</strong></h3>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
              </p>
            </div>

            @foreach($investments as $key=>$investment)
            <div class="accordion accordion-flush px-xl-5" id="faqlist">

              <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                    <i class="bi bi-question-circle question-icon"></i>
                    {{$investment->id}}
                    {{$investment->name}}
                  </button>
                </h3>
                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                  <div class="accordion-body">
                    Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.

                    <a href="{{route('proof-add', $investment->id)}}"><button type ="button" class="btn btn-primary">Upload Payment Proof</button></a>
                  </div>
                </div>
              </div><!-- # Faq item-->
              
            </div>
            @endforeach
          </div>

          <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("assets/img/faq.jpg");'>&nbsp;</div>
        </div>

      </div>
    </section>
@stop