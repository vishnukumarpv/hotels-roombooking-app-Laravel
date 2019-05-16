app.js


Vue.component('datepickercalendar', require('./components/HotelDatePicker/DatePicker.vue')); 
Vue.component('cityinput-component', require('./components/cityInput.vue')); 
.........
Vue.component('roombooking-cmp',require('./components/Booking.vue'));

const app = new Vue({ 
    el: '#__vis_app',
    
});


Booking.vue

<template>
	<datepickercalendar></datepickercalendar>
</template>


