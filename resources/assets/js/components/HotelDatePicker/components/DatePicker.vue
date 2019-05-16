<template lang='pug'> 
  .datepicker__wrapper(v-if='show' v-on-click-outside="hideDatepicker" )
    .datepicker__close-button.-hide-on-desktop(v-if='isOpen' @click='hideDatepicker') ＋
    .datepicker__dummy-wrapper( @click='isOpen = !isOpen' :class="`${isOpen ? 'datepicker__dummy-wrapper--is-active' : ''}`") 
      label.datepicker_vi_inp(for="datepicker__input",  v-html="checkIn ? dateDispaly(checkIn) : ''")  
      input.datepicker__dummy-input.datepicker__input(
        data-qa='datepickerInput'
        name='checkin'
        :class="`${isOpen && checkIn == null ? 'datepicker__dummy-input--is-active' : ''} ${singleDaySelection ? 'datepicker__dummy-input--single-date' : ''}`"
        :value="`${checkIn ? formatDateForm(checkIn) : ''}`"
        :placeholder="i18n['check-in']"
        type="hidden" 
        readonly
      )
 
      label.datepicker_vi_inp(for="datepicker__input",  v-html="checkOut ? dateDispaly(checkOut) : ''") 
      input.datepicker__dummy-input.datepicker__input(
        v-if='!singleDaySelection'
        name='checkout'
        :class="`${isOpen && checkOut == null && checkIn !== null ? 'datepicker__dummy-input--is-active' : ''}`"
        :value="`${checkOut ? formatDateForm(checkOut) : ''}`"
        :placeholder="i18n['check-out']"
        type="hidden"
        readonly
      )
     
    .datepicker( :class='`${ !isOpen ? "datepicker--closed" : "datepicker--open" }`')
      .-hide-on-desktop
        .datepicker__dummy-wrapper.datepicker__dummy-wrapper--no-border(
          @click='isOpen = !isOpen' :class="`${isOpen ? 'datepicker__dummy-wrapper--is-active' : ''}`"
          v-if='isOpen'
        )
          input.datepicker__dummy-input.datepicker__input(
            :class="`${isOpen && checkIn == null ? 'datepicker__dummy-input--is-active' : ''}`"
            :value="`${checkIn ? formatDate(checkIn) : ''}`"
            :placeholder="i18n['check-in']"
            type="text" 
            readonly
          )


          input.datepicker__dummy-input.datepicker__input(
            :class="`${isOpen && checkOut == null && checkIn !== null ? 'datepicker__dummy-input--is-active' : ''}`"
            :value="`${checkOut ? formatDate(checkOut) : ''}`"
            :placeholder="i18n['check-out']"
            type="text"
            readonly
          )


      .datepicker__inner
        .datepicker__header
          span.datepicker__month-button.datepicker__month-button--prev.-hide-up-to-tablet(
            @click='renderPreviousMonth'
          )
          span.datepicker__month-button.datepicker__month-button--next.-hide-up-to-tablet(
            @click='renderNextMonth'
          )
        .datepicker__months(v-if='screenSize == "desktop"')
          div.datepicker__month(v-for='n in [0,1]'  v-bind:key='n')
            h1.datepicker__month-name(v-text='getMonth(months[activeMonthIndex+n].days[15].date)')
            .datepicker__week-row.-hide-up-to-tablet
              .datepicker__week-name(v-for='dayName in i18n["day-names"]' v-text='dayName')
            .square(v-for='day in months[activeMonthIndex+n].days'
              @mouseover='hoveringDate = day.date')
              Day(
                :options="$props"
                @dayClicked='handleDayClick($event)'
                :date='day.date'
                :sortedDisabledDates='sortedDisabledDates'
                :nextDisabledDate='nextDisabledDate'
                :activeMonthIndex='activeMonthIndex'
                :hoveringDate='hoveringDate'
                :tooltipMessage='tooltipMessage'
                :dayNumber='getDay(day.date)'
                :belongsToThisMonth='day.belongsToThisMonth'
                :checkIn='checkIn'
                :checkOut='checkOut'
              )
        div(v-if='screenSize !== "desktop" && isOpen')
          .datepicker__week-row
            .datepicker__week-name(v-for='dayName in this.i18n["day-names"]' v-text='dayName')
          .datepicker__months#swiperWrapper
            div.datepicker__month(v-for='(a, n) in months' v-bind:key='n')
              h1.datepicker__month-name(v-text='getMonth(months[n].days[15].date)')
              .datepicker__week-row.-hide-up-to-tablet
                .datepicker__week-name(v-for='dayName in i18n["day-names"]' v-text='dayName')
              .square(v-for='(day, index) in months[n].days'
                @mouseover='hoveringDate = day.date'
                v-bind:key='index'
                )
                Day(
                  :options="$props"
                  @dayClicked='handleDayClick($event)'
                  :date='day.date'
                  :sortedDisabledDates='sortedDisabledDates'
                  :nextDisabledDate='nextDisabledDate'
                  :activeMonthIndex='activeMonthIndex'
                  :hoveringDate='hoveringDate'
                  :tooltipMessage='tooltipMessage'
                  :dayNumber='getDay(day.date)'
                  :belongsToThisMonth='day.belongsToThisMonth'
                  :checkIn='checkIn'
                  :checkOut='checkOut'
                )


