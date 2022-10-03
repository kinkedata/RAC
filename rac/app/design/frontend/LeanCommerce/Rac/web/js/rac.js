require(['jquery'], function ($) {

    $(document).ready(function () {
        if (isNaN(window.sliderTime)){
            window.sliderTime = 5000;
        }

        /**
         * Sliders home
         */

        $('#slider-home .slider').lightSlider({
            auto: true,
            loop:true,
            pauseOnHover: true,
            item: 1,
            controls: false,
            pager: true,
            pause: window.sliderTime,
        });

        $('#slider-home-mobile .slider').lightSlider({
            auto:true,
            loop:true,
            item: 1,
            pauseOnHover: true,
            controls: false,
            pager: false,
        });

        $('.banner-anuncio .slider').lightSlider({
            item: 1,
            controls: true,
        });

        $('#marcas .slider').lightSlider({
            item: 5,
            controls: true,
            pager: false,
        });

        $('#marcas-mobile .slider').lightSlider({
            item: 1,
            controls: true,
            pager: false,
        });

        $('#categorias-mobile .slider').lightSlider({
            item: 1,
            controls: true,
            pager: false,
        });

        $('#beneficios-mobile .slider').lightSlider({
            item: 1,
            controls: true,
            pager: false,
        });

        $('#promociones .slider').lightSlider({
            item: 1,
        });

        /**
         * Pagina de marcas
         */

        /*         $('#grid-marcas-mobile .slider').lightSlider({
                    item: 1,
                    controls: true,
                    pager: false,
                }); */

        var slider = $('#grid-marcas-mobile .slider').lightSlider({
            item: 1,
            controls: false,
            pager: false,
        });
        $('#goToPrevSlide').on('click', function () {
            slider.goToPrevSlide();
        });
        $('#goToNextSlide').on('click', function () {
            slider.goToNextSlide();
        });

        $('#ver-mas-marcas').click(function(){
            $(this).toggle();
            $('.mas-marcas').slideToggle();
            $('#ver-menos-marcas').toggle();

            return false;
        });

        $('#ver-menos-marcas').click(function(){
            $(this).toggle();
            $('.mas-marcas').slideToggle();
            $('#ver-mas-marcas').toggle();

            return false;
        });

        $('#pagina-marcas').parent().parent().parent().parent().find('#marcas-mobile').remove();
        $('#pagina-marcas').parent().parent().parent().parent().find('#marcas').remove();

        /**
         * Oculta Footer
         */
        $('#esconder-footer').click(function (e) {

            $('#footer-colapse-container').slideToggle("slow", function(){
                if(!$('#footer-colapse-container').is(':visible')) {
                    $('#esconder-container').css('height', '50px');
                } else {
                    $('#esconder-container').css('height', 'inherit');
                }
            });

            var label = $('#esconder-footer').html();
            label = (label == '<i class="fa fa-angle-down"></i> Ocultar' ? '<i class="fa fa-angle-up"></i> Mostrar' : '<i class="fa fa-angle-down"></i> Ocultar');
            $('#esconder-footer').html(label);
            $('html, body').animate({scrollTop: $(document).height()}, 'slow');

            return false;

        });

        /**
         * Menu categorias izquierdo
         */
        $('#categories-menu ul li i').click(function () {
            var cssClass = $(this).attr('class');
            if (cssClass == 'fa fa-angle-down') {
                $(this).attr('class', 'fa fa-angle-up');
            } else {
                $(this).attr('class', 'fa fa-angle-down');
            }
            $(this).parent().find('ul').slideToggle('slow');
        });

        /**
         * Beneficios
         */
        $('#beneficios .beneficio-item').click(function () {
            $(this).find('.over-info').show('slow');
        });

        $('#beneficios-mobile .beneficio-item').click(function () {
            var beneficio = $(this).data('beneficio');
            $('#' + beneficio).show('slow');
        });

        $('.hide-over-info').click(function () {
            $(this).parent().hide('slow');
            return false;
        });

        /**
         * Pasos como funciona
         */
        /* $('.mapa-control').click(function(){
         
         $('.display-map').slideToggle('slow');
         }); */

        /**
         * Pasos como funciona
         */
        $(".next-step").on("click", function () {
            if ($(".step-1").is(":visible")) {
                $(".step-1").fadeOut(400, function () {
                    $(".step-2").fadeIn();
                });
            }
            if ($(".step-2").is(":visible")) {
                $(".step-2").fadeOut(400, function () {
                    $(".step-3").fadeIn();
                });
            }
            if ($(".step-3").is(":visible")) {
                $(".step-3").fadeOut(400, function () {
                    $(".step-1").fadeIn();
                });
            }
        });

        /**
         * Conocenos
         */
        $('.btn-conocenos').click(function () {

            var modal = $(this).data('modal');

            $('.over-info-empresa').hide();

            $('#' + modal).show('slow');
        });

        $('.over-info-empresa .close-over').click(function () {
            $('.over-info-empresa').hide();

            return false;
        });


        /**
         * Menu
         */
        var submenu2 = false;

        $('#main-nav li.parent').mouseover(function () {
            if ($(window).width() > 767) {
                $(this).find('.submenu.level0').show();
            }
            //$(this).find('.submenu.level0').hide('slow');
        });



        //$('#main-nav li.parent').mouseover(
        //    function () {
        //
        //    }, function () {
        //        if ($(window).width() > 767 && !submenu) {
        //            $(this).hide('slow');
        //        }
        //});
        //
        //$('#main-nav li.parent').mouseover(
        //    function () {
        //        $(this).find('ul.submenu.level0').show('slow');
        //        submenu = true;
        //
        //    }, function () {
        //
        //        $(this).find('ul.submenu.level0').hide('slow');
        //        submenu = false;
        //});




        $('#main-nav ul.submenu.level0').hover(
            function () {

            }, function () {
                if ($(window).width() > 767 && !submenu2) {
                    $(this).hide();
                }
            });

        $('#main-nav ul.submenu.level0 li').hover(
            function () {
                $(this).find('ul.submenu.level1').show();
                submenu2 = true;

            }, function () {

                $(this).find('ul.submenu.level1').hide();
                submenu2 = false;
            });

        /**
         * Buscador
         */
        $('#search').focusin(function(){
            $(this).animate({
                    width: 210
                }, 250
            );
        });

        $('#search').focusout(function(){
            $(this).animate({
                    width: 110
                }, 250
            );
        });

        /********************
         ********* MAPA ******
         *********************/

        function defaultTiendas() {

            var _uri = '/rac_mokup/ajax/tiendas.php?direccion=';

            $.get(_uri).success(function (data) {
                //console.log(data);
                //Despliega un mapa general de la republica e indicaciones de busqueda

                $("#mapa").googleMap(
                    {
                        zoom: 5,
                        coords: [20,-102.391966],
                        type: "ROADMAP"
                    });

                //Agrega los marcadores de las distintas tiendas RAC
                $.each(data, function (index, value) {

                    var _image = '/rac_mokup/img/marcador-2b.png';
                    $("#mapa").addMarker(
                        {
                            coords: [value.data.lat, value.data.lng],
                            icon: _image,
                            title: value.titulo, // Title
                            text: value.direccion + '<br /><br />' + value.horario + '<br /><br />Teléfono: ' + value.telefono
                        });
                });

            });
        }

        function tiendasPorCiudad(mEstado, mCiudad) {

            var _uri = '/rac_mokup/ajax/tiendas.php?ciudad=' + mCiudad + '&estado=' + mEstado;

            $.get(_uri).success(function (data) {
                //console.log(data);
                //Despliega un mapa general de la republica e indicaciones de busqueda

                $("#mapa").googleMap(
                    {
                        zoom: 17,
                        coords: [20,-102.391966],
                        type: "ROADMAP"
                    });

                //Agrega los marcadores de las distintas tiendas RAC
                $.each(data, function (index, value) {

                    var _image = '/rac_mokup/img/marcador-2b.png';
                    $("#mapa").addMarker(
                        {
                            coords: [value.data.lat, value.data.lng],
                            icon: _image,
                            title: value.titulo, // Title
                            text: value.direccion + '<br /><br />' + value.horario + '<br /><br />Teléfono: ' + value.telefono
                        });
                });

            });
        }


        $('.mapa-control').click(function () {
            var map = $('.mapa-container');

            if(map.hasClass('active-map')) {
                $('.display-map').slideUp('slow', function() {
                    map.removeClass('active-map');
                });

            } else {
                map.addClass('active-map');
                $('.display-map').slideDown('slow', function(){
                    defaultTiendas();
                });
            }
        });

        $('#defaultTiendas').click(function() {
            // defaultTiendas();
            // return false;

            window.open('/ubicacion-de-tiendas', '_self');
        });

        $('#mapa-buscar').click(function(){
            var estado = $('#mapa-estado option:selected').text();
            var ciudad = $('#mapa-ciudad option:selected').text();

            if(ciudad !== '') {
                tiendasPorCiudad(estado, ciudad);
            } else {
                alert('Por favor selecciona una ciudad');
            }
        });

        $.getJSON(location.protocol + "//" + location.host + '/formulario4.json.php?festados=ok' , function(resp) {
            var toAppend = '<option selected="selected"></option>';
            $.each(resp, function(k, v) {
                $.each(v, function(kk, vv) {
                    if (kk == 'value') toAppend += '<option value="'+vv+'">';
                    if (kk == 'estado') toAppend += vv+'</option>';
                })
            });
            $('#mapa-estado').empty().append(toAppend);
        });


        $( "#mapa-estado" ).change(function () {
            $.getJSON(location.protocol + "//" + location.host + '/formulario4.json.php?festadomunicipio=' + $('#mapa-estado').val() , function(resp) {
                var toAppend = '<option selected="selected"></option>';
                $.each(resp, function(k, v) {
                    //toAppend += '<option id="'+k+'">'+v+'</option>';
                    $.each(v, function(kk, vv) {
                        if (kk == 'value') toAppend += '<option value="'+vv+'">';
                        if (kk == 'estado') toAppend += vv+'</option>';
                        //console.log(k + ' : ' + v);
                    });
                });
                $('#mapa-ciudad').empty().append(toAppend);
            });
        }).change();


        /**
         * Buscador de sucursales RAC
         */
        $.getJSON(location.protocol + "//" + location.host + '/formulario4.json.php?festados=ok' , function(resp) {
            var toAppend = '<option selected="selected"></option>';
            $.each(resp, function(k, v) {
                $.each(v, function(kk, vv) {
                    if (kk == 'value') toAppend += '<option value="'+vv+'">';
                    if (kk == 'estado') toAppend += vv+'</option>';
                })
            });
            $('#mapa-estado-suc').empty().append(toAppend);
        });


        $( "#mapa-estado-suc" ).change(function () {
            $.getJSON(location.protocol + "//" + location.host + '/formulario4.json.php?festadomunicipio=' + $('#mapa-estado-suc').val() , function(resp) {
                var toAppend = '<option selected="selected"></option>';
                $.each(resp, function(k, v) {
                    //toAppend += '<option id="'+k+'">'+v+'</option>';
                    $.each(v, function(kk, vv) {
                        if (kk == 'value') toAppend += '<option value="'+vv+'">';
                        if (kk == 'estado') toAppend += vv+'</option>';
                        //console.log(k + ' : ' + v);
                    });
                });
                $('#mapa-ciudad-suc').empty().append(toAppend);
            });
        }).change();

        $('#buscar-sucursal').click(function(){
            var estado = $('#mapa-estado-suc option:selected').text();
            var ciudad = $('#mapa-ciudad-suc option:selected').text();

            console.log('Estado: ' + estado + ' Ciudad: ' + ciudad);

            if(ciudad !== '') {
                sucursalesPorCiudad(estado, ciudad);
            } else {
                alert('Por favor selecciona una ciudad');
            }
        });

        function sucursalesPorCiudad(mEstado, mCiudad) {

            var _uri = '/rac_mokup/ajax/tiendas.php?ciudad=' + mCiudad + '&estado=' + mEstado;

            $.get(_uri).success(function (data) {
                //console.log(data);
                //Despliega un mapa general de la republica e indicaciones de busqueda

                var isMobile = window.matchMedia("only screen and (max-width: 760px)");

                if (isMobile.matches) {
                    $('html, body').animate({scrollTop: $('.resultados-container h2').offset().top}, 'fast');
                }

                $('#mapaContainer').show();

                var height = $('#mapaControles').parent().height() - 34;

                $('#mapaContainer > div#map-suc').css({
                    'height' : height,
                    'width' : '100%'
                });

                $("#map-suc").googleMap(
                    {
                        zoom: 19,
                        coords: [20,-102.391966],
                        type: "ROADMAP"
                    });

                $('#resultados').empty();

                //Agrega los marcadores de las distintas tiendas RAC
                $.each(data, function (index, value) {

                    var _image = '/rac_mokup/img/marcador-2b.png';
                    $("#map-suc").addMarker(
                        {
                            coords: [value.data.lat, value.data.lng],
                            icon: _image,
                            title: value.titulo, // Title
                            text: value.direccion + '<br /><br />' + value.horario + '<br /><br />Teléfono: ' + value.telefono
                        });

                    var horario = value.horario;

                    horario = horario.replace(/Horario de L-S:/g,'<strong>Horario de L-S:</strong>');
                    horario = horario.replace(/Horario D:/g,'<strong>Horario D:</strong>');

                    var item = '                    <div class="resultado-item">\n' +
                        '                            <div class="resultado-description">' +
                        '                                <h3>' + value.titulo + '</h3>' +
                        '                                <p>\n' + value.direccion + '</p>' +
                        '                                <p><strong>Teléfono: </strong>' + value.telefono + '</p>\n' +
                        '                                <p>' + horario + '</p>\n' +
                        '                            </div>\n' +
                        '                            <div class="resultado-action">\n' +
                        '                                <i class="fa fa-map-marker"></i> ' +
                        '<a href="#" ' +
                        'data-lat="' + value.data.lat + '" ' +
                        'data-lng="' + value.data.lng + '" ' +
                        'data-name="' + value.titulo + '" ' +
                        'data-telefono="' + value.telefono + '" ' +
                        'data-horario="' + value.horario + '" ' +
                        'data-direccion="' + value.direccion + '"  ' +
                        'class="marker-action">Ver mapa</a>\n' +
                        '<div class="visible-xs"><br><br><i class="fa fa-road"></i> ' +
                        '<a href="#" data-lat="' + value.data.lat + '" data-lng="' + value.data.lng + '" class="marker-route">Ir a ruta</a></div>\n' +
                        '                            </div> ' +
                        '                            </div>';

                    $('#resultados').append(item);
                });

                $('.marker-route').click(function () {

                    console.log('Route');

                    var lat = $(this).data('lat');
                    var lng = $(this).data('lng');


                    if ((navigator.platform.indexOf("iPhone") !== -1) || (navigator.platform.indexOf("iPod") !== -1)) {
                        function iOSversion() {
                            if (/iP(hone|od|ad)/.test(navigator.platform)) {
                                // supports iOS 2.0 and later: <http://bit.ly/TJjs1V>
                                var v = (navigator.appVersion).match(/OS (\d+)_(\d+)_?(\d+)?/);
                                return [parseInt(v[1], 10), parseInt(v[2], 10), parseInt(v[3] || 0, 10)];
                            }
                        }
                        var ver = iOSversion() || [0];

                        if (ver[0] >= 6) {
                            protocol = 'maps://';
                        } else {
                            protocol = 'http://';

                        }
                        window.location = protocol + 'maps.apple.com/maps?daddr=' + lat + ',' + lng;
                    }
                    else {
                        window.open('http://maps.google.com?daddr=' + lat + ',' + lng);
                    }

                    return false;
                });

                $('.marker-action').click(function () {

                    console.log('Action');

                    var lat = $(this).data('lat');
                    var lng = $(this).data('lng');
                    var nombre = $(this).data('name');
                    var direccion = $(this).data('direccion');
                    var horario = $(this).data('horario');
                    var telefono = $(this).data('telefono');


                    var isMobile = window.matchMedia("only screen and (max-width: 760px)");

                    if (isMobile.matches) {

                        if ((navigator.platform.indexOf("iPhone") !== -1) || (navigator.platform.indexOf("iPod") !== -1)) {
                            function iOSversion() {
                                if (/iP(hone|od|ad)/.test(navigator.platform)) {
                                    // supports iOS 2.0 and later: <http://bit.ly/TJjs1V>
                                    var v = (navigator.appVersion).match(/OS (\d+)_(\d+)_?(\d+)?/);
                                    return [parseInt(v[1], 10), parseInt(v[2], 10), parseInt(v[3] || 0, 10)];
                                }
                            }
                            var ver = iOSversion() || [0];

                            if (ver[0] >= 6) {
                                protocol = 'maps://';
                            } else {
                                protocol = 'http://';

                            }
                            window.location = protocol + 'maps.apple.com/maps?q=' + lat + ',' + lng;
                        }
                        else {
                            window.open('http://maps.google.com?q=' + lat + ',' + lng);
                        }

                    } else {

                        $('html, body').animate({scrollTop: $('.titulo-pagina').offset().top}, 'fast');

                        var _image = '/rac_mokup/img/marcador-2b.png';
                        $("#map-suc").googleMap(
                            {
                                zoom: 17,
                                coords: [lat,lng],
                                type: "ROADMAP"
                            });

                        $("#map-suc").addMarker(
                            {
                                coords: [lat, lng],
                                icon: _image,
                                title: nombre, // Title
                                text: direccion + '<br /><br />' + horario + '<br /><br />Teléfono: ' + telefono
                            });
                    }

                    return false;
                });
            });
        }


        /**
         * Modal Newsletter
         */

        //eraseCookie('popup-news-rac');

        if(readCookie('popup-news-rac') === null) {
            console.log(readCookie('popup-news-rac'));
            //This modal is commented in template subscribe.phtml so this line won't work
            //$('#modalNewsletter').modal('show');
            createCookie('popup-news-rac', 'RAC', 1);
        } else {
            console.log(readCookie('popup-news-rac'));
        }


        function createCookie(name, value, days) {
            var expires;

            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toGMTString();
            } else {
                expires = "";
            }
            document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
        }

        function readCookie(name) {
            var nameEQ = encodeURIComponent(name) + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) === ' ')
                    c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0)
                    return decodeURIComponent(c.substring(nameEQ.length, c.length));
            }
            return null;
        }

        function eraseCookie(name) {
            createCookie(name, "", -1);
        }


    });

});
