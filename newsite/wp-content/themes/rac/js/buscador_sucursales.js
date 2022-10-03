var mapMarkers = [], markers = [], estado = '', ciudad = '';

document.addEventListener('DOMContentLoaded', function(){
    Object.entries(sucursales).forEach(([key, estado]) => {
        $('#tienda_estado').append(new Option(key, key));
        Object.entries(sucursales[key]).forEach(([key, ciudad]) => { ciudad.forEach(tienda => markers.push(tienda)); });
        setLocations(markers, false);
    });

    $('#tienda_estado').change(function(){
        markers = []; estado = $(this).val();
        $('#tienda_ciudad').empty().append('<option value="" disabled="" selected></option>');
        Object.entries(sucursales[estado]).forEach(([key, ciudad]) => {
            $('#tienda_ciudad').append(new Option(key, key));
            ciudad.forEach(tienda => markers.push(tienda));
        });
        clearMarkers(); setLocations(markers, true);
    })

    $('#tienda_ciudad').change(function(){
        markers = []; ciudad = $(this).val();
        Object.entries(sucursales[estado][ciudad]).forEach(([key, tienda]) => { markers.push(tienda); });
        clearMarkers(); setLocations(markers, true);
    })
});

function setLocations(markers, showList){
    var map = new google.maps.Map(document.getElementById('map'), { center: new google.maps.LatLng(markers[0].lat, markers[0].lng), mapTypeId: google.maps.MapTypeId.ROADMAP });
    var infoWindow = new google.maps.InfoWindow();
    var latlngbounds = new google.maps.LatLngBounds();
    var iconMarker = THEME_URL + '/images/brand/marker.png';

    $('#tienda_listado').html('');
    for(var i = 0; i < markers.length; i++){
        var data = markers[i];
        var tiendaInfo = "<div class='card m-4 shadow p-4'><p class='title'>"+data.titulo+"</p> <p class='direccion'>Dirección: "+data.direccion+"</p><p class='horario'>"+data.horario+"<br>"+data.horario2+"</p><p class='telefono'>Teléfono: "+data.telefono+"</p></div>";

        var marker = new google.maps.Marker({
            map: map, icon: iconMarker, 
            position: new google.maps.LatLng(data.lat, data.lng),
        });
        (function (marker, data){ 
            google.maps.event.addListener(marker, 'click', function(e){ infoWindow.setContent(data); infoWindow.open(map, marker); }); 
        })(marker, tiendaInfo);

        mapMarkers.push(marker);
        if(showList) $('#tienda_listado').append(tiendaInfo);
        latlngbounds.extend(marker.position);
    }

    var bounds = new google.maps.LatLngBounds();
    map.setCenter(latlngbounds.getCenter());
    map.fitBounds(latlngbounds);
    map.setZoom(15);
}

function clearMarkers(){
    for(var i = 0; i < mapMarkers.length; i++){ mapMarkers[i].setMap(null); }
    mapMarkers = [];
};