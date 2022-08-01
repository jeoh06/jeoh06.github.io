const searchMap = function (coords) {
// let coords = [
//     {
//         title: 'house 1',
//         latitude: 33.450701, 
//         longitude: 126.570667
//     },
//     {   
//         title: 'house 2',
//         latitude: 37.55807,
//         longitude: 126.84785
//     },
//     {
//         title: 'house 3',
//         latitude: 35.09951,
//         longitude: 129.01340
//     },
//     {
//         title: 'house 4',
//         latitude: 37.54001,
//         longitude: 127.21551
//     },
//     {
//         title: 'house 5',
//         latitude: 37.5364,
//         longitude: 126.896
//     },
//     {
//         title: 'house 6',
//         latitude: 37.540,
//         longitude: 127.2155
//     }
// ]

    const centerLoc = getLatLngCenter(coords);
    const zoom = getMapZoomLevel(coords);
    

    let mapContainer = document.getElementById('searchMap'),
    mapOption = { 
        center: new kakao.maps.LatLng(centerLoc[0], centerLoc[1]), // center point of map
        // map zoom level
        level: zoom 
    };
    let map = new kakao.maps.Map(mapContainer, mapOption); // create map

    // location of map markers
    let positions = [];
    for(i=0; i<coords.length; i++) {
        positions.push({title: coords[i].title, content: coords[i].content, link: coords[i].link, latlng: new kakao.maps.LatLng(coords[i].latitude, coords[i].longitude)});
    }
    
    // create map markers
    for (i=0; i<positions.length; i++) {
        let marker = new kakao.maps.Marker({
            map: map,
            position: positions[i].latlng,
            title: positions[i].title,
            clickable: true
        });

        // create infoWindow for each marker
        var infowindow = new kakao.maps.InfoWindow({
            content: positions[i].content // 인포윈도우에 표시할 내용
        });

        // marker.addListener('click', function() {
        //     window.location = positions[i].link;
        // })

        // if the closure is not made in the for loop, only the last marker will have the event
        kakao.maps.event.addListener(marker, 'click', makeOverListener(map, marker, infowindow));
        // kakao.maps.event.addListener(marker, 'click', function() {
        //     window.location = positions[i].link;
        // });
        kakao.maps.event.addListener(map, 'click', makeOutListener(infowindow));
    }

    // display map markers
    // marker.setMap(map);
}


// closure for displaying infoWindow
function makeOverListener(map, marker, infowindow) {
    return function() {
        infowindow.open(map, marker);
    };
}

// closure for closing infoWindow
function makeOutListener(infowindow) {
    return function() {
        infowindow.close();
    };
}


function getMinMaxCoords(coords) {
    let latitudes = [],
        longitudes = [];
    for(i=0; i<coords.length; i++) {
        latitudes.push(coords[i].latitude),
        longitudes.push(coords[i].longitude);
    }

    let minLat = Math.min(...latitudes),
        maxLat = Math.max(...latitudes),
        minLng = Math.min(...longitudes),
        maxLng = Math.max(...longitudes);
    
    return [[minLat, minLng], [maxLat, maxLng]]
}

// calculate distance between mix and max coordinates
function getMapZoomLevel(coords) {
    const minMaxCoords = getMinMaxCoords(coords);
    let maxLat = minMaxCoords[1][0],
        minLat = minMaxCoords[0][0],
        maxLng = minMaxCoords[1][1],
        minLng = minMaxCoords[0][1];

    let latDiff = maxLat - minLat,
        lngDiff = maxLng - minLng;

    let zoom;
    if(latDiff == 0 || lngDiff == 0) {
        zoom = 5;
    } else if(lngDiff < 0.2) {
        zoom = 9;
    } else if(lngDiff < 0.5) {
        zoom = 10;
    } else if(lngDiff < 1.5){
        zoom = 11;
    } else if(lngDiff < 2) {
        zoom = 12;
    } else {
        zoom = 13;
    }

    return zoom;
}


// calculate center point of the search result property coordinates
function rad2degr(rad) { return rad * 180 / Math.PI; }
function degr2rad(degr) { return degr * Math.PI / 180; }

/**
 * @param coords array of arrays with latitude and longtitude
 *   pairs in degrees. e.g. [[latitude1, longtitude1], [latitude2
 *   [longtitude2] ...]
 *
 * @return array with the center latitude longtitude pairs in 
 *   degrees.
 */
function getLatLngCenter(coords) {
    const minMaxCoords = getMinMaxCoords(coords);
    var latitude = 0;
    var longitude = 1;
    var sumX = 0;
    var sumY = 0;
    var sumZ = 0;

    for (var i=0; i<minMaxCoords.length; i++) {
        var lat = degr2rad(minMaxCoords[i][0]);
        var lng = degr2rad(minMaxCoords[i][1]);
        // sum of cartesian coordinates
        sumX += Math.cos(lat) * Math.cos(lng);
        sumY += Math.cos(lat) * Math.sin(lng);
        sumZ += Math.sin(lat);
    }

    var avgX = sumX / minMaxCoords.length;
    var avgY = sumY / minMaxCoords.length;
    var avgZ = sumZ / minMaxCoords.length;

    // convert average x, y, z coordinate to latitude and longtitude
    var lng = Math.atan2(avgY, avgX);
    var hyp = Math.sqrt(avgX * avgX + avgY * avgY);
    var lat = Math.atan2(avgZ, hyp);

    return ([rad2degr(lat), rad2degr(lng)]);
}