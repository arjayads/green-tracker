(function( $ ) {

    /* bootstrap-datepicker.js
    * A datepicker for Twitter Bootstrap */

    var bootstrapDatepicker = function(){
        $('.date, .input-group.date, .input-daterange').datepicker();
    }

    bootstrapDatepicker();

    /* bootstrap-datepicker.js
    * Select2 is a jQuery based replacement for select boxes. 
    * It supports searching, remote data sets, and infinite scrolling of results. */

    var boostrapSelect = function(){
        $('.select2').select2();
    }

    boostrapSelect();

})( jQuery );