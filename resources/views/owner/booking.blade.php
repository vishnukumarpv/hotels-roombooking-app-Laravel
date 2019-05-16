@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col ">
            <div class="card full-width">
                <div class="card-header"><h3>dsfsf</h3></div>
                <div class="card-body">



                <div class="card border-primary mb-3" id="room_act"> 
                <div class="card-body text-primary"> 
            @if($booking->vacated != 1)
                @if( ( $booking->check_in->isToday() || $booking->check_in->isPast() && 
                    $booking->check_out->isFuture() || $booking->check_out->isToday() ) || 
                    $booking->check_out->isFuture())
                    <div v-if="!vacated">
                        <h4 class="card-title">Special title treatment</h4>
                        <p>Vacate this room </p>
                            <button @click="vacateRoom" class="btn vacate">Vacate Room</button>
                    </div>
                    <div v-else>
                    <p class="card-text">Room vacate initiated</p>
                    </div>
 
                    @else 
                    <p class="card-text text-warning">This Booking is Expired {{$booking->check_out->diffForHumans()}}</p>
                    @endif
            @else
                    <p class="card-text">Room vacated</p>
                
             @endif
                </div>
                </div>



                @include('booking._booking',['is_admin'=>'owner'])
                </div>



  
 
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
const mng_bk = new Vue({
    el:'#room_act',
    data:{
        vacated:false
    },
    methods:{
        vacateRoom:function(){
            if(confirm("are you sure to vacate this booking?")){
                axios.post('/vjx/bookings/vacate',{
                    ref: '{{$booking->refference}}',
                    vacate:1
                }).then(function(res){
                        // console.log(res.data);
                        this.vacated = res.data.success;
                }.bind(this))
            }
        }
    }
});
</script>
@endpush
 

@endsection
