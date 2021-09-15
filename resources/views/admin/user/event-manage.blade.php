@extends('admin.index')
@section('content')
    
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Manage Event</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                href="https://datatables.net">official DataTables documentation</a>.</p>
        
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
                              <label for="exampleFormControlInput1">Event title</label>
                              <input type="text" name="event_title" class="form-control" id="exampleFormControlInput1" value="{{$events->event_title}}">
                            </div>
                            @error('event_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                              <label for="exampleFormControlTextarea1">Event description</label>
                              <textarea class="form-control" name="event_description" id="exampleFormControlTextarea1" rows="3" >{{$events->event_description}}</textarea>
                            </div>

                            <div class="form-group">
                              <label for="exampleFormControlTextarea1">Event place</label>
                              <input type="text" name="event_place" class="form-control" id="exampleFormControlInput1" value="{{$events->event_place}}">
                            </div>

                            <div class="form-group">
                                <label for="Event Date" class="form-label">Event Date</label>
                                <input type="date" id="demo" class="form-control" value="{{$events->event_date}}" name="event_date" id="event_date" required>
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

            <h5 class="card-header d-flex justify-content-between align-items-center">
                List of people that join the event
                <!-- Button trigger modal -->
            </h5>
            <br>
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-lg-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                        aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Event Title</th>
                                <th>Event Date</th>
                                <th>Created At</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            {{-- @foreach($events as $event) 
                            <tr>
                                <td>{{$events->firstItem()+$loop->index}}</td>
                                <td>{{$event->event_title}}</td>
                                <td>{{$event->event_date}}</td>
                                <td>{{$event->created_at->diffForHumans()}}</td>
                                <td>                                    
                                @if($event->user->profile_photo_path == null)
                                    <img style="height: 2rem;width: 2rem;border-radius: 50%;" src="/storage/profile-photos/default.png " alt="">{{$event->user->name}}
                                @else 
                                    <img style="height: 2rem;width: 2rem;border-radius: 50%;" src="/storage/{{$event->user->profile_photo_path}} " alt="">{{$event->user->name}}
                                @endif
                                </td>
                                <td>
                                    <a href="{{ url('event/edit/'.$event->id)}}" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-flag"></i>
                                        </span>
                                        <span class="text">Manage Event</span>
                                    </a>
                                    <a href="{{ url('event/delete/'.$event->id)}}" class="btn btn-danger btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Delete Event</span>
                                    </a>
                                </td>
                            </tr>

                            @endforeach --}}
                        </tbody>
                        <div class="card-footer">

                        </div>
                    </table>
                </div>
            </div>

        </div>
    <!-- /.container-fluid -->

</div>

@endsection
