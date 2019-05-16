                       <tr>
                          <th scope="row">{{ $key+1 }}</th>
                          <td>{{ $booking->refference }}</td>
                          <td>{{ $booking->room->name }}</td>
                          <td>{{ $booking->user->first_name }}</td>
                          <td>{{ $booking->user->email }}</td>
                          <td>
                          	<p>{{ humanize_date($booking->check_in) }}</p>To
                          	{{ $booking->check_in->diffInDays($booking->check_out) }} Days
                          	<p>{{ humanize_date($booking->check_out) }}</p>

                          </td>
                          <td> {{ humanize_date($booking->created_at) }} </td>
                          <td> <a href="{{route('owner.booked',['refference'=>$booking->refference])}}" class="btn btn-primary ">View</a> </td>
                        </tr>