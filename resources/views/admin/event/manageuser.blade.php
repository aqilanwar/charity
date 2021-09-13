<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Manage User
        </h2>
    </x-slot>

    <div class="container" style="margin-top:20px;">
        <div class="row">
            <div class="col-md">
                @if(session('success')) 
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h1>User</h1>
                    </div>
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Matric ID</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td scope="col">{{$users->firstItem()+$loop->index}}</td>
                                <td scope="col" style="display:flex;">
                                    <img class="h-10 w-10 rounded-full" src="/storage/{{$user->profile_photo_path}} " alt="">
                                    {{$user->name}}
                                </td>
                                <td scope="col">{{$user->email}}</td>
                                <td scope="col">{{$user->matric_id}}</td>
                                <td scope="col">{{$user->created_at->diffForHumans()}}</td>
                                @if($user->role_id == '0')
                                    <td scope="col">User</td>
                                @endif
                                @if($user->role_id == '1')
                                    <td scope="col">Organizer</td>
                                @endif
                                @if($user->role_id == '2')
                                    <td scope="col">Admin</td>
                                @endif
                                <td scope="col">
                                    <a type="button" href="{{ url('manage/user/role/'.$user->id)}}" class="btn btn-primary">Change Role</a>
                                    <a type="button" href="{{ url('manage/user/delete/'.$user->id)}}" class="btn btn-danger">Delete User</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-footer">
                        {{ $users->links() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
