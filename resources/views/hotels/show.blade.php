@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col ">
            <div class="card full-width">
                <div class="card-header"><h3>{{ $hotel->name }}</h3></div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                             
                            @php $image = $hotel->media[0]; @endphp
                                @include('layouts.image',[ 'alt'=>$hotel->name, 'folder' => "hotel" ])
                                
                             
                        </div>   
                        <div class="col-8">
                                @include('layouts.success')
                                <h3>Description</h3>
                                <p>{{ $hotel->description }}</p>

                                <h3>City</h3>
                                <p>{{ $hotel->city }}</p> 
                        </div>   
                    </div>


                    
        <hr>

                    <div class="row">
                         @each('rooms._room',$rooms,'room','rooms._empty')
                    </div> 

                </div> 
                @if ( Auth::id() == $hotel->user_id)
                <div class="card-footer">
                    <p>
                        Add a new room
                        <a href="{{route('create_room',['hotel_slug' => $hotel->slug ])}}" class="btn btn-primary ">Add room</a>
                    </p> 
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
