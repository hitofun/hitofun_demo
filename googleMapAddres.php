<!DOCTYPE html>
<html>
<head>
<title>Geocoding service</title>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">
<style>
html, body {
height: 100%;
margin: 0;
padding: 0;
}
#map {
height: 80%;
width: 50%   ;
}
#floating-panel {
position: absolute;
top: 10px;
left: 25%;
z-index: 5;
background-color: #fff;
padding: 5px;
border: 1px solid #999;
text-align: center;
font-family: 'Roboto','sans-serif';
line-height: 30px;
padding-left: 10px;
}

</style>
</head>
<body>
<div id="floating-panel">
<input id="add" type="button" value="add">

</div>
<div id="testadd">

</div>
<div id="map"></div>

</body>
  <script src="../../js/jquery.js"></script>
  <script>

    function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15
      });
      var geocoder = new google.maps.Geocoder();
      //一開始畫面的地址
      geocodeAddress(geocoder, map, "台北市松山區")
      
    }
    //增加boutton
    $( "#add" ).click(function() {
      $('#testadd').append('<input class="address2" type="button" value="基隆市七堵區"><input class="address2" type="button" value="基隆市松山區"><input class="address2" type="button" value="桃園縣蘆竹鄉">');
    });

    //搜尋button值中的位置
    $('body').on("click", '.address2', function () {

      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15
      });
      var geocoder = new google.maps.Geocoder();
      geocodeAddress(geocoder, map, $(this).val())
    });

    function geocodeAddress(geocoder, resultsMap, sendAddress) {
      var address = sendAddress;
      geocoder.geocode({'address': address}, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
          resultsMap.setCenter(results[0].geometry.location);
          var marker = new google.maps.Marker({
            map: resultsMap,
            position: results[0].geometry.location
          });
        } else {
          alert('Geocode was not successful for the following reason: ' + status);
        }
      });
    }

  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVLFm9y5kuq0Vi-fe-SwDvloh8cZiCOPE&signed_in=true&callback=initMap"
  async defer></script>
</html>