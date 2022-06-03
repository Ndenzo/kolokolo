$(document).ready(function() {
     if ($("#map").length) {

          var map = L.map('map').setView([$("#project_lat").val(), $("#project_lon").val()], 13);
          L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibmRlbnpvIiwiYSI6ImNrd296eDJ3ZTA0bHgybnJ0NTZiemk2d3cifQ.SK-sztYzW4mULi-rs6Yz_g', {
               attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
               maxZoom: 18,
               id: 'mapbox/streets-v11',
               tileSize: 512,
               zoomOffset: -1,
               accessToken: 'pk.eyJ1IjoibmRlbnpvIiwiYSI6ImNrd296eDJ3ZTA0bHgybnJ0NTZiemk2d3cifQ.SK-sztYzW4mULi-rs6Yz_g'
          }).addTo(map);

          var marker = new L.marker([$("#project_lat").val(), $("#project_lon").val()],{
               draggable: true
          }).addTo(map);

          marker.on("drag", function(e) {
               var marker = e.target;
               var position = marker.getLatLng();
               map.panTo(new L.LatLng(position.lat, position.lng));
               $("#project_lat").val(position.lat);
               $("#project_lon").val(position.lng);
          });

     }

     if ($("#map2").length) {

          var map = L.map('map2').setView([$("#project_lat").val(), $("#project_lon").val()], 15);
          L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibmRlbnpvIiwiYSI6ImNrd296eDJ3ZTA0bHgybnJ0NTZiemk2d3cifQ.SK-sztYzW4mULi-rs6Yz_g', {
               attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
               maxZoom: 18,
               id: 'mapbox/streets-v11',
               tileSize: 512,
               zoomOffset: -1,
               accessToken: 'pk.eyJ1IjoibmRlbnpvIiwiYSI6ImNrd296eDJ3ZTA0bHgybnJ0NTZiemk2d3cifQ.SK-sztYzW4mULi-rs6Yz_g'
          }).addTo(map);

          var marker = new L.marker([$("#project_lat").val(), $("#project_lon").val()],{
               draggable: false
          }).addTo(map);

     }


});
