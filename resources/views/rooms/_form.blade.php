{{ csrf_field() }}
 

          	  <div class="form-group">
          	    <label for="name">Room name</label>
          	    <input type="text" class="form-control" id="name" name="name"
          	    value="{{ form_in('name',$room) }}"
          	    placeholder="Enter room name">

                @if ($errors->has('name')) 
                    <small id="name" class="form-text  text-danger">{{ $errors->first('name') }}.</small>
                @endif
                 
          	  </div>

               <div class="form-group">
                        <label for="description">Room Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ form_in('description',$room) }}</textarea>
                      @if ($errors->has('description')) 
                          <small id="description" class="form-text  text-danger">{{ $errors->first('description') }}.</small>
                      @endif

               <div class="row">

                 <div class="form-group col-md-3">
                        <label for="hotel_name">Total rooms</label>
                        <input type="number" value="{{ form_in('total_rooms',$room) }}" class="form-control" id="total_rooms" name="total_rooms" aria-describedby="total_rooms">
                      @if ($errors->has('total_rooms')) 
                          <small id="total_rooms" class="form-text  text-danger">{{ $errors->first('total_rooms') }}.</small>
                      @endif
                 </div>

                 <div class="form-group col-3">
                     <label for="max_person">Maximum persons in this room</label>
                     <input type="number" class="form-control" name="max_person" id="max_person" aria-describedby="max_person" value="{{ form_in('max_person',$room) }}">
                  @if ($errors->has('max_person')) 
                      <small id="max_person" class="form-text  text-danger">{{ $errors->first('max_person') }}.</small>
                  @endif
                   </div>
                 </div>

                 <div class="row">
     



<div class="card col-md-12">
  <div class="card-body">
    <div class="row">
 

                 <div class="form-group col-md-3">
                     <label for="price_single">Price single</label>
                     <input type="number" class="form-control" name="price_single" id="price_single" aria-describedby="price_single" placeholder="Enter single bed price" value="{{ form_in('price_single',$room) }}">
                      @if ($errors->has('price_single')) 
                          <small id="pernight" class="form-text  text-danger">{{ $errors->first('price_single') }}.</small>
                      @endif
                 </div>

                 <div class="form-group col-md-3">
                     <label for="price_double">Price double</label>
                     <input type="number" class="form-control" name="price_double" id="price_double" aria-describedby="price_double" placeholder="Double bed price" value="{{ form_in('price_double',$room) }}">
                      @if ($errors->has('bedprice_double')) 
                          <small id="pernight" class="form-text  text-danger">{{ $errors->first('price_double') }}.</small>
                      @endif
                 </div>

                 <div class="form-group col-md-3">
                     <label for="price_extra">price extra beds</label>
                     <input type="number" class="form-control" name="price_extra" id="price_extra" aria-describedby="price_extra" placeholder="price for the extra beds" value="{{ form_in('price_extra',$room) }}">
                      @if ($errors->has('price_extra')) 
                          <small id="pernight" class="form-text  text-danger">{{ $errors->first('price_extra') }}.</small>
                      @endif
                 </div>
                 </div>
  </div>
</div>




                 </div>


 

<div class="row">
              <div class="form-group col-md-3">
        			  <label class="form-check-label">  
        			    <input class="form-check-input" name="first_child" type="checkbox" 
        			    value="1" 
        			    {{ (  form_in('first_child',$room) )?'checked':'' }}>
        			    Free for one child
          			  </label>
              @if ($errors->has('first_child')) 
                  <small id="first_child" class="form-text  text-danger">{{ $errors->first('first_child') }}.</small>
              @endif    
          			</div>
              </div>



        <div class="card">
          <div class="card-body">
          <h4>Amenities</h4>
          <div class="form-group" style="columns: 2;">
            

            @foreach($amenities as $amenity)
         
                  <label class="custom-control custom-checkbox">   
                    <input type="checkbox"  name="amenities[{{$amenity->id}}]" value="{{$amenity->id}}" 
                    {{ ($amenities_room->has($amenity->id))?'checked':''}}> 
                    <span class="custom-control-description">{{ $amenity->name }}</span>
                  </label>
            @endforeach
            @if ($errors->has('aminities')) 
                <small id="aminities" class="form-text  text-danger">{{ $errors->first('aminities') }}.</small>
            @endif
          </div>
          </div>
        </div>

        
                  <div class="form-group row">
                    <div class="col-sm-10">
                    <label class="custom-file2">
                      <input type="file" id="images" name="images" class="custom-file-input2">
                      <span class="custom-file-control"></span>
                    </label>
                    @if ($errors->has('images')) 
                        <small id="images" class="form-text  text-danger">{{ $errors->first('images') }}.</small>
                    @endif
                  </div>
                  </div>


                        <div class="form-group row">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">{{$button}}</button>
                          </div>
                        </div>
