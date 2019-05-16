@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            @include('layouts.errors')
            <div class="card">
                <div class="card-header">
                   Bookings related to your hotels
                </div>

                <div class="card-body">

                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Refferance</th>
                          <th scope="col">Room</th>
                          <th scope="col">User</th>
                          <th scope="col">User email</th>
                          <th scope="col">booking date</th>
                          <th scope="col">booked on</th>
                          <th scope="col">View</th>
                         </tr>
                      </thead>
                      <tbody>
                        @each('profile.owner._tablerow',$bookings,'booking')

                        </tbody>
                    </table>
                    
                    {{$bookings->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
