      
      {{ csrf_field() }}
                     <div class="form-group">
                        <label for="name">Hotel Name</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="{{ form_in('name',$hotel) }}" placeholder="Enter name of the hotel">
                        @if ($errors->has('name')) 
                            <small id="name" class="form-text  text-danger">{{ $errors->first('name') }}.</small>
                        @endif
                      </div>

 

                     <div class="form-group">
                        <label for="description">Hotel Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ form_in('description',$hotel) }} </textarea>
                      @if ($errors->has('description')) 
                          <small id="description" class="form-text  text-danger">{{ $errors->first('description') }}.</small>
                      @endif
                      </div>

                      <div class="form-group">
                        <label for="address">Hotel Address</label>
                        <input type="text" value="{{ form_in('address',$hotel) }}" class="form-control col-6" id="address" name="address" aria-describedby="address" placeholder="Enter address">
                      @if ($errors->has('address')) 
                          <small id="address" class="form-text  text-danger">{{ $errors->first('address') }}.</small>
                      @endif
                      </div>


                    <div class="row">
                      <div class="form-group col">
                        <label for="street">Street</label>
                        <input type="text" class="form-control" id="street" name="street" aria-describedby="street" value="{{ form_in('street',$hotel) }}" placeholder="Enter street">
                    @if ($errors->has('street')) 
                        <small id="street" class="form-text  text-danger">{{ $errors->first('street') }}.</small>
                    @endif
                      </div>

                      <div class="form-group col">
                        <label for="city">Hotel city</label>
                        <input type="text" class="form-control" id="city" name="city" aria-describedby="city" value="{{ form_in('city',$hotel) }}" placeholder="Enter city">
                      @if ($errors->has('city')) 
                          <small id="city" class="form-text  text-danger">{{ $errors->first('city') }}.</small>
                      @endif
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col">
                        <label for="phone">Phone</label>
                        <input type="number" class="form-control" id="phone" name="street" aria-describedby="phone" value="{{ form_in('street',$hotel) }}" name="phone" placeholder="Enter Phone">
                      @if ($errors->has('phone')) 
                          <small id="phone" class="form-text  text-danger">{{ $errors->first('phone') }}.</small>
                      @endif
                      </div>

                      <div class="form-group col">
                        <label for="email">email</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Enter email" value="{{ form_in('email',$hotel) }}">
                      @if ($errors->has('email')) 
                          <small id="email" class="form-text  text-danger">{{ $errors->first('email') }}.</small>
                      @endif
                      </div>
                    </div>




                 <div class="row">
                      <div class="form-group col-6">
                        <label for="web">web site</label>
                        <input type="text" class="form-control" id="web" name="web" aria-describedby="web" name="web" 
                        value="{{ (form_in('web',$hotel))? form_in('web',$hotel) : 'http://www.' }}" 

                        placeholder="Enter web site address">
                      @if ($errors->has('web')) 
                          <small id="web" class="form-text  text-danger">{{ $errors->first('web') }}.</small>
                      @endif
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
                        <div id="imgUp" class="dropzone" style="width:80%; height:250px; background:#ddd"></div>
                        </div>
                      </div>



                      <div class="form-group row">
                        <div class="col-sm-10">
                          <button type="submit" class="btn btn-primary">{{$button}}</button>
                        </div>
                      </div>


@push('scripts')
  <script>
    const imgUp = new DrpImg('div#imgUp', { 
			url: "/file/post",
			uploadMultiple: true,
			autoProcessQueue: false
	});
  </script>
@endpush