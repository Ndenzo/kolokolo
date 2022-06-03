$(document).ready(function() {
     $(".to_hide").hide();
     $(".to_hidde").hide();
});

function show_details(id){
     $('#details').append($(".to_change"));
     $('#detail_view').append($("#detail_"+id));
     $("#detail_"+id).removeClass('to_hidde').addClass('to_change');;
     $(".to_change").show();
}
