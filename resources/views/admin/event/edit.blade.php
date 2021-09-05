<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Edit Event
        </h2>
    </x-slot>

    <div class="container" style="margin-top:20px;">
        <div class="row">
            <div class="col-md-4">
                @if(session('success')) 
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h1>Edit Event</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('event/update/'.$events->id)}}" method="POST" >
                            @csrf
                            <div class="mb-3">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="{{$events->event_title}}" name="event_title" id="floatingInput" style="height: 100px" required>{{$events->event_title}}</textarea>
                                    <label for="event_title">Event Title</label>
                                  </div>
                              @error('event_title')
                                 <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                  
                            <div class="mb-3">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" name="event_description" id="event_description" style="height: 100px" required>{{$events->event_description}}</textarea>
                                    <label for="event_description">Event Description</label>
                                  </div>
                                @error('event_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <textarea class="form-control" value="{{$events-> event_place}}"  placeholder="Leave a comment here" name="event_place" id="event_place" style="height: 100px" required>{{$events->event_place}}</textarea>
                                    <label for="event_place">Event Place</label>
                                  </div>
                                @error('event_place')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="Event Date" class="form-label">Event Date</label>
                                <input type="date" class="form-control" value="{{$events-> event_date}}" name="event_date" id="event_date" required>
                                @error('event_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Save Event</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                @if(session('deletepic')) 
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('deletepic')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('successpic')) 
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('successpic')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @error('event_picture.*')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="card">
                    <h1 class="card-header d-flex justify-content-between align-items-center">
                            Title
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Add Image
                        </button>
                        
                        <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Upload new image for event</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <form action="{{ route('add.pic') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="formFileSm" class="form-label">Please select image</label>
                                                    <input name="event_picture[]" class="form-control form-control-sm" id="formFileSm" type="file" multiple="multiple" required>
                                                </div>
                                                <div class="mb-3">
                                                    <input name="event_id" value="{{$events->id}}" hidden>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                <button class="btn btn-primary" type="submit">Upload Image</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                    </h1>
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Event Picture</th>
                            <th scope="col">Uploaded At</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($eventpic as $pic)
                            <tr>
                                <td scope="col">      
                                    {{$eventpic->firstItem()+$loop->index}}
                                </td>
                                <td scope="col" style="display:flex;">
                                    <img class="h-16" src="../../{{$pic->photo_path}}  " alt="">
                                </td>
                                <td scope="col">{{$pic->created_at->diffForHumans()}}</td>

                                <td scope="col">
                                    <a type="button" href="{{ url('event/edit/deletepic/'.$pic->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-footer">
                        {{ $eventpic->links() }}
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">
                        <h1>People who joined</h1>
                    </div>
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Matric Id</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="col">1</td>
                                <td scope="col" style="display:flex;">
                                    <img class="h-10 w-10 rounded-full" src="/storage/ " alt="">
                                </td>
                                <td scope="col"></td>

                                <td scope="col">
                                    <a type="button" href="" class="btn btn-danger">Kick from event</a>
                                </td>
                            </tr>
                        
                        </tbody>
                    </table>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</x-app-layout>
