@extends('layouts.app')

@section('content')
 

 


<section class="home-img text-center">
    <h1>Here is something hot</h1>
    <h3>Here is something sub</h3>

    @include('common.searchbar')


</section>
  
<section class="popular-r">
    <div class="container mt-5">
        <h1>Popular Rooms</h1>
        <div class="row mt-5">
        <div class="col">
        <div class="card-deck">
            <div class="row">

                @each('rooms._room',$rooms,'room','rooms._empty')

            </div>

        </div>
        </div>
        </div>
        <div class="row">
                <a href="#" class="btn btn-link m-auto">Explore More...</a>
        </div>
    </div>
</section>



<section class="explore-emi pt-3">
    <h1 class="text-center mt-5">Explore Emirates</h1>
    <div class="container mt-4">
            <div class="row text-center">
                <div class="col">
                    <img class="img-fluid" src="{{ asset('images/Emirates_Tower.png') }}">
                    <h4 class="display-4">DUBAI</h4>
                </div>

                <div class="col">
                    <img class="img-fluid" src="{{ asset('images/Emirates_Tower.png') }}">
                    <h4 class="display-4">DUBAI</h4>
                </div>

                <div class="col">
                    <img class="img-fluid" src="{{ asset('images/Emirates_Tower.png') }}">
                    <h4 class="display-4">DUBAI</h4>
                </div>

                <div class="col">
                    <img class="img-fluid" src="{{ asset('images/Emirates_Tower.png') }}">
                    <h4 class="display-4">DUBAI</h4>
                </div>

            </div>

    <div class="row mt-4">
                <div class="col">
                    <img class="img-fluid" src="{{ asset('images/Emirates_Tower.png') }}">
                    <h4 class="display-4">DUBAI</h4>
                </div>

                <div class="col">
                    <img class="img-fluid" src="{{ asset('images/Emirates_Tower.png') }}">
                    <h4 class="display-4">DUBAI</h4>
                </div>

                <div class="col">
                    <img class="img-fluid" src="{{ asset('images/Emirates_Tower.png') }}">
                    <h4 class="display-4">DUBAI</h4>
                </div>

                <div class="col">
                    <img class="img-fluid" src="{{ asset('images/Emirates_Tower.png') }}">
                    <h4 class="display-4">DUBAI</h4>
                </div>

            </div>

    </div>
</section>
 

@endsection
