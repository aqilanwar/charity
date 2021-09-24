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

    <div class="container">
      <div class="container-fluid mt-100">
        <div class="d-flex flex-wrap justify-content-between">
            <div class="col-12 col-md-3 p-0 mb-3"> <input type="text" class="form-control" placeholder="Search..."> </div>
        </div>
        <div class="card mb-3">
            <div class="card-header pl-0 pr-0">
                <div class="row no-gutters w-100 align-items-center">
                    <div class="col ml-3">Event Title</div>
                    <div class="col-4 text-muted">
                        <div class="row no-gutters align-items-center">
                            <div class="col-8">Organizer / Created At</div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Event Div --}}
            @foreach ($result as $event)
              <div class="card-body py-3">
                <div class="row no-gutters align-items-center">
                    <div class="col"> <a href="{{ url('event/'.$event->id)}}" class="text-big" data-abc="true">{{$event->event_title}}</a> 
                        <div class="text-muted small mt-1">{{$event->event_date->format('d M Y')}} &nbsp;·&nbsp; <a href="javascript:void(0)" class="text-muted" data-abc="true">{{$event->event_place}}</a></div>                        
                      <div class="mt-3">
                        <div class="col-md-5">
                          <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="mt-1"> <span class="text1">32 Applied <span class="text2">of 50 capacity</span></span> </div>
                        </div>
                      </div>
                    </div>

                    <div class="d-none d-md-block col-4">
                        <div class="row no-gutters align-items-center">
                            <div class="media col-8 align-items-center"> <img src="/storage/{{$event->user->profile_photo_path}}" alt="" style="height: 4rem;width: 4rem;border-radius: 50%;">
                                <div class="media-body flex-truncate ml-2">
                                    <div class="line-height-1 text-truncate">{{$event->created_at->diffForHumans()}}</div> <a href="javascript:void(0)" class="text-muted small text-truncate" data-abc="true">by {{$event->user->name}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="m-0">
            @endforeach
            
            {{-- End Event Div --}}

        </div>
        <nav>
            <ul class="pagination mb-5">
              {{ $result ->links("pagination::bootstrap-4") }}
            </ul>
        </nav>
    </div>
    </div>
  

  </main><!-- End #main -->

  @endsection
