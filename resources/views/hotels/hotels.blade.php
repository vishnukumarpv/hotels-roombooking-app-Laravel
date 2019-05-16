                    @empty ( $hotels->count() )
                        <h4>No hotels to show..</h4>
                    @endempty
                    <div class="row">
                @foreach ($hotels as $hotel)
                    <div class="  col-4"  > 
                      <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                      @include ('layouts.image' ,[
                      'image' => ( count($hotel->media) )? $hotel->media[0] : '',
                      'alt' => $hotel->name,
                      'folder' => 'hotel'
                      ]) 
                      <div class="card-body">
                        <h4 class="card-title"> {{ $hotel->name }} </h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> 
                        <a href="{{ route('hotel',['slug'=> $hotel->slug ]) }}" class="btn btn-primary">Explore Hotel</a>
                      </div>
                    </div>
                @endforeach
                </div>