jQuery('.validatedForm').validate({
     rules : {
          password : {
               minlength : 8
          },
          password_confirm : {
               minlength : 8,
               equalTo : "#password"
          }
     }
});

$('#submit').click(function(){
     console.log($('.validatedForm').valid());
});
