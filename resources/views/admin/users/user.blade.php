@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            @include('layouts.errors')
            <div class="card">
                <div class="card-header">
                   <h3>Manage User</h3>
                </div>

                <div class="card-body">

                    <div class="col">
                <div class=" " >
                  <div class="card-body">
                    <h4 class="card-title">{{ $user->first_name }} {{ $user->last_name }}</h4>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $user->email }}</h6>
                    <p class="card-text">Phone :
                    {!! ($user->phone)? $user->phone : '<i>No phone Number</i>' !!}  </p>

                    <p>Created: {{ humanize_date($user->created_at) }}</p>

                    @if($user->verified)
                        <button type="button" class="btn btn-success">
                          Verified <span class="badge badge-light">*</span>
                        </button>
                    @else
                        <button type="button" class="btn btn-warning">
                          Not Verified <span class="badge badge-light">*</span>
                        </button>
                    @endif
        <div class="row" id="_roles">
                            <div class="form-check col-md-3">
                              <label class="form-check-label">
                                <input  v-model="verified" @change="changed_" class="form-check-input" type="checkbox" value="true" name="verified" 
                                 >
                                Make him verified
                              </label>
                            </div>

                            <div class="form-check col-md-3" id="make_verify">
                              <label class="form-check-label">
                                <input v-model="admin" @change="changed_" class="form-check-input" type="checkbox" value="true" name="owner">
                                Make him admin
                              </label>
                            </div>

        </div>

                    <a href="#" class="card-link">Another link</a>
                  </div>
                </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>



    <div class="row mt-4">
        <div class="col">
            <div class="card-group">
                <div class="card text-white bg-success mb-3 col-3" >
                  <div class="card-header">Total Booking</div>
                  <div class="card-body">
                    <h1>{{ $bookings }}</h1>
                  </div>
                </div>
 
             <div class="card border-success mb-3 col-9" > 
              <div class="card-body text-success">
                <h4 class="card-title">To view all bookings by this user</h4>
                <p class="card-text">Here</p>
                <a href="{{ route('admin.user.bookings',['user'=>$user->id]) }}" class="btn btn-success ">View Bookings</a>
              </div>
            </div>

            </div>
        </div>
    </div>




    <div class="row mt-4">
        <div class="col">
        <div class="card">
            <div class="card-header">Hotels Associated with this user</div>
            <div class="card-body">
                @include('hotels.hotels')
            </div>
            <div class="card-footer">
                <p>Create a hotel for this user 
                    <a href="{{route('admin.user.create_hotel',['user'=>$user->id])}}" class="btn btn-primary ">Create a hotel</a>
                </p>
            </div>
        </div>
    </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        const role_v = new Vue({
            el:"#_roles",
            data:{
                admin : (false),
                verified: {{($user->verified)?true:''}},
            },
            methods:{
                changed_:function(el) {
                    console.log(el);
                    axios.post('/api/roles',{ 
                            admin : this.admin,
                            verified : this.verified,
                            user : {{$user->id}} 
                    })
                    .then(function(res){
                        console.log(res);
                    })
                    .catch(function(err){
                        console.log(err);
                    })
                },
            }
        }); 
    </script>
@endpush
@endsection
