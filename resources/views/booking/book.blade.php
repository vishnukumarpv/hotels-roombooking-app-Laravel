 

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-9">
            <div class="card">
                <div class="card-header">Booking</div>
                <div class="card-body">
                    <div class="col">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Room </td>
                                    <td>{{ $room->name }} </td>
                                </tr>
                                <tr>
                                    <td>Duration</td>
                                    <td>{{ $booking->check_in->toFormattedDateString() }} to 
                                        {{ $booking->check_out->toFormattedDateString() }} 
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hotel</td>
                                    <td>{{ $room->hotel->name }}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td> {{ $booking->amount }}
                                        ( {{ $booking->rooms }} Room.)

                                     </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    
                </div>
            </div> 
        </div> 
                    <div class="col-3">
                        @include('booking.payment')
                    </div>
        
    </div>


</div>
@endsection
