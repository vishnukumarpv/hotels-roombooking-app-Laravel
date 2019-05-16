<div class="row">
@include('layouts.errors')
</div>
<div class="card">
	<div class="card-header"> Payment options</div>
	<div class="card-body" id="_pay_pg">
		<form class="form" action="{{ route('pay')}}" method="post"> 
		{{ csrf_field() }}
				<payment-component> </payment-component>
		</form>

	</div> 
</div>
 
<script> var b_data = @json(['amount'=> $booking->amount]) ;</script> 