@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
           
            <div class="card">
                <div class="card-header">
                    Edit room
                </div>

                <div class="card-body">
                     @include('layouts.errors')
                   <form method="post" action="{{route('room.edit',['slug'=>$room->slug])}}"> 
                   		@include('rooms._form',['button'=>'update'])
                   </form>

                   <form action="{{route('room.delete',['slug'=>$room->slug])}}" method="post">
                       {{csrf_field()}}
                       <button type="submit" name="submit" class="btn btn-primary ">Delete Room</button>
                   </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
