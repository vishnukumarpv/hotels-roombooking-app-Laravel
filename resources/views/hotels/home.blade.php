@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <div class="card full-width">
                <div class="card-header">Dashboard</div>

                <div class="card-body"> 
 
                    @include('hotels.hotels')

                </div>
                <div class="row">
                <div class="col">
                <nav aria-label="Page navigation example">
                    {{ $hotels->links() }}
                </nav>
                </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
