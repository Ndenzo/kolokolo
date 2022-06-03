$(document).ready(function(){
     $("#search").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $(".element").filter(function() {
               $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
     });
});
