 

@extends('layouts.app')

@section('content')

@include('common.searchbar',
    [
        'city' => $js->city,
        'checkin' => $js->checkin,
        'checkout' => $js->checkout,
        'rooms' => '',
    ]
    )
<div class="container">

<div class=" mt-5 mb-4">
		<div class="col">
			<div class="card filter-card">
 
				<nav class="navbar navbar-expand-lg navbar-light ">  

				  <div class="collapse navbar-collapse" id="navbarSupportedContent">
				    <ul class="navbar-nav mr-auto">
				      <li class="nav-item active">
				        <a class="nav-link" href="#">Popularity </a>
				      </li> 
				    </ul>
				 
				    <ul class="navbar-nav">
				      <li class="nav-item active">
				        <a class="nav-link" href="#">POPULARITY </a>
				      </li>
				  
				      <li class="nav-item ">
				        <a class="nav-link" href="#">PRICE</a>
				      </li>
				    </ul>


				  </div>
				</nav>


			</div>
			
		</div>
	</div>

    <div class="row mt-5">
        <div> 
            @include('layouts.errors')
            <div class="">
                <div class="" id="__vis_app">


                    <div class="row">
 
                        <searchresult-component></searchresult-component>
                    </div>
 
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  req.city = "{{ $js->city }}";
  req.rooms = "{{ $js->rooms }}";
  req.checkin = "{{ $js->checkin }}";
  req.checkout = "{{ $js->checkout }}";
  req.lastpage = {{ $rooms->lastPage() }}; 
</script>

@endsection
