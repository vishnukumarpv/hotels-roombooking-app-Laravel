@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            @include('layouts.errors')
            <div class="card">
                <div class="card-header">
                   Bookings
                </div>

                <div class="card-body">

                    @include('profile.bookings')
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
