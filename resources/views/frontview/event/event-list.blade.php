@extends('frontview.master')

@section('content')
    
<main id="main">
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Upcoming Events</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Upcoming Events</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page pt-4">
      <div class="container">
        <div class="card text-center">
          <div class="card-header">
            <ul class="nav nav-pills card-header-pills">
              <li class="nav-item">
                <a class="nav-link active" href="#">Active</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="container">
              @foreach ($result as $event)                   
              <div class="row">
                <div class="col-md-3">
                  <img  class="img-fluid" src="{{$event->eventpic->photo_path}}" alt="">
                </div>
                <div class="col-md-9">
                    <h1 class="text-left font-weight-bold">
                      {{$event->event_title}}
                    </h1>
                    <h5 class="text-left">
                      {{$event->event_description}}
                    </h5>
                    <p class="text-left font-italic">
                      Created By : {{$event->user->email}}
                      <br>
                      {{-- Posted On : {{$event->created_at->diffForHumans()}} --}}
                    </p>
                </div>
                <br>
                <button type="button" class="btn btn-primary">View Event</button>
              </div>
              <hr>
              @endforeach   
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  @endsection
