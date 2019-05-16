<template>
	<div>
 <div class="card mt-3 mb-4">
  <div class="">
               <datepickercalendar  
               v-on="{checkInChanged:checkInChange_,checkOutChanged:checkOutChange_}"
                 ></datepickercalendar>
  </div>
</div>
 
				<div class="rooms_guests">
 					<div class="addedrooms">
 						{{userin.rooms}} Room and {{userin.guests}} guests.
 						<p>{{nights}} Nights.</p>
 						<a href="javascript:void(0)" @click="rooms_edit=!rooms_edit">Edit</a>
 					</div>
 					
                        <div class="add_rooms_" v-show="rooms_edit">
                        	<span class="close_r" @click="rooms_edit=!rooms_edit">X</span>
							<div class="add_r_wr">
								<div class="form-group more-rooms" v-for="index in userin.rooms">
									<label id="rooms">Room {{index}} :  Guests</label>
									<select :name="'room['+index+']'"  @change="changed_" v-model="userin.room[index]" class="form-control" id="rooms"> 
										<option v-for="index in max_occu">{{index}}</option>
									</select> 

								</div>
							</div>

                            <span class="btn btn-success" @click="rooms_edit=!rooms_edit">Done</span>

                            <span v-if="(available-userin.rooms) > 0 && userin.room.length>1" @click="roomAdded_" class="btn btn-warning">Add more</span>
                            <span v-if="userin.rooms>1" @click="roomRemoved_" class="btn btn-danger">Delete room</span>
                        </div>
                </div>

            <p v-if="!b_flag" class="_r_nt_bookable">
			  We are sorry! the available rooms are less than you selected
			</p>


    <div class="form-group -book-btn">
        <div class="row">
            
                <div class="col p-0">
                    <label class="amount">
                                        <span>Total</span>
                                        {{price_dis}}
                                        <span class="aed">AED</span>
                                        </label>

                                    </div>
                                    <div class="col p-0">
                                        <button :disabled="!b_flag"  class="full-btn" type="submit">Go</button>
        							</div> 
                                </div>

                                
                              </div>
	</div>
</template>

<script> 
	export default{
		data: function(){
			return { 
						userin	: {
							rooms: parseInt(window.req.rooms),
							guests: 1,
							room: Array(1)
						},
						checkout : new Date(window.req.checkout),
						checkin	: new Date(window.req.checkin), 
						price 	:{
							single: 0.0,
							double: null,
							extra: null
						},
						nights:1,
						available: 0,
						max_occu : 0,
						b_flag: true,
						price_dis: 0, 
						rooms_edit : false,
						total_rooms : 0
				 }
		},
 
		 
		methods: {
			update_ : function(){ 
				console.log(this.checkin);
				axios.get('/api/availability',{
					params	: {
						room : window.req.room,
						checkin : formatDate(this.checkin,'YYYY-MM-dd') ,
						checkout : formatDate(this.checkout,'YYYY-MM-dd') ,
					}
				}
				)
				.then(function(res){
					if(res.error == true){
						console.log(res.message);
						return false;
					}else{
						res= res.data; 
						this.max_occu = res.max_occupancy;
						this.checkin =  new Date(res.dates[0]); 
						this.checkout =  new Date(res.dates[1]);
						this.price = {
							single: res.prices[0],
							double: res.prices[1],
							extra: res.prices[2]
						};
						this.available = res.available_rooms;
						this.nights = res.nights;
						this.total_rooms = res.total_rooms;
						
			console.log(this.userin.room +" rooms");
  
					} 
					this.bookable_();
					this.display_pri_();


				}.bind(this))
				.catch(function(err){
					console.log(err);
				});
			},
			changed_ : function(){
				this.update_();

			},
			display_pri_ : function(){ 
				this.price_dis = 0;
				this.userin.guests = 0;
				this.userin.room.forEach(function(r){
					 
					if(r>=1){
						this.price_dis = this.price_dis + this.price.single;
					}

					if(r>=2){
						this.price_dis = this.price_dis + this.price.double;
					}

					if(r>=3){
						this.price_dis = this.price_dis + (this.price.extra * (parseInt(r)-2));
					}
					this.userin.guests = this.userin.guests+parseInt(r);

				},this);

				this.price_dis = this.price_dis * this.nights;
			},
			checkInChange_: function(checkin){
				if(checkin == null){ return false; }
				this.checkin = checkin;
				this.nights = 1;
				this.display_pri_(); 
			},
			checkOutChange_: function(checkout){
				if(checkout == null){ return false; } 
				this.checkout = checkout; 
				this.update_();
			},
			roomAdded_:function(){
				this.userin.rooms++;
				this.changed_();
				this.userin.room.push(1);

			},
			roomRemoved_:function(){
				this.userin.room.splice(-1,1);
				this.userin.rooms--;
				this.changed_();
			},
			bookable_:function(){ 
				if(this.userin.rooms <= this.total_rooms 
					&& this.available > 0 
					&& this.userin.rooms <= this.available 
				){
					return this.b_flag = true; 
				}else{
					return this.b_flag = false;
				}
			}
		},
		beforeMount : function(){  
			this.update_(); 
			this.userin.room.push(1);
			
		} 
	}
</script>