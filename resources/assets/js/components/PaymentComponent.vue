<template> 
    <div>
        	<div class="form-group">
			    <label for="card_num">Card Number</label>
			    <input type="text" class="form-control" name="card_num" id="card_num" aria-describedby="card_num" placeholder="Enter card number">
 
			</div>
			<div class="form-group">
			      <label for="cvv_num">CVV code</label>
			      <input type="text" class="form-control" name="cvv_num" id="cvv_num" aria-describedby="cvv_num" placeholder="CVV">
 
			      
			    </div>
			    <div class="form-group">
                    <label for="coupon_code">Coupon code</label>
      <div class="input-group coupon_inp">
        <input type="coupon" v-model="coupon" class="form-control" name="coupon_code" id="coupon_code" aria-describedby="coupon_code" placeholder="promo code">
        <span class="input-group-btn" v-on:click="coupon_">
            check 
        </span>
    </div>
            <div v-if="c_success!=0">
                <label v-if="c_success==1" for="coupon" class="text-success mb-0">Coupon applied.</label>
                <label v-else-if="c_success==2" for="coupon" class="text-danger mb-0">Coupon invalid.</label>
                <label v-else-if="c_success==3" for="coupon" class="text-danger mb-0">Loading...</label>
            </div>
			    </div>


                
			    <div class="form-group">
			        <label for="amount">Amount</label>
			        <input type="text" class="form-control" name="amount" id="amount" aria-describedby="amount" disabled="1" v-model="amount">
			         <label v-if="promo_applied" for="amount" class="text-success mb-0">Promo applied. Discount is {{promo.reduced}}</label>
			     </div>
				<button type="submit" name="submit" class="btn btn-primary myClass">Book it</button> 
    </div>
</template>

<script>
export default {
    data:function(){
        return{
            coupon : '',
            amount  :   window.b_data.amount,
            c_success:   0,
            c_try   :   false,
            promo_applied: false,
            promo:{
                reduced:0
            }
        }
    },
    methods:{
        coupon_:function(){
            if(this.coupon.length>2){
                this.c_success = 3;
                this.checkCoupon(); 
            }
        },
        checkCoupon: function(){
            axios.post(window.conf.ajax_url+'/validate_coupon',{
                coupon:this.coupon,
            })
            .then(function(res){
                let data = res.data; 
                this.promo.reduced  = 0;
                if(data.valid == true){
                    this.c_success = 1;
                    this.amount = data.data.promo_price;
                    this.promo_applied = true;
                    this.promo.reduced = data.data.reducted;
                }else{
                    this.c_success = 2;
                    this.promo_applied = false;
                    this.amount = window.b_data.amount;
                } 
            }.bind(this))
        }

    },
    beforeMount: function(){
         
    }
}
</script>
