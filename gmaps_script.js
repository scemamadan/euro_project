// function initialize() {
//   var mapOptions = {
//     zoom: 4,
//     center: new google.maps.LatLng(48.76632797237075, 2.3291015625)
//   };

//     var map = new google.maps.Map(document.getElementById('map-canvas'),
//       mapOptions);

//   	var marker = new google.maps.Marker({
// 	    position: new google.maps.LatLng(49.416691414606525, 1.065673828125),
// 	    title:"Hello World!"
// 	  });
// 	// To add the marker to the map, call setMap();
// 	marker.setMap(map);

// }

function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
      'callback=initialize';
  document.body.appendChild(script);
}

window.onload = loadScript;