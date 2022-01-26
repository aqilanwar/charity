@extends('frontview.master')
@section('title', 'Event')

@section('content')
    
<main id="main">
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Search result for "{{$_GET['search_event']}}"</h2> <a class="btn btn-success" href="{{ url('/event') }}" class="btn btn-success">Show all event</a>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    <div class="container" style="min-height:90vh">
      <div class="container-fluid mt-100">
        <form action="{{route('search.event.front')}}" method="GET">     
            <div class="input-group mb-3">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
              <input type="text" class="form-control" name="search_event" placeholder="Search event title" aria-label="Search event title" aria-describedby="basic-addon2">
            </div>          
          </form>

        @if(count($result) < 1)
        <div class="card-body">
            <p>No result.</p>
        </div>
        @else            
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
                    <div class="col">
                        <img class="img-fluid" src="{{asset($event->image)}}" alt="Event pic">
                    </div>
                    <div class="col"> <a href="{{ url('event/'.$event->id)}}" class="text-big" data-abc="true">{{$event->event_title}}</a> 
                        <div class="text-muted small mt-1">{{ \Carbon\Carbon::parse($event->event_date)->format('d M y')}}&nbsp;·&nbsp; <a href="javascript:void(0)" class="text-muted" data-abc="true">{{$event->event_place}}</a></div>                        
                      <div class="mt-3">
                            <span class="text1">Maximum participant : {{$event->event_max}}</span>
                      </div>
                    </div>

                    <div class="d-none d-md-block col-4">
                        <div class="row no-gutters align-items-center">
                            <div class="media col-8 align-items-center"> 
                              @if($event->profile_pic != NULL)
                                <img src="/storage/{{$event->profile_pic}}" alt="" style="height: 4rem;width: 4rem;border-radius: 50%;">
                              @else
                                <img src="/storage/profile-photos/default.png" alt="" style="height: 4rem;width: 4rem;border-radius: 50%;">
                              @endif
                                <div class="media-body flex-truncate ml-2">
                                    <div class="line-height-1 text-truncate"> {{ \Carbon\Carbon::parse($event->created_at)->format('d M y H:i:s ')}} </div> <a href="javascript:void(0)" class="text-muted small text-truncate" data-abc="true">by {{$event->name}}</a>
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
        @endif
      
    </div>
    </div>
  

  </main><!-- End #main -->
  <div class="mb-5"></div>

  @endsection
