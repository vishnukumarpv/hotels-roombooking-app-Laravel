<template>
	<div>
	    <div class="form-group city-search">
	        <input v-on:keyup="serachIn" v-model="search_in" type="text" name="city" id="city" v-click-outside="outside">
	        <small id="city"  class="form-text text-muted">United Arab Emirates</small>

	        <ul v-if="sList">
	        	<li v-for="city in cities" @click="suggestionClick(city)"> 
	        		{{city.city}}
	        		<span><i>This is</i></span>
	        	 </li>
	        </ul>
	    </div>

 
	</div>
</template>

<script>
	export default{ 
		data: function(){
			return{
				search_in : req.city,
				cities	: [],
				emirates  : ['Dubai','AbuDhabi','Sharjah','Ajman','Fujairah','Ras al-Khaimah','Umm al-Qaiwain'],
				sList : false
				 
			}  
		},
		methods : {
			serachIn : function(){
				// console.log( this.search_in ); 
				if(this.search_in < 1){
					return false;
				}
				var self = this;
				this.sList = true;
				axios.get('/api/cities',{
					params:{
						'city': this.search_in
					}
				})
				.then(function(cities){
					self.cities = cities.data; 
				})
				.catch(function(err){ 
					console.log(err);
				});
			},
			onClick:function(){
				window.scrollTo({
				  top: 300, 
				  left: 0, 
				  behavior: 'smooth' 
				}); 
				this.sList = true;
			},
			suggestionClick:function(city){
				this.search_in = city.city;
			},
		    outside: function(e) { 
		        this.sList = false;
		      },
		},
		directives: {
		    'click-outside': {
		      bind: function(el, binding, vNode) {
		        // Provided expression must evaluate to a function.
		        if (typeof binding.value !== 'function') {
		        	const compName = vNode.context.name
		          let warn = `[Vue-click-outside:] provided expression '${binding.expression}' is not a function, but has to be`
		          if (compName) { warn += `Found in component '${compName}'` }
		          
		          console.warn(warn)
		        }
		        // Define Handler and cache it on the element
		        const bubble = binding.modifiers.bubble
		        const handler = (e) => {
		          if (bubble || (!el.contains(e.target) && el !== e.target)) {
		          	binding.value(e)
		          }
		        }
		        el.__vueClickOutside__ = handler

		        // add Event Listeners
		        document.addEventListener('click', handler)
					},
		      
		      unbind: function(el, binding) {
		        // Remove Event Listeners
		        document.removeEventListener('click', el.__vueClickOutside__)
		        el.__vueClickOutside__ = null

		      }
		    }
  }
 
	}
</script>