@extends('admin.index')

@section('user')
    
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                href="https://datatables.net">official DataTables documentation</a>.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
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
                                    <a href="#" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-flag"></i>
                                        </span>
                                        <span class="text">Change Role</span>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Delete User</span>
                                    </a>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                        <div class="card-footer">

                            {{ $users->links("pagination::bootstrap-4") }}
                        </div>
                    </table>
                </div>
            </div>

        </div>
    <!-- /.container-fluid -->

</div>

@endsection
