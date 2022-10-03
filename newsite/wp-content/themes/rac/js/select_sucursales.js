var mapMarkers = [], markers = [], estado = '', ciudad = '', tienda = '';

document.addEventListener('DOMContentLoaded', function(){
    Object.entries(sucursales).forEach(([key, estado]) => {
        $('#tienda_estado').append(new Option(key, key));
        clearMarkers();
    });

    $('#tienda_estado').change(function(){
        estado = $(this).val();
        $('#tienda_ciudad').empty().append('<option value="" disabled="" selected>Selecciona tu ciudad</option>');
        Object.entries(sucursales[estado]).forEach(([key, ciudad]) => {
            $('#tienda_ciudad').append(new Option(key, key));
        });
        clearMarkers();
    })

    $('#tienda_ciudad').change(function(){
        ciudad = $(this).val();
        $('#tienda_tienda').empty().append('<option value="" disabled="" selected>Selecciona una tienda</option>');
        Object.entries(sucursales[estado][ciudad]).forEach(([key, tienda]) => { 
            $('#tienda_tienda').append(new Option(tienda['titulo'], key));
        });
        clearMarkers();
    })

    $('#tienda_tienda').change(function(){
        tienda = $(this).val();
        clearMarkers(); setLocation(sucursales[estado][ciudad][tienda]); $('#map').show();
    })
});

function setLocation(tienda){
    var map = new google.maps.Map(document.getElementById('map'), { center: new google.maps.LatLng(tienda.lat, tienda.lng), mapTypeId: google.maps.MapTypeId.ROADMAP });
    var infoWindow = new google.maps.InfoWindow();
    var latlngbounds = new google.maps.LatLngBounds();
    var iconMarker = THEME_URL + '/images/brand/marker.png';
    
    var mrkr = new google.maps.Marker({
        map: map, icon: iconMarker, 
        position: new google.maps.LatLng(tienda.lat, tienda.lng),
    });
    
    (function (mrkr, data){ 
        google.maps.event.addListener(mrkr, 'click', function(e){ infoWindow.setContent(data); infoWindow.open(map, marker); }); 
    })(mrkr);

    mapMarkers.push(mrkr);
    latlngbounds.extend(mrkr.position);

    var bounds = new google.maps.LatLngBounds();
    map.setCenter(latlngbounds.getCenter());
    map.setZoom(15);
}

function clearMarkers(){
    $('#map').hide();
    for(var i = 0; i < mapMarkers.length; i++){ mapMarkers[i].setMap(null); }
    mapMarkers = [];
};