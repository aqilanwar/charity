@extends('frontview.master')
@section('title', 'Home')

@section('content')
  <!-- ======= hero Section ======= -->
  <section id="hero">
    <div class="hero-content" data-aos="fade-up">
      <h2>We rise by lifting <br>others!<span style=" font-style: italic;">#IIUMCare</span> </h2>

      <div>
        <a href="{{route('list.event')}}" class="btn-get-started scrollto">Join Upcoming Charity Events</a>
        <a href="#portfolio" class="btn-projects scrollto">Donate</a>
      </div>
    </div>

    <div class="hero-slider swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide" style="background-image: url('frontview/assets/img/hero-carousel/1.jpg');" loading="lazy"></div>
        <div class="swiper-slide" style="background-image: url('frontview/assets/img/hero-carousel/2.jpg');" loading="lazy"></div>
        <div class="swiper-slide" style="background-image: url('frontview/assets/img/hero-carousel/3.jpg');" loading="lazy"></div>
        <div class="swiper-slide" style="background-image: url('frontview/assets/img/hero-carousel/4.jpg');" loading="lazy"></div>
        <div class="swiper-slide" style="background-image: url('frontview/assets/img/hero-carousel/5.jpg');" loading="lazy"></div>
      </div>
    </div>

  </section><!-- End Hero Section -->
<main id="main">

    <!-- ======= About Section ======= -->
    <section id="about">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-6 about-img">
            <img src="{{asset('frontview/assets/img/about-img.png')}}" loading="lazy" alt="">
          </div>

          <div class="col-lg-6 content">
            <h2>Lorem ipsum dolor sit amet, consectetur adipiscing</h2>
            <h3>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</h3>

            <ul>
              <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
              <li><i class="bi bi-check-circle"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
              <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
            </ul>

          </div>
        </div>

      </div>
    </section><!-- End About Section -->



    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>UPCOMING EVENTS</h2>
          <p>Sed tamen tempor magna labore dolore dolor sint tempor duis magna elit veniam aliqua esse amet veniam enim export quid quid veniam aliqua eram noster malis nulla duis fugiat culpa esse aute nulla ipsum velit export irure minim illum fore</p>
        </div>

        <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
            @foreach($result as $event)
            <div class="swiper-slide">
              <div class="testimonial-item">
                @foreach ($event->eventpic as $pic)
                @endforeach
                <img src="{{$pic->photo_path}}" class="img-fluid" alt="">
                <h3 class="text-left">{{$event->event_title}}</h3>
                <h4 class="text-left">
                  {{$event->event_description}}
                </h4>
                <div class="mt-3">
                  <div class="progress">
                      <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <div class="mt-1"> <span class="text1">32 Applied <span class="text2">of 50 capacity</span></span> </div>
                </div>
                <div class="mt-1">
                  <button class="btn btn-primary">View Event</button>
                </div>
              </div>
            </div>
            @endforeach
            <!-- End charity event -->
          </div>

          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Call To Action Section ======= -->
    <section id="call-to-action">
      <div class="container" data-aos="zoom-out">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-start">
            <h3 class="cta-title">Call To Action</h3>
            <p class="cta-text"> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="#">Call To Action</a>
          </div>
        </div>
      </div>
    </section><!-- End Call To Action Section -->

  </main><!-- End #main -->

  @endsection