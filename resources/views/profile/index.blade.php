 
 

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                <div class="row">
                	<div class="col-3">
                		<img src="" alt="Image">
                	</div>
                	<div class="col-9">
                		
                		<table class="table">
                			<tbody>
                				<tr>
                					<td><b>Nmae</b></td> <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                				</tr>
                				<tr>
                					<td>email</td>
                					<td>{{ $user->email }}</td>
                				</tr>
                				<tr>
                					<td>Phone</td>
                					<td>{{ $user->phone }}</td>
                				</tr>
                			</tbody>
 						
                		</table>

                	</div>
                    
                </div>
            </div>
            </div>
        </div>
</div>
        <div class="row mt-5">
        	<div class="col">
        <div class="card">
            <div class="card-header"> Your bookings</div>
            <div class="card-body">
                @if ( $bookings->count() >= 1 )
        		  @include('profile.bookings')
                @else
                <p><b>Currently no bookings related to your account.</b></p>
                @endif
            </div>
        </div>
        	</div>
        </div>


        <div class="row mt-5">
        	<div class="col">
        		<div class="card">
        			<div class="card-header">The hotels associated with this user</div>
        			<div class="card-body">
        				@include('hotels.hotels')
        			</div>
        		</div>
        	</div>
        </div>


    
</div>
@endsection
