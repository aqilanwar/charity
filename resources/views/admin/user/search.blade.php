@extends('admin.index')
@section('title' , 'Manage User')

@section('content')
    
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Manage User</h1>
        <div class="card shadow mb-4">
            @if(session('success')) 
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>    
            @endif
            <h5 class="card-header d-flex align-items-center">
                Search result for "{{$_GET['search_user']}}" .<a href="{{ url('manage/user') }}">  Go back to all user </a> 
            </h5>
            <br>
            <form action="{{route('search.user')}}" method="GET">
                <div class="input-group pl-2 pr-2">
                    <input name="search_user" type="text" class="form-control bg-light border-1 small" placeholder="Search Matric ID / Name / Email" aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                </div>
            </form>
            @if($users->isEmpty())
            <div class="card-body">
                <p>No result.</p>
            </div>
            @else
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Matric ID</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $i = 1 ;   
                            @endphp
                            @foreach($users as $user) 
                            <tr>
                                <td> {{$i++}} </td>
                                <td>
                                    @if($user->profile_photo_path == null)
                                        <img style="height: 2rem;width: 2rem;border-radius: 50%;" src="/storage/profile-photos/default.png " alt="">{{$user->name}}
                                    @else 
                                        <img style="height: 2rem;width: 2rem;border-radius: 50%;" src="/storage/{{$user->profile_photo_path}} " alt="">{{$user->name}}
                                    @endif
                                </td>
                                <td>{{$user->matric_id}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{ Carbon\Carbon::parse($user->created_at)->format('d M Y' ) }}</td>
                                @if($user->role_id == '0')
                                    <td><span class="badge badge-primary">User</span></td>
                                @endif
                                @if($user->role_id == '1')
                                    <td><span class="badge badge-success">Organizer</span></td>
                                @endif
                                @if($user->role_id == '2')
                                    <td><span class="badge badge-danger">Admin</span></td>
                                @endif
                                @if(Auth::user()->id == $user->id)
                                <td>
                                    <a class="btn btn-primary btn-icon-split" href="{{url('/user/profile')}}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-flag"></i>
                                        </span>
                                        <span class="text">Manage Profile</span>
                                    </a>
                                </td>
                                @else 
                                <td>
                                    <a class="btn btn-primary btn-icon-split" id="edit_role"  data-toggle="modal" data-target="#exampleModal{{$user->id}}" data-id="{{$user->id}}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-flag"></i>
                                        </span>
                                        <span class="text">Change Role</span>
                                    </a>
                                    <a href="{{ url('manage/user/delete/'.$user->id)}}" class="btn btn-danger btn-icon-split delete-confirm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Delete User</span>
                                    </a>
                                    <!-- Button trigger modal -->
                                </td>
                                @endif
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                
                                <form action="{{route('manage.role')}}" method="POST">
                                    @csrf
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Manage User Role</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    <label for="name" class="col-form-label">Name </label>
                                                    <input type="text" value="{{$user->name}}" name="name" class="form-control" id="name" readonly required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="matricid" class="col-form-label">Matric ID </label>
                                                    <input type="text" name="matric_id" value="{{$user->matric_id}}" class="form-control" id="matric_id" readonly required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email" class="col-form-label">Email </label>
                                                    <input type="text" name="email" value="{{$user->email}}" class="form-control" id="email" readonly required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="role" class="col-form-label" name="position">Role </label>
                                                    <select class="form-control" name="role" value="{{ old('role') }}" id="role">
                                                        <option selected disabled>Please role</option>
                                                        <option value= "2" {{ (  $user->role_id  == "2") ? 'selected' : '' }}>Admin</option>
                                                        <option value= "1" {{ (  $user->role_id   == "1") ? 'selected' : '' }}>Organizer</option>
                                                        <option value= "0" {{ ( $user->role_id  == "0") ? 'selected' : '' }}>User</option>
                                                    </select>
                                                    @error('position') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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

