@extends('frontview.master')
@section('title', 'View Event')

@section('content')
<main id="main">

    <!-- ======= Portfolio Details Section ======= -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container" style="min-height: 80vh">
        <div class="row gy-4">
          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper-container ">
              <div class="swiper-wrapper align-items-center ">
                @foreach($events->eventpic as $pic)
                <div class="swiper-slide">
                  <img style="max-height:70vh" src="../{{$pic->photo_path}}" alt="">
                </div>
                @endforeach
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>{{$events->event_title}}</h3>
              <ul>
                <li><strong>Event Date</strong>: {{$events->event_date->diffForHumans()}}</li>
                <li><strong>Event Place</strong>: {{$events->event_place}}</li>
                <li><strong>Created By</strong>: {{$events->user->name}}</li>
              </ul>
            </div>
            <div class="portfolio-description">
              <h2>Event Description</h2>
              <p>
                  {{$events->event_description}}
              </p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

@endsection