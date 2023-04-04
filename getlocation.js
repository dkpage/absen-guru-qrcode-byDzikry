$(document).ready(function () {
  getLocation();
});

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else {
    console.log("Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {
  var lat = position.coords.latitude;
  var lon = position.coords.longitude;
  //   lat = -5.7888;
  //   lon = 107.677;
  koordinat = lat + ", " + lon;
  var minLot = -6.7618;
  var maxLot = -6.76215;

  var minLon = 107.2189;
  var maxLon = 107.2194;

  if (lat <= minLot && lat >= maxLot && lon >= minLon && lon <= maxLon) {
    console.log("lokasinya di sekolah");
  } else {
    console.log("lokasinya diluar");
    $("#notlokasi").modal("show");
  }
  console.log(koordinat);
}

function showError(error) {
  switch (error.code) {
    case error.PERMISSION_DENIED:
      x.innerHTML = "User denied the request for Geolocation.";
      break;
    case error.POSITION_UNAVAILABLE:
      x.innerHTML = "Location information is unavailable.";
      break;
    case error.TIMEOUT:
      x.innerHTML = "The request to get user location timed out.";
      break;
    case error.UNKNOWN_ERROR:
      x.innerHTML = "An unknown error occurred.";
      break;
  }
}
