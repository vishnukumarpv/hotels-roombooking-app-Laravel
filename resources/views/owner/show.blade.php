@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col ">
            <div class="card full-width">
                <div class="card-header"><h3>dsfsf</h3></div>
                <div class="card-body" id="bookings_own">
                <div v-if="bookings.length" class="bookings_a">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Room</th>
                        <th scope="col">Person</th>
                        <th scope="col">Dates</th>
                        <th scope="col">No.s</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(booking, sl) in bookings">
                        <th scope="row" v-text="++sl"></th>
                        <td v-text="booking.room.name"></td> 
                        <td v-text="booking.user.first_name"></td> 
                        <td v-text="booking.check_in+' '+booking.check_out"></td> 
                        <td v-text="booking.rooms"></td>  
                        <td style="width:100px">

                        <span v-if="booking.vacated==1" class="badge badge-primary">Vacated</span>
                        <span v-if="booking.status.today_checkout==1" class="badge badge-dark">Today is the check out</span>
                        <span v-if="booking.status.past==1" class="badge badge-secondary">out dated</span>
                        <span v-if="booking.status.future==1" class="badge badge-seccondary">upcomming booking</span>
                        <span v-if="booking.status.in_room==1" class="badge badge-success">currently in room</span> 
                        </td> 
                        </td>
                        <td><a :href="'owner/booking/'+booking.refference" class="btn">view</a></td>  
                        </tr>
                    </tbody>
                </table>
                        <nav aria-label="Page navigation example">
                        <ul v-if="t_pages > 1" class="pagination">
                            <li class="page-item" :class="{'disabled':curpg<=1}"><a class="page-link" @click="pagenate(--curpg)">Previous</a></li>

                            <li v-for="index in t_pages" class="page-item" v-bind:class="{ active: index==curpg }">
                            <a class="page-link"  @click="pagenate(index)">@{{index}}</a>
                            </li>

                            <li :class="{'disabled':curpg>=t_pages}" class="page-item"><a class="page-link" @click="pagenate(++curpg)">Next</a></li>
                        </ul>
                        </nav>
                </div>
                <div v-else class="no_bookings">
                <h3>No new bookings...</h3>
                </div>

                </div> 
 
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
const bkings = new Vue({
    el:'#bookings_own',
    data:{
        bookings : Array(),
        t_pages:0,
        curpg : 1,
        nxt_pg:'',
        prv_pg:'',
    },
    methods:{
        getBookings:function(){
            axios.post('/vjx/bookings',{
                page    :   this.curpg
            })
            .then(function(res){
                let resp = res.data;
                this.bookings = res.data.data;
                this.t_pages = res.data.last_page;
                this.nxt_pg = res.data.next_page_url;
                this.prv_pg = res.data.prev_page_url;
                console.log(this.bookings);
            }.bind(this))
        },
        pagenate:function(index){
            this.curpg = index;
            this.getBookings();
            console.log(this.curpg); 
        }
    },
    beforeMount: function(){
        this.getBookings();
    }
});
</script>
@endpush

@endsection
