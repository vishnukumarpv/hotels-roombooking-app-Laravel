@extends('layouts.app')

@section('content')
<div class="container" id="_cpn">
    <div class="row mt-5">
        <div class="col">
            @include('layouts.errors')
            <div class="card">
                <div class="card-header">
                    Promotion coupons
                </div>

                <div class="card-body">


<div class="card" v-if="flagForm">
  <h4 class="card-header">@{{promo.length}}</h4>
  <div class="card-body">
    <form>
    <div class="row">
        <div class="form-group col">
            <label for="coupon">Coupon</label>
            <input type="text" :value="promo.coupon" class="form-control" disabled>
        </div>
        <div class="form-group col-md-2">
            <label for="discount">Discount</label>
        <div v-if="promo.percentage != null">
            <div class="input-group">
                <input type="text" v-model="promo.percentage" class="form-control">
                <span class="input-group-addon" id="basic-addon2">%</span>
            </div>
        </div>
        <div v-else>
        <div class="input-group">
                <input type="text" class="form-control" v-model="promo.amount">
                <span class="input-group-addon" id="basic-addon2">AED</span>
            </div>
        </div>
        </div>

        <div class="form-group col-md-2">
            <label for="max">Max discount</label>
            <input type="number" v-model="promo.max" class="form-control" >
        </div>

        <div class="form-group col-3">
            <label for="min">min amount to applay coupon</label>
            <input type="number" v-model="promo.amount_min" class="form-control" >
        </div>
    </div>

    <div class="row">
        <div class="form-group col-3">
            <label for="min">starting date</label>
            <input type="date" v-model="promo.valid_from_" class="form-control" >
        </div> 

        <div class="form-group col-3">
            <label for="min">Ending date</label>
            <input type="date" v-model="promo.valid_to_" class="form-control" >
        </div> 

        <div class="form-check" class="col-5">
            <label class="form-check-label pt-4">
                <input class="form-check-input" type="checkbox" v-model="promo.active">
                is active
            </label>
        </div>

        <div class="form-group col-3 pt-4"> 
            <input type="submit" class="form-control btn btn-primary" >
        </div> 
    </div>


    </form>
  </div>
</div>


        @if($discounts)
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Coupon</th>
                        <th scope="col">Validity</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Max Discount</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach( $discounts as $discount)
                        <tr>
                        <th scope="row">{{$discount->id}}</th>
                        <td>{{ $discount->coupon }}</td>
                        <td>
                            <p>{{$discount->valid_from->toFormattedDateString()}}</p>
                            <p>{{$discount->valid_to->toFormattedDateString()}}</p>
                            <p>( {{$discount->valid_to->diff($discount->valid_from)->d .' days'}} )</p>
                        </td>
                        <td>
                           <b> {{ ($discount->percentage != NULL)? $discount->percentage.' %' : $discount->amount.' '.env('APP_CURRENCY') }} </b>
                        </td>
                        <td> {{$discount->max}} </td>
                        <td>{{$discount->created_at->toFormattedDateString()}}</td>
                        <td> <button v-on:click="couponMeth({{$discount->id}})">edit</button> </td>
                        </tr> 
                    @endforeach
                    </tbody>
                    </table>
        @endif
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
const _cpn = new Vue({
    el: '#_cpn',
    data:{
        promo:[],
        flagForm : false,
        action: 'get'
    },
    methods:{
        couponMeth:function(id){ 
            axios.post(conf.ajax_url+'/ad/coupon',{
                coupon: id,
                action: action
            }).then(function(res){ 
                console.log(res.data);
                this.promo = res.data;
                this.flagForm = true;
            }.bind(this));
        }
    },
});
</script>
@endpush