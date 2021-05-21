$( document ).ready(function() {
     $(document).scroll(function(){
          var el = $('#navigation');
          var top = $(el).offset().top - $(document).scrollTop();
          if (top < 50 && !el.hasClass('navbar-slided')){
               $(el).addClass('navbar-slided');
               $("#header_logo").removeClass('header_logo');
               $("#header_logo").addClass('header_logo_small');
          }if ($(el).offset().top < 50){
               $(el).removeClass('navbar-slided');
               $("#header_logo").removeClass('header_logo_small');
               $("#header_logo").addClass('header_logo');
          }
     });
});
