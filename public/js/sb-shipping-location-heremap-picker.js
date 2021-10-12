(function () {
  var apiKey = "nxIhUhDspHwumgEKNUqZMybLKBFLlcRKUKsBbZjKm2M";
  var map;
  var platform;
  var address = {};

  jQuery(document).ready(() => {

    /* 
    ** open select map picker and Initialize map_init
    */
    jQuery(document).on("click", "#sbsl-show-map-picker-button", (evt) => {
      jQuery('#map-picker-container').show();
      evt.target.style.display = 'none'
      let mapCanvas = document.querySelector('#sbsl_location_picker_map canvas');
      if(!mapCanvas){
        sbsl_map_init()
      }
    });

    /*
    ** update adress fields on checkout form
    */
    jQuery(document).on("click", "#sbsl-select-location-button", (e) => {    
      resetErrMsg();  
      let fieldAddress = jQuery('#sbsl_location_new_address');

      if(!fieldAddress.val()){
        showErrMsg('!Por favor seleccione una dirección del mapa¡');
        fieldAddress.css('border', '1px solid crimson');
        fieldAddress.click(()=>{
          fieldAddress.css('border', '1px solid black');
        })
        return;
      }

      if (address.country.short_name != "CRI") {
        showErrMsg('La ubicación seleccionada se sale del área de cobertura, por favor intenta con otra ubicación');
        return;
      }

      sbsl_update_address_fields(address);
    });

    /*
    ** close select map picker
    */
    jQuery(document).on("click", "#sbsl-close-select-location-button", () => {
      closeMapPicker();
    })

  });  

  function sbsl_update_address_fields(add) {
    let inputs = document.querySelectorAll(".woocommerce-billing-fields input");
    let inputsChaged = [];

    const fields = [
      "address_1",
      "address_2",
      "state",
      "city",      
      "district",
      "postcode",
    ];

    inputs.forEach( (input, index) => {
      if (input.id.includes("billing")) {
        for (const field of fields) {
          if (input.id.includes(field) && add[field]) {
            input.value = '';
            input.value = add[field].short_name;
            inputsChaged.push(input);
          }
        }
      }
    });

    scrollTopInputChanged(inputsChaged);

  }

  //scroll to inputs changed and draw background input
  function scrollTopInputChanged(inputs){

    inputs.forEach((input)=>{
      input.style.backgroundColor = '#f0fff0';
      input.addEventListener('click', ()=>{
        input.style.backgroundColor = 'white'
      });
    })

    closeMapPicker();

    jQuery('html, body').animate({
      scrollTop: jQuery('#'+inputs[0].id).offset().top - 100
    }, 500);
  }

  function closeMapPicker(){
    jQuery('#map-picker-container').hide();
    jQuery('#sbsl-show-map-picker-button').show();
  }

  function showErrMsg(msg){
    let alert = jQuery(".sb-notify.out-of-cover");
    alert.html(`${msg}`); 
    alert.show();
  }
  function resetErrMsg(){
    let alert = jQuery(".sb-notify.out-of-cover");
    alert.html(''); 
    alert.hide();
  }
  

  function sbsl_map_init(params) {
    let mapId = document.getElementById("sbsl_location_picker_map");

    let position = {
      lat: parseFloat(
        document.getElementById("sbsl_location_map_default_lat").value
      ),
      lng: parseFloat(
        document.getElementById("sbsl_location_map_default_lng").value
      ),
    };

    platform = new H.service.Platform({
      apikey: apiKey,
    });

    // Obtain the default map types from the platform object:
    let defaultLayers = platform.createDefaultLayers();

    // Instantiate (and display) a map object:
    map = new H.Map(mapId, defaultLayers.vector.normal.map, {
      zoom: 15,
      center: position,
      pixelRatio: window.devicePixelRatio || 1,
    });

    behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

    addDraggableMarker(map, position.lat, position.lng, behavior);

    if (
      document.getElementById("sbsl_auto_detect_user_location").value === "yes"
    ) {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((event) => {
          reverseGeocode(
            event.coords.latitude,
            event.coords.longitude,
            platform
          );
        }),
          (err) => {
            console.log(err.message);
          };
      }
    }else{
      reverseGeocode(
        position.latitude,
        position.longitude,
        platform
      );
    }
  }

  function reverseGeocode(lat, lng, platform) {
    let geocoder = platform.getSearchService();
    let reverseGeocodingParameters = {
      at: lat + "," + lng,
      limit: "1",
    };
    geocoder.reverseGeocode(reverseGeocodingParameters, onSuccess, onError);
  }

  function onSuccess(result) {
    var locations = result.items;
    sbsl_get_address(locations);
  }

  function sbsl_get_address(locations) {
    if (locations.length == 0) {
      return;
    }

    let location = locations[0];
    let position = location.position;

    let address_items = {};

    address_items.formatted_address = location.address.label;

    address_items.address_1 = {
      short_name: location.address.label,
      long_name: location.address.label,
    };
    address_items.address_2 = {
      short_name: getAddress2(),
      long_name: getAddress2(),
    };
    address_items.country = {
      short_name: location.address.countryCode,
      long_name: location.address.countryName,
    };
    address_items.postcode = {
      short_name: location.address.postalCode,
      long_name: location.address.district,
    };
    address_items.state = { //provincia
      short_name: location.address.state,
      long_name: location.address.state,
    };
    address_items.city = { //cantón
      short_name: location.address.county,
      long_name: location.address.county,
    };    
    address_items.district = { //distrito
      short_name: location.address.district ? location.address.district : location.address.city,
      long_name: location.address.district ? location.address.district : location.address.city,
    };

    address_items.position = {
      lat: location.position.lat,
      lng: location.position.lng,
    };

    address = address_items;

    document.getElementById("sbsl_location_new_address").value = location.title;
    document.getElementById("sbsl_location_address_new_lat").value =
      location.position.lat;
    document.getElementById("sbsl_location_address_new_lng").value =
      location.position.lng;

    addDraggableMarker(
      map,
      document.getElementById("sbsl_location_address_new_lat").value,
      document.getElementById("sbsl_location_address_new_lng").value,
      behavior
    );
  }

  function onError(error) {
    alert("Can't reach the remote server");
    console.log(error.message);
  }

  function addDraggableMarker(map, lat, lng, behavior) {
    map.removeObjects(map.getObjects());

    var marker = new H.map.Marker({ lat: lat, lng: lng }, { volatility: true });
    // Ensure that the marker can receive drag events
    marker.draggable = true;
    map.addObject(marker);
    map.setCenter({ lat: lat, lng: lng });

    // disable the default draggability of the underlying map
    // and calculate the offset between mouse and target's position
    // when starting to drag a marker object:
    map.addEventListener(
      "dragstart",
      function (ev) {
        var target = ev.target,
          pointer = ev.currentPointer;
        if (target instanceof H.map.Marker) {
          var targetPosition = map.geoToScreen(target.getGeometry());
          target["offset"] = new H.math.Point(
            pointer.viewportX - targetPosition.x,
            pointer.viewportY - targetPosition.y
          );

          //Request location via lat or lng
          //console.log(target);
          behavior.disable();
        }
      },
      false
    );

    // re-enable the default draggability of the underlying map
    // when dragging has completed
    map.addEventListener(
      "dragend",
      function (ev) {
        var target = ev.target;
        if (target instanceof H.map.Marker) {
          behavior.enable();
          console.log(target);
          reverseGeocode(target.b.lat, target.b.lng, platform);
        }
      },
      false
    );

    // Listen to the drag event and move the position of the marker
    // as necessary
    map.addEventListener(
      "drag",
      function (ev) {
        var target = ev.target,
          pointer = ev.currentPointer;
        if (target instanceof H.map.Marker) {
          target.setGeometry(
            map.screenToGeo(
              pointer.viewportX - target["offset"].x,
              pointer.viewportY - target["offset"].y
            )
          );
        }
      },
      false
    );
  }

  function getAddress2() {
    let newFlatNo = document.getElementById('sbsl_location_new_flat_no');
    return newFlatNo.value;    
  }
})(jQuery);