</template>

<script>
import { directive as onClickOutside } from 'vue-on-click-outside';

import fecha from 'fecha';
import _ from 'lodash';

import Day from './Day.vue';
import Helpers from './helpers.js';

const defaulti18n = {
  night: 'Night',
  nights: 'Nights',
  'day-names': ['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat'],
  'check-in': 'Check-in',
  'check-out': 'Check-out',
  'month-names': ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
};

export default {
  name: 'HotelDatePicker',

  directives: {
    'on-click-outside': onClickOutside
  },

  components: { Day, },

  props: {
    value: {
      type: String
    },
    startingDateValue: {
      default: function(){ 
      if (typeof req.checkin === 'undefined' || req.checkin === null) {
          return new Date();
      }else{
          return new Date(req.checkin);
      } 
      },
      type: Date
    },
    endingDateValue: {
      default: function(){
      if (typeof req.checkout === 'undefined' || req.checkout === null) {
        let today = new Date();
        return new Date(today.getTime() + (24 * 60 * 60 * 1000)); 
      }else{
          return new Date(req.checkout);
      } 
        /*
        var today = new Date();
        return new Date(today.getTime() + (24 * 60 * 60 * 1000));*/
      },
      type: Date 
    },
    format: {
      default: 'DD-MMM-YYYY',
      type: String
    }, 
    startDate: {
      default: function() {
        return new Date()
      },
      type: [ Date, String ]
    },
    endDate: {
      default: Infinity,
      type: [ Date, String, Number ]
    },
    minNights: {
      default: 1,
      type: Number
    },
    maxNights: {
      default: null,
      type: Number
    },
    disabledDates: {
      default: function(){ return [] },
      type: Array
    },
    disabledDaysOfWeek: {
      default: function(){ return [] },
      type: Array
    },
    allowedRanges: {
      default: function(){ return [] },
      type: Array
    },
    hoveringTooltip: {
      default: true,
      type: [Boolean, Function]
    },
    tooltipMessage: {
      default: null,
      type: String
    },
    i18n: {
      default: () => defaulti18n,
      type: Object
    },
    enableCheckout: {
      default: false,
      type: Boolean
    },
    singleDaySelection: {
      default: false,
      type: Boolean
    }
  },

  data() {
    return {
      hoveringDate: null,
      checkIn: this.startingDateValue,
      checkOut: this.endingDateValue,
      currentDate: new Date(),
      months: [],
      activeMonthIndex: 0,
      nextDisabledDate: null,
      show: true,
      isOpen: false,
      xDown: null,
      yDown: null,
      xUp: null,
      yUp: null,
      sortedDisabledDates: null,
      screenSize: this.handleWindowResize(),
      sepDates:{},
    };
  },

  watch: {
    isOpen (value) {
      if (this.screenSize !== 'desktop') {
        const bodyClassList = document.querySelector('body').classList;

        if (value) {
          bodyClassList.add('-overflow-hidden');
        }
        else {
          bodyClassList.remove('-overflow-hidden');
        }
      }
    },
    checkIn(newDate) {
      this.$emit("checkInChanged", newDate )
    },
    checkOut(newDate) {

      if ( this.checkOut !== null && this.checkOut !== null ) {
        this.hoveringDate = null;
        this.nextDisabledDate = null;
        this.show = true;
        this.parseDisabledDates();
        this.reRender()
        this.isOpen = false;
      }

      this.$emit("checkOutChanged", newDate )
    },

  },

  methods: {
    ...Helpers,

    handleWindowResize() {
      let screenSizeInEm = window.innerWidth / parseFloat(getComputedStyle(document.querySelector('body'))['font-size']);

      if (screenSizeInEm < 31) {
        this.screenSize = 'smartphone';
      }
      else if (screenSizeInEm > 30 && screenSizeInEm < 49) {
        this.screenSize = 'tablet';
      }
      else if (screenSizeInEm > 48) {
        this.screenSize = 'desktop';
      }

      return this.screenSize;
    },

    onElementHeightChange(el, callback){
      let lastHeight = el.clientHeight;
      let newHeight = lastHeight;

      (function run(){
        newHeight = el.clientHeight;

        if( lastHeight !== newHeight ){
          callback();
        }

        lastHeight = newHeight;

        if( el.onElementHeightChangeTimer ) {
          clearTimeout(el.onElementHeightChangeTimer);
        }

        el.onElementHeightChangeTimer = setTimeout(run, 1000);
      })();
    },

    emitHeighChangeEvent() {
      this.$emit('heightChanged');
    },

    reRender() {
      this.show = false
      this.$nextTick(() => {
        this.show = true;
      })
    },

/*    clearSelection(){
      this.hoveringDate = null,
      this.checkIn = null;
      this.checkOut = null;
      this.nextDisabledDate = null;
      this.show = true;
      this.parseDisabledDates();
      this.reRender()
    },*/

    hideDatepicker() { this.isOpen = false; },

    showDatepicker() { this.isOpen = true; },

    toggleDatepicker() { this.isOpen = !this.isOpen; },

    handleDayClick(event) {

      if (this.checkIn == null && this.singleDaySelection == false) {
        this.checkIn = event.date;
      } else if (this.singleDaySelection == true){
        this.checkIn = event.date
        this.checkOut = event.date
      }
      else if ( this.checkIn !== null && this.checkOut == null ) {
        this.checkOut = event.date;
      }
      else {
        this.checkOut = null;
        this.checkIn = event.date;
      }

      this.nextDisabledDate = event.nextDisabledDate
    },

    renderPreviousMonth() {
      if (this.activeMonthIndex >= 1) {
        this.activeMonthIndex--
      }
      else return
    },

    renderNextMonth() {
      let firstDayOfLastMonth;

      if (this.screenSize !== 'desktop') {
        firstDayOfLastMonth = _.filter(this.months[this.months.length-1].days, {
          'belongsToThisMonth': true
        });
      } else {
        firstDayOfLastMonth = _.filter(this.months[this.activeMonthIndex+1].days, {
          'belongsToThisMonth': true
        });
      }

      if (this.endDate !== Infinity){
        if (fecha.format(firstDayOfLastMonth[0].date, 'YYYYMM') ==
            fecha.format(new Date(this.endDate), 'YYYYMM')) {
          return
        }
      }

      this.createMonth(
        this.getNextMonth(
          firstDayOfLastMonth[0].date
        )
      );

      this.activeMonthIndex++;
    },

    setCheckIn(date) { this.checkIn = date; },

    setCheckOut(date) { this.checkOut = date; },

    getDay(date) { return fecha.format(date, 'D') },

    getMonth(date) { return this.i18n["month-names"][fecha.format(date, 'M') - 1] },

    formatDate(date) { return fecha.format(date, this.format) },

    dateDispaly(date) { 
      return '<span class="day">'+fecha.format(date, 'DD')+'</span>'
                +'<span class="month">'+fecha.format(date, 'MMMM')+'</span>'
                +'<span class="year">'+fecha.format(date, 'YYYY')+'</span>';  },

    formatDateForm(date) { return fecha.format(date, 'YYYY-MM-DD') },

    createMonth(date){
      const firstSunday = this.getFirstSunday(date);

      let month = {
        days: []
      };

      for (let i = 0; i < 42; i++) {
        month.days.push({
          date: this.addDays(firstSunday, i),
          belongsToThisMonth: this.addDays(firstSunday, i).getMonth() === date.getMonth(),
          isInRange: false,
        });
      }

      this.months.push(month);
    },

    parseDisabledDates() {
      const sortedDates = [];

      for (let i = 0; i < this.disabledDates.length; i++) {
        sortedDates[i] = new Date(this.disabledDates[i]);
      }

      sortedDates.sort((a, b) =>  a - b );

      this.sortedDisabledDates = sortedDates;
    }
  },

  beforeMount() {
    this.createMonth(new Date(this.startDate));
    this.createMonth(this.getNextMonth(new Date(this.startDate)));
    this.parseDisabledDates();
  },

  mounted() {
    document.addEventListener('touchstart', this.handleTouchStart, false);
    document.addEventListener('touchmove', this.handleTouchMove, false);
    window.addEventListener('resize', this.handleWindowResize);

    this.onElementHeightChange(document.body, () => {
      this.emitHeighChangeEvent();
    });
  },

  destroyed() {
    window.removeEventListener('touchstart', this.handleTouchStart);
    window.removeEventListener('touchmove', this.handleTouchMove);
    window.removeEventListener('resize', this. handleWindowResize);
  }

};
</script>

 