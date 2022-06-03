// Common settings
var platform = new H.service.Platform({
     app_id: 'devportal-demo-20180625',
     app_code: '9v2BkviRwi9Ot26kp2IysQ',
     useHTTPS: true
});
var pixelRatio = window.devicePixelRatio || 1;
var defaultLayers = platform.createDefaultLayers({
     tileSize: pixelRatio === 1 ? 256 : 512,
     ppi: pixelRatio === 1 ? undefined : 320
});

// map13
function addDraggableMarker(map, behavior){
     var marker = new H.map.Marker({lat:42.35805, lng:-71.0636});
     marker.draggable = true;
     map.addObject(marker);
     map.addEventListener('dragstart', function(ev) {
          var target = ev.target;
          if (target instanceof H.map.Marker) {
               behavior.disable();
          }
     }, false);
     map.addEventListener('dragend', function(ev) {
          var target = ev.target;
          if (target instanceof mapsjs.map.Marker) {
               behavior.enable();
          }
     }, false);
     map.addEventListener('drag', function(ev) {
          var target = ev.target,
          pointer = ev.currentPointer;
          if (target instanceof mapsjs.map.Marker) {
               target.setPosition(map.screenToGeo(pointer.viewportX, pointer.viewportY));
          }
     }, false);
}
var map = new H.Map(document.getElementById('map13'),
defaultLayers.normal.map,{
     center: {lat:42.35805, lng:-71.0636},
     zoom: 12,
     pixelRatio: pixelRatio
});
var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
var ui = H.ui.UI.createDefault(map, defaultLayers, 'en-US');
addDraggableMarker(map, behavior);
