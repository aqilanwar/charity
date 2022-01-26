@extends('admin.index')
@section('title' , 'Manage Event')

@section('content')
    
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Manage Event</h1>
    
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
                Search result for "{{$_GET['search_event']}}" <a href="{{ url('manage/event') }}"> Go back to all event </a> 
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Create new event
                </button>
            </h5>
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
                                                <label for="event_title" class="col-form-label">Event title </label>
                                                <input type="text" name="event_title" class="form-control" id="event_title" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="event_date" class="col-form-label">Event date </label>
                                                <input type="date" id="event_date" name="event_date" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="event_place" class="col-form-label">Event place </label>
                                                <input type="text" name="event_place" class="form-control" id="event_place" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="event_description" class="col-form-label">Event description</label>
                                                <textarea class="form-control" name="event_description" id="event_description"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="event_max" class="col-form-label">Maximum participant</label>
                                                <input type="number" name="event_max" class="form-control" id="event_max" required>
                                            </div>
                                            <div class="form-group">
                                                <div class="mb-3">
                                                    <label for="formFileMultiple" class="form-label">Select event picture/poster</label>
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
            <form action="{{route('search.event')}}" method="GET">
                <div class="input-group pl-2 pr-2 mt-3">
                    <input name="search_event" type="text" class="form-control bg-light border-1 small" placeholder="Search event title" aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                </div>
            </form>
            @if ($events->isEmpty())
                <div class="card-body">
                    You haven't organize any event. Organize a new event now ! </a>
                </div>                          
            @else
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
                            @php
                                $i = 1;   
                            @endphp
                            @foreach($events as $event) 
                            <tr>
                                <td>{{$i++}}</td>
                                <td> <a href="../event/{{$event->id}}">{{$event->event_title}}</a> </td>
                                
                                <td>
                                    {{ Carbon\Carbon::parse($event->event_date)->format('d M Y' ) }}
                                </td>
                                <td>
                                    {{ Carbon\Carbon::parse($event->created_at)->format('d M Y' ) }}
                                </td>
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
                                    <a href="{{ url('event/delete/'.$event->id)}}" class="btn btn-danger btn-icon-split delete-confirm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Delete Event</span>
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
    <!-- /.container-fluid -->

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
                    title: "Are you sure to remove this record ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete this record",
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

