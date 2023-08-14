<html>
  <head>
    <title>Place Autocomplete Address Form</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:400,500"
      rel="stylesheet"
    />
    <style>
      #map {
        height: 100%;
      }
        html,
        body {
          height: 100%;
          margin: 0;
          padding: 0;
        }

        body {
          font-family: "Roboto", sans-serif;
          font-size: 18px;
          color: rgb(104, 104, 104);
        }

        form {
          display: flex;
          flex-wrap: wrap;
          align-items: center;
          max-width: 400px;
          padding: 20px;
        }

        input {
          width: 100%;
          height: 1.2rem;
          margin-top: 0;
          padding: 0.5em;
          border: 0;
          border-bottom: 2px solid gray;
          font-family: "Roboto", sans-serif;
          font-size: 18px;
        }

        input:focus {
          border-bottom: 4px solid black;
        }

        input[type=reset] {
          width: auto;
          height: auto;
          border-bottom: 0;
          background-color: transparent;
          color: rgb(104, 104, 104);
          font-size: 14px;
        }

        .title {
          width: 100%;
          margin-block-end: 0;
          font-weight: 500;
        }

        .note {
          width: 100%;
          margin-block-start: 0;
          font-size: 12px;
        }

        .form-label {
          width: 100%;
          padding: 0.5em;
        }

        .full-field {
          flex: 400px;
          margin: 15px 0;
        }

        .slim-field-left {
          flex: 1 150px;
          margin: 15px 15px 15px 0px;
        }

        .slim-field-right {
          flex: 1 150px;
          margin: 15px 0px 15px 15px;
        }

        .my-button {
          background-color: #000;
          border-radius: 6px;
          color: #fff;
          margin: 10px;
          padding: 6px 24px;
          text-decoration: none;
        }

        .my-button:hover {
          background-color: #666;
        }

        .my-button:active {
          position: relative;
          top: 1px;
        }

        img.powered-by-google {
          margin: 0.5em;
        }
    </style>
    <script>
      let autocomplete;
      let address1Field;
      let address2Field;
      let postalField;

      function initAutocomplete() {
        address1Field = document.querySelector("#ship-address");
        address2Field = document.querySelector("#address2");
        postalField = document.querySelector("#postcode");
        // Create the autocomplete object, restricting the search predictions to
        // addresses in the US and Canada.
        autocomplete = new google.maps.places.Autocomplete(address1Field, {
          componentRestrictions: { country: ["us"] },
          fields: ["address_components", "geometry"],
          types: ["address"],
        });
        address1Field.focus();
        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener("place_changed", fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        const place = autocomplete.getPlace();
        let address1 = "";
        let postcode = "";
        for (const component of place.address_components) {
          // @ts-ignore remove once typings fixed
          const componentType = component.types[0];
          switch (componentType) {
            case "street_number": {
              address1 = `${component.long_name} ${address1}`;
              break;
            }

            case "route": {
              address1 += component.short_name;
              break;
            }

            case "postal_code": {
              postcode = `${component.long_name}${postcode}`;
              break;
            }

            case "postal_code_suffix": {
              postcode = `${postcode}-${component.long_name}`;
              break;
            }
            case "locality":
              document.querySelector("#locality").value = component.long_name;
              break;
            case "administrative_area_level_1": {
              document.querySelector("#state").value = component.short_name;
              break;
            }
            case "country":
              document.querySelector("#country").value = component.long_name;
              break;
          }
        }

      address1Field.value = address1;
      postalField.value = postcode;
      address2Field.focus();
}

window.initAutocomplete = initAutocomplete;
    </script>
  </head>
  <body>
    <form id="address-form" action="" method="get" autocomplete="off">
      <p class="title">Sample address form for North America</p>
      <p class="note"><em>* = required field</em></p>
      <label class="full-field">
        <span class="form-label">Deliver to*</span>
        <input id="ship-address" name="ship-address" required autocomplete="off"/>
      </label>
      <label class="full-field">
        <span class="form-label">Apartment, unit, suite, or floor #</span>
        <input id="address2" name="address2" />
      </label>
      <label class="full-field">
        <span class="form-label">City*</span>
        <input id="locality" name="locality" required />
      </label>
      <label class="slim-field-left">
        <span class="form-label">State/Province*</span>
        <input id="state" name="state" required />
      </label>
      <label class="slim-field-right" for="postal_code">
        <span class="form-label">Postal code*</span>
        <input id="postcode" name="postcode" required />
      </label>
      <label class="full-field">
        <span class="form-label">Country/Region*</span>
        <input id="country" name="country" required />
      </label>
      <button type="button" class="my-button">Save address</button>
    </form>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAB80hPTftX9xYXqy6_NcooDtW53kiIH3A&callback=initAutocomplete&libraries=places&v=weekly" defer></script>
  </body>
</html>
