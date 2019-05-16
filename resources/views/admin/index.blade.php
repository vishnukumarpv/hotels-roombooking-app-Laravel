@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            @include('layouts.errors')
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
 
                        <div class="alert alert-success">
                            <p><b>Hi</b> Welcome to admin dash</p>
                        </div>
 
                    <div class="row">
                    <div class="col">
            <div class="card-group">
                <div class="card text-white bg-success mb-3 col-3" >
                  <div class="card-header">Total Users</div>
                  <div class="card-body">
                    <h1>{{ $users }}</h1>
                  </div>
                </div>
 
             <div class="card border-success mb-3 col-9" > 
              <div class="card-body text-success">
                <h4 class="card-title">To explore and edit user</h4>
                <p class="card-text">Here</p>
                <a href="{{ route('admin.users') }}" class="btn btn-success ">View users</a>
              </div>
            </div>

            </div>
            </div>
                    </div>

                    <div class="row">
                    <div class="col">
            <div class="card-group">
                <div class="card text-white bg-warning mb-3 col-3" >
                  <div class="card-header">Manage Amenities</div>
                  <div class="card-body">
                    <h1>Add</h1>
                  </div>
                </div>
 
             <div class="card border-warning mb-3 col-9" > 
              <div class="card-body text-warning">
                <h4 class="card-title">To explore and edit user</h4>
                <p class="card-text">Here</p>
                <a href="{{ route('admin.amenities') }}" class="btn btn-warning ">View amenities</a>
              </div>
            </div>

            </div>
            </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
