@extends('admin.index')
@section('title' , 'Manage User')

@section('content')
    
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Manage User</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                href="https://datatables.net">official DataTables documentation</a>.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <h5 class="card-header d-flex justify-content-between align-items-center">
                List of all user
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
                                <th>Name</th>
                                <th>Matric ID</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($users as $user) 
                            <tr>
                                <td>{{$users->firstItem()+$loop->index}}</td>
                                <td>
                                    @if($user->profile_photo_path == null)
                                        <img style="height: 2rem;width: 2rem;border-radius: 50%;" src="/storage/profile-photos/default.png " alt="">{{$user->name}}
                                    @else 
                                        <img style="height: 2rem;width: 2rem;border-radius: 50%;" src="/storage/{{$user->profile_photo_path}} " alt="">{{$user->name}}
                                    @endif
                                </td>
                                <td>{{$user->matric_id}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at->diffForHumans()}}</td>
                                @if($user->role_id == '0')
                                    <td>User</td>
                                @endif
                                @if($user->role_id == '1')
                                    <td>Organizer</td>
                                @endif
                                @if($user->role_id == '2')
                                    <td>Admin</td>
                                @endif
                                <td>
                                    <a href="" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-flag"></i>
                                        </span>
                                        <span class="text">Change Role</span>
                                    </a>
                                    <a href="{{ url('manage/user/delete/'.$user->id)}}" class="btn btn-danger btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Delete User</span>
                                    </a>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $users->links("pagination::bootstrap-4") }}
            </div>

        </div>
    <!-- /.container-fluid -->

</div>

@endsection
