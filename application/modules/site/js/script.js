function change_id(current, name){
     $("#"+current).attr("class", "name");
     document.getElementById(current).className = "modal fade "+name;
     // alert("#"+current.attr());
     // $("#"+current).prop("class", "modal fade "+name);
     // alert(element.attr());
}
