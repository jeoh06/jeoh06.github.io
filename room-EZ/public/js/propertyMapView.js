function detailedKakaoMap(latitude,longitude) {
    var mapContainer = document.getElementById('map'),
        mapOption = { 
        center: new kakao.maps.LatLng(latitude, longitude), // center point of map
        level: 5 // map zoom level
    };

    var map = new kakao.maps.Map(mapContainer, mapOption); // create map

    var centerPosition  = new kakao.maps.LatLng(latitude, longitude); 
 

    var circle = new kakao.maps.Circle({ 
        center : centerPosition,
        radius: 300,
        strokeColor: '#29A376',
        strokeOpacity: 1,
        strokeStyle: 'solid',
        fillColor: '#29A376',
        fillOpacity: 0.5
    });

    circle.setMap(map);
}

/////grab value from hidden input in detailedPropertyview.php///////
detailedKakaoMap(document.querySelector("input.latitude").value,document.querySelector("input.longitude").value)

