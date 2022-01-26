@extends('admin.index')
@section('title' , 'Manage Event')
@section('content')
    
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h5 class="h5 mb-2 text-gray-800">Manage Event / <a href="../../event/{{$events->id}}" >{{ $events->event_title}}</a> </h5>

        
        <!-- DataTales Example -->
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    @if(session('success')) 
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>    
                    @endif
                    @error('event_date')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>    
                    @enderror
                    @error('event_place')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>    
                    @enderror

                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        Edit event detail 
                        <span class="badge badge-pill badge-primary">
                            Created at : {{$events->created_at->toFormattedDateString()}}
                        </span>

                        <!-- Button trigger modal -->
                    </h5>
        
                    <div class="card-body">
                        <form action="{{ url('event/update/'.$events->id)}}" method="POST" >
                            @csrf
                            <div class="form-group">
                              <label for="event_title">Event title</label>
                              <input type="text" name="event_title" class="form-control" id="event_title" value="{{$events->event_title}}">
                            </div>
                            @error('event_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                              <label for="event_description">Event description</label>
                              <textarea class="form-control" name="event_description" id="event_description" rows="3" >{{$events->event_description}}</textarea>
                            </div>

                            <div class="form-group">
                              <label for="event_place">Event place</label>
                              <input type="text" name="event_place" class="form-control" id="event_place" value="{{$events->event_place}}">
                            </div>

                            <div class="form-group">
                                <label for="event_date" class="form-label">Event date</label>
                                <input type="date" class="form-control" value="{{ date('Y-m-d', strtotime($events->event_date)) }}" name="event_date" id="event_date" >
                            </div>

                            <div class="form-group">
                                <label for="event_max" class="form-label">Maximum participant</label>
                                <input type="number" class="form-control" value="{{ $events->event_max }}" name="event_max" id="event_max" readonly>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                    </div>
                </form>

        
                </div>
            </div>
            <div class="col-md-8" >
                <div class="card shadow mb-4 ">
                    @if(session('successpic')) 
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session('successpic')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>    
                    @endif
                    @error('event_picture.*')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>    
                    @enderror
                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        Image of event
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Add new image
                        </button>
        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Create new event</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                
                                <div class="modal-body">
                                    <form action="{{ route('add.pic') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="formFileMultiple" class="form-label">Select the picture for your event</label>
                                                <input name="event_picture[]" class="form-control" type="file" id="formFileMultiple" multiple required>
                                            </div>                            
                                        </div>
                                        <div class="mb-3">
                                            <input name="event_id" value="{{$events->id}}" hidden>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="reset" class="btn btn-warning">Reset</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Upload Image</button>
                                        </div>
                                  </form>
                                </div>
        
                              </div>
                            </div>
                        </div>
                    </h5>
                    <br>
        
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Event Picture</th>
                                        <th>Uploaded At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
        
                                <tbody>
                                    @foreach($eventpic as $pic)
                                        <tr>
                                            <td>{{$eventpic->firstItem()+$loop->index}}</td>
                                            <td style="display:flex;">
                                                <img style="width:150px" src="../../{{$pic->photo_path}}  " alt="">
                                            </td>
                                            <td>{{$pic->created_at->diffForHumans()}}</td>
                                            <td>
                                                <a href="{{ url('event/edit/deletepic/'.$pic->id)}}" class="btn btn-danger btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                    <span class="text">Remove Picture</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $eventpic->links("pagination::bootstrap-4") }}
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="card shadow mb-4">
            @if(session('remove')) 
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('remove')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>    
            @endif
            <h5 class="card-header d-flex justify-content-between align-items-center">
                List of people that join the event
                <!-- Button trigger modal -->
            </h5>
 
            @if($joined->isEmpty())
            <div class="card-body">
                No participant.
            </div>
            @else
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Participant Name</th>
                                <th>Matric ID</th>
                                <th>Email</th>
                                <th>Date of participation</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        @php
                            $i = 1 ;   
                        @endphp
                        <tbody>
                            @foreach($joined as $join) 
                            <tr>
                                <td>{{$i++}}</td>
                                <td>
                                    @if($join->profile_photo_path == null)
                                    <img style="height: 2rem;width: 2rem;border-radius: 50%;" src="/storage/profile-photos/default.png " alt="">{{$join->name}}
                                @else 
                                    <img style="height: 2rem;width: 2rem;border-radius: 50%;" src="/storage/{{$join->profile_photo_path}} " alt="">{{$join->name}}
                                @endif
                                </td>
                                <td>{{$join->matric_id}}</td>
                                <td>{{$join->email}}</td>
                                <td>{{ Carbon\Carbon::parse($join->event_date)->format('d M Y' ) }}</td>
                                <td>
                                    <a href="{{ url('event/kick/'.$join->join_id)}}" class="btn btn-danger btn-icon-split delete-confirm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Remove from event</span>
                                    </a>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>                
            @endif


        </div>
    <!-- /      .container-fluid -->

</div>

@endsection
@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <script src="{{asset('backend/js/ck-editor.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
      $( document ).ready(function() {

        $('.delete-confirm').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');

            swal.fire({
                    title: "Are you sure to remove this user from event ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, remove user from event",
                }).then(function (result){
                    if(result.value === true){
                    console.log("Submitted");
                    window.location.href = url;
                }
            })
        })
    });

    </script> 
@endsection


