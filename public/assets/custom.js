$(document).ready(function() {
$("#loginform").hide();
  $("#accountadminvendorloginform").click(function() {
   if($(this).is(":checked")) {
       $("#loginform").show();
   } else {
       $("#loginform").hide();
   }
 });

  if($("#accountadminvendorloginform").is(":checked")) {
      $("#loginform").show();
  } else {
      $("#loginform").hide();
  }

  $("#accountadmincustomerloginform").click(function() {
   if($(this).is(":checked")) {
       $("#loginform").show();
   } else {
       $("#loginform").hide();
   }
 });

  if($("#accountadmincustomerloginform").is(":checked")) {
      $("#loginform").show();
  } else {
      $("#loginform").hide();
  }

  $("#zip").keyup(function(){
    var address= $("#address").val();
    var address_1 = $("#address_1").val();
    var city = $("#city").val();
    var states = $('#states').find(":selected").text();
    var zip = $(this).val();
    if(zip !== '') {
      $.ajax({
          type:"GET",
          url: '/accountadmin/customers/long',
          data: {address:address ,address_1:address_1,city:city,states:states,zip:zip},
          success:function(response) {
            $('#customerlabelLat').replaceWith("Lat :"+" "+response.data.lat);
            $('#customerlabelLng').replaceWith("Lng :" +" "+ response.data.long);
            var html = `<input type ="hidden" name="lat" value="${response.data.lat}">
            <input type ="hidden" name="lng" value="${response.data.long}">`;
            $('#vendor-customer-form').append(html);
          },
          error:function(xhr) {
            console.log(xhr.responseText);
          }
      });
    }
  });


  $(document).on("click", "#vendor-edit-comment", function(e) {
    var id = $(this).attr("data");
      e.preventDefault(); // Prevent Default form Submission
      $.ajax({
          type:"GET",
          url: '/accountadmin/vendors/comments/edit/'+id,
          success:function(response) {
              console.log(response);
          },
          error:function() {
          }
      });

  });
});
