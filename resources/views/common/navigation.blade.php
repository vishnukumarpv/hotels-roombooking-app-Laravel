
	<nav class="navbar navbar-light bg-light main-nav">
	<div class="container">
		  <a class="navbar-brand" href="{{ url('/') }}">
		    <img src="{{ asset('images/logo.png') }}" width="120" height="40" alt=" {{ config('app.name', 'Vishnu') }}">
		  </a>

		<ul class="nav justify-content-end"> 
			@if (Auth::guest())
		  <li class="nav-item">
		   <a href="{{ route('login') }}" class="btn btn-link ">Sign in</a>
		  </li>
		  <li class="nav-item">
		    <a href="{{ route('register') }}" class="btn btn-primary ">Sign up</a>
		  </li>
		  @else
		  <li class="nav-item">
		   <a href="{{ route('profile') }}" class="btn btn-link btn-success">Profile</a>
		   <a href="{{ route('logout') }}" class="btn btn-link danger">Sign out</a>
		  </li>
		  @endif
		</ul>
		
		
  </div>
</nav>
 