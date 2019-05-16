@extends('layouts.app')

@section('content')

<div id="__vis_app" class="container p-0 mt-5 mb-4 v-room-booking-pg"> 
        <div class="row ">
        <div class=" ">
            <div class="card border-light">
                <div class="row book-head">
                    <div class="col-md-8 col-sm-12 image-show">
                        @foreach ($room->media as $image) 

                                @include('layouts.image',[ 'alt'=>$room->name, 'folder' => 'room' ])
                                
                        @endforeach
                        <!-- <img class="img-fluid" src="{{ asset('images/room.jpg') }}"> -->
                    </div>
                    <div class="col-md-4 col-sm-12 p-3 book_room" id="__booking">
 
                        <form class="book_f" method="post" action="{{route('book',['slug'=>$room->slug])}}">
                            {{ csrf_field() }}

 <roombooking-cmp> </roombooking-cmp>
                        </form>

                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col">
                        <h2>Description</h2>
                        <p>{!! $room->description !!}</p>
                </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">  
                            @include('rooms.amenities')
                    </div>
                    <div class="col-md-6">
                        <h2>Location</h2>
                        <object height="200px"></object>
                    </div>
                </div>


                <div class="row mt-3">
                    <div class="col-md-6">
                        <h2>Hotel Rules</h2>
                        <ul class="hotel_rules">
                            <li>ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
                            <li>ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
                            <li>ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
                            <li>ullamco laboris nisi ut aliquip ex ea commodo consequat</li> 
                        </ul>

                    </div>
                    <div class="col-md-6">
                        <h2>Reviews</h2>
                        <ul class="reviews">

                @if( $reviews )
                    @foreach ($reviews as $review) 

                            <li>
                                <h4>{{ $review->user->first_name }}</h4> 
                                <span class="rating">
                                    {{ $review->rating }}<b>*</b>
                                </span>
                                <p>{{ $review->review }}</p>
                                <p><i>{{ Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</i></p>
                            </li> 
                    @endforeach
                @else
                
                <li>There is no comments to show!.</li>
                @endif


                        </ul>
                    </div>
                </div> 
            </div>
        </div> 
        </div> 
     

        <div class="row mt-5">
        <div class="col">
        <div class="card-deck">
            <?php for($i = 1 ; $i<=3; $i++): ?>
            
            <div class="card room-d" style="width: 20rem;">
            <div class="thumb">
                 <img class="card-img-top" src="images/room.jpg" alt="Card image cap">
               <span class="badge badge-success rating-c">Rating <span>4</span></span> 
            </div>
              <div class="card-body"> 
                     
                <h4 class="card-title">Card title</h4>
                <p class="card-text">Some quick example text to build on the card title...</p>
                <div class="row">
                    <div class="col">
                        <h2 class="display-4 price">AED 2000</h2>
                    </div>
                    <div class="col">
                         <p><del>AED 2500 </del><span class="badge badge-secondary">30% OFF</span></p>
                    </div>
                </div>
              </div>
            </div>

        <?php endfor; ?>

        </div>
        </div>
        </div>


</div>
<script type="text/javascript"> 
    req= @json( $formData )

 
</script>
 


@endsection

