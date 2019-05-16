<template>
	<div class="col-12">
		<div class="row"> 

<div v-if="rooms" v-for="room in rooms" :key="room.id" class="col-md-3"  style="width: 20rem;">
		<div class="card room-d">

			<div class="thumb">
				<img v-if="room.media" v-bind:src="'/public/images/room/'+room.media[0].filename"  class="img-fluid" alt="Special treatment">
				<span class="badge badge-success rating-c">Rating <span>4</span></span> 
			</div>

				<div class="card-body"> 
				
				<h4 class="card-title">
					 <a :href="room.url">{{room.name}}</a>
				</h4>

				<p class="card-text">{{room.description}}</p>
				<div class="row">
					<div class="col">
					<h2 class="display-4 price">
					<span>AED</span>
					{{room.price_single}}
					</h2>
					</div>
					<div class="col">
					<p class="mb-0 mt-1 offer-r"><del>AED 2500 </del><span class="badge badge-secondary">30% OFF</span></p>
					</div>
				</div>
				</div>
				<a :href="room.url" class="btn btn-link bt-red">Book now</a>
			</div>
</div>

 

		</div> 
                    <div class="row mt-4">
                    	<button v-if="showBtn" @click="loadMore" class="btn bt-load">Load More</button>
                    </div>
	</div>
</template>

<script>
	export default{
		data:function(){
			return {
				rooms	: [],
				page	: 1,
				req		: req,
				showBtn : true,
			}
 
		}, 
		methods:{
			loadMore : function(){ 
				axios.get('/api/search',{
					params:{
						city : this.req.city,
						checkin : this.req.checkin,
						checkout : this.req.checkout,
						page : this.page,
					}
				})
				.then(function(res){
					let resRooms = res.data; 
					this.page = this.page + 1; 
						if(res.data.current_page == res.data.last_page){
							this.showBtn = false;
						}

					// this.rooms.push(resRooms.data[0]);
					resRooms.data.forEach(function( rd ){
						rd.url = '/room/'+rd.slug
							+'?checkin='+this.req.checkin
							+'&checkout='+this.req.checkout
							+'&rooms='+this.req.rooms;
						rd.description = _.truncate( rd.description,{length:40});
						if( rd.media.length == 0){
							rd.media = false;
						}
						this.rooms.push(rd);
					},this)

					 console.log(this.rooms);
				 
				}.bind(this) )
				.catch(function(err){
					console.log(err);
				}); 
				
			}
		},
		beforeMount: function(){
			if(req.lastpage <= 1){
				this.showBtn = false;
			}
			this.loadMore();
			
		}
	}
</script>