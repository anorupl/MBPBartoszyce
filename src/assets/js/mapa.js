var planes = [];

for (var i = 1; i < 5; i++) {
	var item = document.getElementById('label_id_contact_tab_' + i);
	var item_position = item.getAttribute('data-pt_position').split(",");


var tabarray = [item.id,item.getAttribute('data-pt_name'),item_position[0],item_position[1]]
		planes.push(tabarray);
}

//////////////////

var planes2 = [
		["label_id_contact_tab_1","Główna",54.248997, 20.804780],
		["label_id_contact_tab_2","Filia 1",54.308997, 20.804780],
		["label_id_contact_tab_3","Filia 2",54.358997, 20.804780],
		["label_id_contact_tab_4","Filia 3",54.408997, 20.804780]
		];
//console.log(planes);

// initialize the map on the "map" div with a given center and zoom
var map = L.map('map-canvas', {
    center: [54.248997, 20.804780],
		zoomControl: false,

		keyboard: true,
    dragging: false,
    boxZoom: false,
    doubleClickZoom: true,
    scrollWheelZoom: true,
    tap: false,
    touchZoom: true,

    zoom: 13,
		layers: new L.TileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1Ijoia2FtaWx6ODciLCJhIjoiY2psOGZvNnN2MWQ5cTNrcWtiaTl2czJ3NCJ9.JPFsPnvYmq-fXFx5i5qmxw', {
			maxZoom: 18,
			attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
				'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
				'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
			id: 'mapbox.streets'
		})
});

//add zoom
var zoom = L.control.zoom({ position: 'topright' });   // Creating zoom control
zoom.addTo(map);   // Adding zoom control to the map


// Add a place to save markers
var markers_places = {};

// Loop through the data
for (var i = 0; i < planes.length; i++) {



markers_places[planes[i][0]] = L.marker({lat: planes[i][2], lng: planes[i][3]}, {
	title: planes[i][1],
	riseOnHover: true
}).bindPopup(planes[i][1]).addTo(map);
}

for (var i = 1; i < 5; i++) {
	var item = document.getElementById('label_id_contact_tab_' + i);



	document.getElementById('label_id_contact_tab_' + i).addEventListener('click', function() {
		var id = this.id,
	      marker = markers_places[id],
	      latLng = marker.getLatLng();

				console.log(this.id);
	  // Do something cool with that marker or it's coordinates
	  map.panTo(latLng);
		marker.openPopup(latLng);
	});
}
