        <div class="card">
            <div class="card-header">
                Book this room
            </div>
            <div class="card-body">
              @if (Auth::check())
                <form action="{{ route('book',['slug'=>$room->slug]) }}" method="post">
                     {{ csrf_field() }}
 
                    <div class="form-group">
                        <label for="rooms">The room count you want</label>
                        <input type="number" class="form-control" name="rooms" id="rooms" aria-describedby="rooms" placeholder="Rooms" value="{{ old('rooms') }}">
                              @if ($errors->has('rooms')) 
                              <small id="rooms" class="form-text  text-danger">{{ $errors->first('rooms') }}.</small>
                              @endif
                      </div>

                      <div class="form-group">
                          <label for="starting">Date of stay</label>
                          <input type="date" class="form-control" name="check_in" id="starting" aria-describedby="starting" value="{{ old('check_in') }}"> 
                          @if ($errors->has('check_in')) 
                              <small id="check_in" class="form-text  text-danger">{{ $errors->first('check_in') }}.</small>
                          @endif
                        </div>
                    <div class="form-group">
                        <label for="ending">To</label>
                        <input type="date" class="form-control" name="check_out" id="ending" aria-describedby="ending" value="{{ old('check_out') }}"> 
                      </div>


                        <button type="submit" name="submit" class="btn btn-primary ">Book Now</button>
                </form>

            @else
            <p>Please login or register to book this room</p>
            <a href="{{ route('login') }}" class="btn btn-primary ">Login</a>

            @endif
            </div>
  
        </div>