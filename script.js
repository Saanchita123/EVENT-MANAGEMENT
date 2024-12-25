function hello() {
    var logout = document.getElementById("menu");
    if (logout.style.display === "none") {
      logout.style.display = "grid";
      logout.style.visibility = "visible";

    } else {
      logout.style.display = "none";
      logout.style.visibility = "hidden";
    }
    console.log("hello");
  }
  // -------------------------
  
  // hamburger-----------------------
  document.getElementById('menu-toggle').addEventListener('click', function () {
    const navLinks = document.getElementById('nav-links');
    navLinks.classList.toggle('open');
    this.classList.toggle('open');
});

document.getElementById('close-menu').addEventListener('click', function () {
    const navLinks = document.getElementById('nav-links');
    navLinks.classList.remove('open');
});
// --------------------------------------------------

function findNearbyAuditoriums(lat, lng) {
  var map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: lat, lng: lng },
    zoom: 15,
  });

  var request = {
    location: { lat: lat, lng: lng },
    radius: '5000', // Search within 5 km radius
    type: ['movie_theater'], // This could include 'auditorium' or 'theater'
  };

  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, function (results, status) {
    if (status === google.maps.places.PlacesServiceStatus.OK) {
      for (var i = 0; i < results.length; i++) {
        createMarker(results[i]);
      }
    }
  });

  function createMarker(place) {
    var marker = new google.maps.Marker({
      map: map,
      position: place.geometry.location,
    });

    google.maps.event.addListener(marker, "click", function () {
      var infoWindow = new google.maps.InfoWindow({
        content: place.name,
      });
      infoWindow.open(map, marker);
    });
  }
}


