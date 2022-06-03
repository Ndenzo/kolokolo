(function($) {
     'use strict';

     if ($(".selectpicker").length) {
          $('.selectpicker').selectpicker('refresh');
     }
     if ($(".js-example-basic-multiple").length) {
          $(".js-example-basic-multiple").select2();
     }
})(jQuery);
