
		<table class="table">
			<tbody>
				@foreach ($bookings as $booking)
				<tr>
					<td> {{ $booking->refference }} </td>
					<td> {{ $booking->check_in->toFormattedDateString() }} </td> 
					<td> 
						@if( $booking->completed == 1)
						<a class="btn btn-primary" href="{{ route('booked',['refference'=>$booking->refference]) }}" role="button">View </a> 
						@else
						<a class="btn btn-warning" href="{{ route('booked',['refference'=>$booking->refference]) }}" role="button" 
						@if ( $booking->check_in->isToday() != 1 && $booking->check_in->isPast() == 1 )
						disabled
						@endif
						>Pay it</a>
						@endif
					</td>
				</tr>
				@endforeach

			</tbody>
		</table>
		{{ $bookings->links() }}
