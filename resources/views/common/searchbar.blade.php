  <script type="text/javascript">
    req = @json(['city'=> 'Dubai', 'rooms' => 1]) ;
  </script>

<div id="__search">
  <form action="{{ route('search') }}" method="get">
      <ul class="nav nav-fill search-room text-center">
            <li class="nav-item city-s">
          <!--     <div class="form-group city-search"> 
                  <input v-model="search_in" type="text"  name="city" id="city" laceholder="Enter city" value="Dubai" v-on:keyup="serachIn">
                  <small id="city" class="form-text text-muted">United Arab Emirates</small>
              </div> -->

              <cityinput-component></cityinput-component>
            </li>
           
            <li class="nav-item" style="max-width: 333px">
<!--               <datepickercalendar
                :endingDateValue="new Date('2018-05-30')"
              ><datepickercalendar/> -->
<datepickercalendar></datepickercalendar>


            </li>
            <li class="nav-item">
              <roomsselect-component></roomsselect-component> 
            </li>
              <li class="nav-item">
              <button class="full-btn" type="submit">Go</button>
            </li>
      </ul>
    </form>
</div>

