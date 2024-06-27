// npm package: flatpickr
// github link: https://github.com/flatpickr/flatpickr

$(function() {
  'use strict';

  // date picker
  if($('#flatpickr-date').length) {
    flatpickr("#flatpickr-date", {
      wrap: true,
      enableTime: true,
      dateFormat: "Y-m-d H:i",
    });
  }




});
