@if ( $is_admin != true && $is_admin == 'owner' )
                    @if ( $booking->completed == 1 )
                        <div class="alert alert-success" role="alert">
                          <b>Yes!</b>  Your booking is successful and thank you for using
                        </div>
                    @else
                        <div class="alert alert-danger" role="alert">
                          <b>Oh ho!</b>  Your booking is unsuccessful and expired! book a room with another date
                        </div>
                    @endif
             @endif
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Booking Reference</td>
                                <td>{{ $booking->refference }}</td>
                            </tr>
                            <tr>
                                <td>Room</td>
                                <td>{{ $booking->room }}</td>
                            </tr>
                            <tr>
                                <td>Hotel</td>
                                <td>{{ $booking->room->hotel }}</td>
                            </tr>
                        </tbody>
                    </table>