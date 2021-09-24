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
                <li><strong>Posted On</strong>: {{$events->created_at->diffForHumans()}}</li>
                <li><strong>Event Date</strong>: {{$events->event_date->diffForHumans()}}</li>
                <li><strong>Event Place</strong>: {{$events->event_place}}</li>
                <li><strong>Created By</strong>: <img src="/storage/{{$events->user->profile_photo_path}}" alt="" style="height: 2rem;width: 2rem;border-radius: 50%;"> {{$events->user->name}}</li>
                <div class="mt-4">
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <div class="mt-1"> <span class="text1">32 Applied <span class="text2">of 50 capacity</span></span> </div>
                </div>
                <div class="mt-4">
                  <button class="btn btn-primary btn-block">Join Event</button>
                </div>
              </ul>
            </div>
          </div>

        </div>

        <div class="col-lg-8">
          <div class="portfolio-info">

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