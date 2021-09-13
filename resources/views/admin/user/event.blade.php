@extends('admin.index')
@section('event')
    
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
                          <form>
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Event title </label>
                              <input type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Event date </label>
                              <input type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Event place </label>
                              <input type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                              <label for="message-text" class="col-form-label">Event description</label>
                              <textarea class="form-control" id="message-text"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                  <input type="file" name="event_picture[]" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" multiple="multiple" required>
                                  <label class="custom-file-label" for="inputGroupFile04">Event picture/poster</label>
                                </div>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Create event</button>
                        </div>
                      </div>
                    </div>
                  </div>
            </h5>

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
