@extends('frontview.master')
@section('title', 'Event')

@section('content')
    
<main id="main">
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Upcoming Events</h2>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page pt-4">
      <div class="container">
        <div class="card text-center">
          <div class="card-header">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                </div>
                <input type="text" class="form-control" placeholder="Search.." aria-label="Username" aria-describedby="basic-addon1">
              </div>
          </div>
          <div class="card-body">
            <div class="container" style="min-height:70vh">
              @foreach ($result as $event)                   
              <div class="row">
                <div class="col-md-3">
                  <div class="portfolio-details-slider swiper-container">
                    <div class="swiper-wrapper align-items-center">
                      @foreach($event->eventpic as $key=>$pic)
                        <div class="swiper-slide">
                          <img class="img-fluid"  src="{{$pic->photo_path}}" alt="">
                        </div>
                      @endforeach
                    </div>
                    @if($key > 1)
                      <div class="swiper-pagination"></div>
                    @endif
                </div>
                  
                </div>
                <div class="col-md-9">
                    <h1 class="text-left font-weight-bold">
                      {{$event->event_title}}
                    </h1>
                    <h5 class="text-left">
                      {{$event->event_description}}
                    </h5>
                    <p class="text-left font-italic">
                      Created By : {{$event->user->name}}
                      <br>
                      Posted On : {{$event->created_at->diffForHumans()}}
                    </p>
                </div>
                <br>
                <a type="button" href="{{ url('event/'.$event->id)}}" class="btn btn-primary">View Event</a>
            </div>
              <hr>
              @endforeach   
              
            </div>
        </div>
        <div class="card-footer">
            {{ $result->links("pagination::bootstrap-4") }}
        </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  @endsection
