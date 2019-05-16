    <div class="col-md-3">
      <div class="card room-d">
      <div class="thumb">
  
                  @include ('layouts.image' ,[
                      'image' => ( isset($room->media[0]) )? $room->media[0] : '',
                      'alt' => $room->name,
                      'folder'  =>  'room'
                  ]) 
         <span class="badge badge-success rating-c">Rating <span>4</span></span> 
      </div>
        <div class="card-body"> 
           
          <h4 class="card-title">
            <a href="{{ route('room',['slug'=>$room->slug]) }}">{{ $room->name }}</a>
          </h4>

          <p class="card-text">Some quick example text to build on the card title...</p>
          <div class="row">
            <div class="col">
              <h2 class="display-4 price">
              <span>AED</span>
              {{ $room->price_single }}
              </h2>
            </div>
            <div class="col">
               <p class="mb-0 mt-1"><del>AED 2500 </del><span class="badge badge-secondary">30% OFF</span></p>
            </div>
          </div>
        </div>
        <a href="{{ route('room',['slug'=>$room->slug]) }}" class="btn btn-link bt-red">Book now</a>
      </div>
    </div>