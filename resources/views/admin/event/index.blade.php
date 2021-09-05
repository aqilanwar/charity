<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Manage Event
        </h2>
    </x-slot>

    <div class="container" style="margin-top:20px;">
        <div class="row">
            <div class="col-md-8">
                @if(session('success')) 
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h1>Event</h1>
                    </div>
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Event Title</th>
                            <th scope="col">Event Date</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Posted By</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td scope="col">{{$events->firstItem()+$loop->index}}</td>
                                <td scope="col">{{$event->event_title}}</td>
                                <td scope="col">{{$event->event_date}}</td>
                                <td scope="col">{{$event->created_at->diffForHumans()}}</td>
                                <td scope="col" style="display:flex;">
                                    <img class="h-10 w-10 rounded-full" src="/storage/{{$event->user->profile_photo_path}} " alt="">
                                    {{$event->user->name}}
                                </td>
                                <td scope="col">
                                    <a type="button" href="{{ url('event/edit/'.$event->id)}}" class="btn btn-primary">Edit</a>
                                    <a type="button" href="{{ url('event/delete/'.$event->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-footer">
                        {{ $events->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h1>Create Event</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('add.event') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="old:value" name="event_title" id="event_title" style="height: 100px" required></textarea>
                                    <label for="event_title">Event Title</label>
                                  </div>
                              @error('event_title')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" name="event_description" id="event_description" style="height: 100px" required></textarea>
                                    <label for="event_description">Event Description</label>
                                  </div>
                                @error('event_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" name="event_place" id="event_place" style="height: 100px" ></textarea>
                                    <label for="event_place">Event Place</label>
                                  </div>
                                @error('event_place')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="Event Date" class="form-label">Event Date</label>
                                <input type="date" class="form-control" name="event_date" id="event_date" required >
                                @error('event_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Event Picture</label>
                                <input name="event_picture[]" class="form-control form-control-sm" id="formFileSm" type="file" multiple="multiple" required>
                                @error('event_picture.*')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
 
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">Create Event</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
       
    </div>
</x-app-layout>
