function initMap() {
  let mapId = document.getElementById("map");

  let position = {
    lat: parseFloat(document.getElementById("sbsl_map_default_lat").value),
    lng: parseFloat(document.getElementById("sbsl_map_default_lng").value),
  };

  map = new google.maps.Map(mapId, {
    center: position,
    streetViewControl: false,
    fullscreenControl: false,
    mapTypeControl: false,
    // mapTypeId: 'hybrid',
    zoom: 40,
    // styles: map_style
  });

  marker = new google.maps.Marker({
    position: position,
    map: map,
    draggable: true,
  });

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      (event) => {
        position = {};
        position = {
          lat: event.coords.latitude,
          lng: event.coords.longitude,
        };
        map.setCenter(position);
        marker.setPosition(position);
        //sgitsdlmp_get_address(position, section);
      },
      (error) => {
        console.log(error.message);
      }
    );
  }

  sbsl_get_adress(position);
}

function sbsl_get_adress(pos) {
  let geocoder = new google.maps.Geocoder();

  console.log(pos);

  geocoder.geocode({
    latLng: pos
  },
  (responses)=>{
      console.log(responses)
  }),
  (error)=>{
      console.log(error)
  };
}
