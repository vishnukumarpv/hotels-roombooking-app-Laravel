<template>
	<div class="rooms" @click="checked = !checked">
		<div class="nav-link s-date" href="#"><span>{{val}}</span> Room</div>
		<input type="hidden" name="rooms" v-model="val">
			<transition name="slide-fade" mode="out-in">
				<ul v-show="checked" class="select-list">
					<li @click="val=1">1</li>
					<li @click="val=2">2</li>
					<li @click="val=3">3</li>
				</ul>
			</transition>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				checked	: false,
				val : req.rooms
			}
		},
		methodes : {
			clickToggele(){
				this.checked = !this.checked;
			}
		}
	}
</script>