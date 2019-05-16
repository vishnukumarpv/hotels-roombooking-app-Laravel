<div class="card full-width mt-4">
	<div class="card-header"> <h4>{{ $reviews->count() }} Reviews</h4></div>
	<div class="card-body">
		<div class="row">
			<div class="  col">
			  <div class="card-body">

			    @if( $reviews )
			    	@foreach ($reviews as $review) 

			    		{{ $review->review }}

			    		<span class="badge badge-primary float-right">Rated : {{ $review->rating }}</span>
			    		<span class="badge badge-secondary float-right">
			    			{{ $review->user->first_name }} 
			    			{{ $review->user->last_name }}
			    		</span>

			    		<p>{{ Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</p>
			    		<div class="border border-primary"></div>
			    	@endforeach
			    @else
			    There is no comments to show!.
			    @endif
			  </div>
			</div>
		</div>
		<div class="row">
		@if( Auth::check() )
		<form class="col" action="" method="post">
			{{ csrf_field() }}
			  <div class="form-group">
			    <label for="rating">Give your rating</label>
			    <select name="rating" class="form-control" id="rating"> 
			      <option>Select your rating</option>
			      @for($i=0; $i <= 5; $i++ )
			      	<option value="{{ $i }}"
			      	@if ( $current_user_rating && $current_user_rating->rating == $i )
			      	selected="1" 
			      	@endif 
			      	> {{ $i }} </option>
			      @endfor; 
			    </select>
			    @if ($errors->has('rating')) 
			        <small id="rating" class="form-text  text-danger">{{ $errors->first('rating') }}.</small>
			    @endif
			  </div>

			  <div class="form-group">
			    <label for="review">Write your comments</label>
			    <textarea name="review" class="form-control" id="review" rows="3">{{ old('review') }}
			 </textarea>
			 @if ($errors->has('review')) 
			     <small id="review" class="form-text  text-danger">{{ $errors->first('review') }}.</small>
			 @endif
			  </div>
			  <button type="submit" name="submit" class="btn btn-primary myClass">Add</button>

		</form>
		@else
		<div class="card col-12">
			<div class="card-body"><h4>Please login to add your comments..</h4></div>
		</div>
			
		@endif

		</div>
		 
	</div>
</div>