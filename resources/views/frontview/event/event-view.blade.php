@extends('frontview.master')
@section('title', 'View Event')

@section('content')
<main id="main">

    <!-- ======= Portfolio Details Section ======= -->

    <section id="portfolio-details" class="portfolio-details">
      
      <div class="container" style="min-height: 80vh">
        @if(session('success')) 
          <div class="alert alert-success" role="alert">
            {{session('success')}}
          </div>
        @endif
        <div class="row gy-4">
          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper-container ">
              <div class="swiper-wrapper align-items-center ">
                @if(count($events->eventpic) == 1)
                  @foreach($events->eventpic as $pic)
                      <img style="max-height:70vh" src="../{{$pic->photo_path}}" alt="">
                  @endforeach                
                @else 
                  @foreach($events->eventpic as $pic)
                    <div class="swiper-slide">
                      <img style="max-height:70vh" src="../{{$pic->photo_path}}" alt="">
                    </div>
                  @endforeach
                @endif

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>{{$events->event_title}}</h3>
              <ul>
                <li><strong>Posted On</strong>: {{$events->created_at->format('d M Y')}}</li>
                <li><strong>Event Date</strong>: {{$events->event_date->format('d M Y')}}</li>
                <li><strong>Event Place</strong>: {{$events->event_place}}</li>
                <li><strong>Created By</strong>: 
                  @if($events->user->profile_photo_path != NULL)
                    <img src="/storage/{{$events->user->profile_photo_path}}" alt="pfp" style="height: 2rem;width: 2rem;border-radius: 50%;"> {{$events->user->name}}</li>
                  @else 
                    <img src="/storage/profile-photos/default.png" alt="pfp" style="height: 2rem;width: 2rem;border-radius: 50%;"> {{$events->user->name}}</li>
                  @endif
                <div class="mt-4">
                  <div class="p-1 mb-2 bg-success text-white">
                    <span class="text1">Participant : {{$join}} / {{$events->event_max}}</span>
                  </div>
                 </div>
                 @if (Auth::check()) 
                  @if(Auth::user()->role_id == '2')
                    <div class="mt-4">
                      <a class="btn btn-primary" target="_blank" href="../event/edit/{{$events->id}}" style="width:100%">
                        Manage Event
                      </a>                      
                    </div>  
                  @else 
                    {{-- If user is not the organizer of the event --}}
                    @if ($organizer == NULL)
                      {{-- If user is not in the event--}}
                      @if ($user == NULL) 
                        {{-- Check if event date is still valid or not--}}
                        @if ($events->event_date <  Carbon\Carbon::today())
                          Event date has passed.
                        @else
                          @if ($events->event_max <= $join)
                              Event is already full.
                          @else
                              <div class="mt-4">
                                <form action="{{ route('join.event') }}" method="POST" >
                                  @csrf
                                  <input type="hidden" name="event_id" value="{{$events->id}}">
                                  <button class="btn btn-primary" id="btn-join" type="submit" style="width:100%">
                                    Take part as participant
                                  </button>       
                                </form>               
                              </div>  
                          @endif  
                        @endif
                      {{-- If user is already joined the event--}}                    
                      @else
                        @if ($events->event_date <  Carbon\Carbon::today())
                          Thank you for your participation.
                        @else
                        <div class="mt-4">
                          <form action="{{ route('join.cancel') }}" method="POST" >
                            @csrf
                            <input type="hidden" name="event_id" value="{{$events->id}}">
                            <button class="btn btn-danger" id="btn-cancel" type="submit" style="width:100%">
                              Cancel participation
                            </button>       
                          </form>                   
                        </div>  
                        @endif
                    
                      @endif                           
                    @else
                      <div class="mt-4">
                        <a class="btn btn-primary" href="../event/edit/{{$events->id}}" style="width:100%">
                          Manage Event
                        </a>                      
                      </div>  
                    @endif
                  @endif
                  @else
                    <div class="mt-4">
                      <a class="btn btn-primary" href="{{route('login')}}" style="width:100%">
                        Take part as participant 
                      </a>                      
                    </div>
                  @endif
              </ul>
            </div>
          </div>

        </div>

        <div class="col-lg-8">
          <div class="portfolio-info">
            <div class="portfolio-description">
              <h2>Event Description</h2>
              <p>
                {!! html_entity_decode($events->event_description) !!}
              </p>
            </div>
          </div>  
        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $( document ).ready(function() {
    $('#btn-join').on('click',function(e){
                e.preventDefault();
                var form = $('form');
                swal.fire({
                    title: "Are you sure to take part in this event ?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, submit my participation",
                }).then(function (result){
                    if(result.value === true){
                    console.log("Submitted");
                    form.submit();
                  }
                })
            })
  });
  $( document ).ready(function() {
    $('#btn-cancel').on('click',function(e){
                e.preventDefault();
                var form = $('form');
                swal.fire({
                    title: "Are you sure to cancel your participation in this event ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, cancel my participation",
                }).then(function (result){
                    if(result.value === true){
                    console.log("Submitted");
                    form.submit();
                  }
                })
            })
  });
</script>
@endsection