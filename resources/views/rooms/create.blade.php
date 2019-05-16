@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-12">
            <div class="card full-width">
                <div class="card-header">Create Room</div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <p>The hotel Name that which you gonna create room</p>
                            <h3>{{ $hotel->name }}</h3>
                            <p><b> {{ $hotel->city }} </b></p>
                        </div>
                        
                    </div>

                     

                   <form method="post" action="{{ route('create_room',[ 'hotel_slug' => $hotel->slug ]) }}" enctype="multipart/form-data"> 
                        @include('rooms._form',['button'=>'Create','amenities_room' => collect([]),'room'=>[]])
                         
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
