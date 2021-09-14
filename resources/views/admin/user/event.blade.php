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
            @error('event_picture.*')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>    
            @enderror
            <h5 class="card-header d-flex justify-content-between align-items-center">
                List of event from all organizer
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Create new event
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
                            <form action="{{ route('add.event') }}" method="POST" enctype="multipart/form-data" required>
                                @csrf
                                <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Event title </label>
                                <input type="text" name="event_title" class="form-control" id="recipient-name" required>
                                </div>
                                <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Event date </label>
                                <input type="date" id="demo" name="event_date" class="form-control datepicker" required>
                                </div>

                                <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Event place </label>
                                <input type="text" name="event_place" class="form-control" id="recipient-name" required>
                                </div>
                                
                                <div class="form-group">
                                <label for="message-text" class="col-form-label">Event description</label>
                                <textarea class="form-control" name="event_description" id="message-text" required></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label for="formFileMultiple" class="form-label">Multiple files input example</label>
                                        <input name="event_picture[]" class="form-control" type="file" id="formFileMultiple" multiple required>
                                    </div>                            
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Create event</button>
                                </div>
                          </form>
                        </div>

                      </div>
                    </div>
                </div>
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
                            @foreach($events as $event) 
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

                            @endforeach

                        </tbody>
                        <div class="card-footer">

                            {{ $events->links("pagination::bootstrap-4") }}
                        </div>
                    </table>
                </div>
            </div>

        </div>
    <!-- /.container-fluid -->

</div>

@endsection
