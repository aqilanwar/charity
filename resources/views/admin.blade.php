<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi {{Auth::user()->matric_id}}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Matric ID</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Role ID</th>
                  </tr>
                </thead>
                @foreach($users as $user)
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td><img src="{{asset($user -> profile_photo_path)}}" alt=""></td>
                        <td>{{ $user-> email}}</td>
                        <td>{{ $user-> matric_id}}</td>
                        <td>{{ $user-> created_at->diffForHumans()}}</td>
                        @if( $user -> role_id == '0')
                            <td>{{ 'User' }}</td>
                        @elseif ( $user -> role_id == '1')
                            <td>{{ 'Organizer' }}</td>
                        @elseif ( $user -> role_id == '2')
                            <td>{{ 'Admin' }}</td>
                        @endif
 
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
       
    </div>
</x-app-layout>
