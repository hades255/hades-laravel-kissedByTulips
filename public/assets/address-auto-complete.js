
var placeSearch, autocomplete;
  var componentForm = {
    street_number: 'short_name',
    //route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
  };

  function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
        {
          componentRestrictions: { country: ["us"] },
          fields: ["address_components", "geometry"],
          types: ['geocode']
          //types: ["address"],
        }
        );

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);
  }

  function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

    for (var component in componentForm) {
      document.getElementById(component).value = '';
      document.getElementById(component).disabled = false;
    }

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    var new_address = '';
    for (var i = 0; i < place.address_components.length; i++) {
      var addressType = place.address_components[i].types[0];

      //alert(addressType);

      if(addressType == 'street_number'){
        new_address += place.address_components[i]['short_name'];
        document.getElementById("autocomplete").value = new_address;
      }
      if(addressType == 'route'){
        if(new_address)
          new_address += " "+place.address_components[i]['long_name'];
        else
          new_address += place.address_components[i]['long_name'];

        document.getElementById("autocomplete").value = new_address;
      }else if(new_address == '' && addressType == 'locality'){
        new_address += place.address_components[i]['long_name'];
        document.getElementById("autocomplete").value = new_address;
      }

      if (componentForm[addressType]) {
        var val = place.address_components[i][componentForm[addressType]];
        document.getElementById(addressType).value = val;
      }

    }

    var a = document.getElementById("latLab");
    var b = document.getElementById("lngLab");

    if(a && b){
      document.getElementById("latLab").innerHTML = place.geometry.location.lat();
      document.getElementById("lat_value").value = place.geometry.location.lat();

      document.getElementById("lngLab").innerHTML = place.geometry.location.lng();
      document.getElementById("lng_value").value = place.geometry.location.lng();
    }

  }

  // Bias the autocomplete object to the user's geographical location,
  // as supplied by the browser's 'navigator.geolocation' object.
  /*geolocate();
  function geolocate() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        var circle = new google.maps.Circle({
          center: geolocation,
          radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
      });
    }
  }*/
