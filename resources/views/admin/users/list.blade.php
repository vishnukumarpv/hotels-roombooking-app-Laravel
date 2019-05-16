 @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            @include('layouts.errors')
            <div class="card">
                <div class="card-header">
                    Users
                </div>

                <div class="card-body">

                     <table class="table">
                       <thead>
                         <tr>
                           <th scope="col">ID</th>
                           <th scope="col">Name</th>
                           <th scope="col">email</th>
                           <th scope="col">Roles</th>
                           <th scope="col">view</th>
                          </tr>
                       </thead>
                       <tbody>
                       	@foreach ($users as $user)
                         <tr>
                           <th scope="row">{{env('APP_HOTEL_SHORT')}}_{{ $user->id }}</th>
                           <td>{{ $user->first_name }} {{$user->last_name}}</td>
                           <td>{{ $user->email }}</td>
                           <td> 
                           	@if ($user->roles->count()) 
                           	 
                           	@foreach ($user->roles as $role)
                           		{{ $role->name }} @if( ! $loop->last) | @endif 
                           	@endforeach

                           	@else
                           		<p><i>No roles..</i></p>
                           	@endif
                           </td>
                           <td>
                           	<a href="{{route('admin.user',['id'=>$user->id])}}" class="btn btn-primary ">View User</a>
                           </td>
                         </tr>
                       	@endforeach

                         </tbody>
                     </table>

                     {{ $users->links() }}
                     
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
