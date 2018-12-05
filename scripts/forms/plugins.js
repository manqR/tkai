/**
 * Form plugins demo
 */
(function($) {
  'use strict';


  /******** Select 2 plugin ********/
	$('.select2').select2();
	
  /******** Maxlength plugin ********/
  $('#maxlength').maxlength({
    threshold: 10
  });
  $('#nis').maxlength({
    threshold: 8
  });
  $('#maxlengthConf').maxlength({
    alwaysShow: true,
    threshold: 50,
    warningClass: 'label label-info',
    limitReachedClass: 'label label-warning',
    placement: 'bottom',
    preText: 'used ',
    separator: ' of ',
    postText: ' chars.'
  });
	
	/******** Labelauty plugin ********/
  // $('.to-labelauty').labelauty({
  //   minimum_width: '155px',
  //   class: 'labelauty btn-block'
  // });
  // $('.to-labelauty-icon').labelauty({
  //   label: false
  // });


	

   /******** Dateranger picker ********/
   $('.drp').daterangepicker({
    timePicker: false,
    timePickerIncrement: 30,
    locale: {
      format: 'YYYY-MM-DD'
    }
  });


})(jQuery);
