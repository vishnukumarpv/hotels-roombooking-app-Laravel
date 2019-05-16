@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <div class="card full-width">
                <div class="card-header">Register a new Hotel</div>


                <div class="card-body">
 
@include('layouts.errors')
 
          <form method="post" action="{{ route('admin.user.create_hotel',['user'=>$user->id]) }}"
            enctype="multipart/form-data">
                @include('hotels._form',['button' => 'Create','hotel'=>[]]) 
          </form>
                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
