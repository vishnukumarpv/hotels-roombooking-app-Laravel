                    <div class="row"> 
                          @if (session()->has('success'))
                          <div class="alert alert-success col" role="alert">
                              {{ session()->get('success')}}
                          </div> 
                          @endif
                                     
                    </div>

                    <div class="row"> 
                          @if ($errors->any())
                          <div class="alert alert-danger col" role="alert">
                              {{ $errors->first()}}
                          </div> 
                          @endif
                                     
                    </div>