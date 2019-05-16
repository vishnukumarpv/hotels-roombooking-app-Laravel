                    <div class="row">
                        
                          @if ($errors->any())
                          <div class="alert alert-danger col" role="alert">
                          <ul>
                              @foreach ($errors->all() as $error )
                              <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                          </div> 
                          @endif
                                     
                    </div>