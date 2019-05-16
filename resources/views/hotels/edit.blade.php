@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            @include('layouts.errors')
            <div class="card">
                <div class="card-header">
                    Edit {{ $hotel->name }}
                </div>

                <div class="card-body">

        <form action="{{ route('admin.user.edit_hotel',['hotel'=>$hotel->slug]) }}" method="post">
                    @include('hotels._form',['button'=>'update'])
        </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
