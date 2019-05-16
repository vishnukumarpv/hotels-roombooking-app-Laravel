<template>

<ul class="nav nav-fill search-room text-center">
  <li class="nav-item city-s">
    <div class="form-group city-search"> 
        <input type="text"  name="city" id="city" laceholder="Enter city" value="Dubai">
        <small id="city" class="form-text text-muted">United Arab Emirates</small>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link s-date" href="#"><span>10</span> March</a>
  </li>
  <li class="nav-item">
    <a class="nav-link s-date" href="#"><span>18</span> March</a>
  </li>
  <li class="nav-item">
    <a class="nav-link s-date" href="#"><span>2</span> Room</a>
  </li>
    <li class="nav-item">
    <button class="full-btn" type="submit">Go</button>
  </li>
</ul>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
