<?php 
/* Template Name: Solicita información en WP */ 
get_header(); 
if( have_posts() ) :
    while( have_posts() ) :
        the_post();
        $thumbID = get_post_thumbnail_id(get_the_ID());
        $imageThumb = wp_get_attachment_image_src( $thumbID, 'full' );
        $imageThumb = $imageThumb[0];
        $attachment_meta = wp_get_attachment($thumbID);
        $imgAttributes["alt"] = $attachment_meta["alt"];
        $imgAttributes["title"] = $attachment_meta["title"];
    endwhile;
endif;

$is_for_product = FALSE;
$is_in_process = FALSE;
if( !empty($_GET['producto']) ){
    $product = get_posts([
        'posts_per_page' => 1,
        'fields'         => 'ids' ,
        'post_type'      => 'productos',
        'post_name__in'  => [ $_GET['producto'] ]
    ]);

    if( !empty($product) ){
        $is_for_product = TRUE;
        $product_id = $product[0];
        $product_title = get_the_title( $product_id );
        $product_thumb_id = get_post_thumbnail_id( $product_id );
        $product_image = wp_get_attachment_image_src( $product_thumb_id, 'full' );
        $product_image_data = wp_get_attachment($product_thumb_id);
        $product_price = get_field('precio_promo', $product_id);
        if( empty($product_price) ) $product_price = get_field('precio_semanal', $product_id);
    }
    if( !empty($_GET['act']) && $_GET['act'] == 'proceso' ) $is_in_process = TRUE;
}
?>
<style type="text/css">
    label a{ font-weight: bold; }
    .text-white{ color: #FFFFFF; }
    .text-yellow{ color: #FFE700; }
    .text-bold{ font-weight: bold; }
    .form-control{ font-size: 13px; }
    #racSite #beneficios i{ display: inline-block; }
    #racSite #sucursalesAbiertas li p{ margin-bottom: 4px; }
    #racSite #sucursalesAbiertas li p.selecionado{ display: none; }
    #racSite #sucursalesAbiertas li.is-active p.seleccionar{ display: none; }
    label, label a{ display: inline; font-size: 13px; color: white !important; }
    #racSite #beneficios.beneficios-solicitainformes i:before{ font-size: 30px; }
    #racSite #sucursalesAbiertas{ padding: 0 !important; margin: 0 !important; list-style: none !important; }
    .btn-send-form{ width: auto; color:  white; border:  none; padding: 3px 25px; border-radius: 4px; background: #FF151F; }
    #racSite #sucursalesAbiertas li.is-active p.selecionado{ right: 25px; display: block; margin-top: -5px; position: absolute; }
    #racSite #sucursalesAbiertas li p.seleccionar{ right: 25px; color: #003566; font-size: 12px; font-weight: bold; position: absolute; }
    #racSite #sucursalesAbiertas li{ color: black; padding: 3px; display: block; font-size:  13px; background: white; border-radius: 4px; margin-top: 20px; cursor: pointer; }
</style>
<!--div class="col-lg-12">
    <?php include(TEMPLATEPATH . '/breadcrumb.php') ?>
</div-->
<section class="container">
    <h1 class="primary-title mt-4 mb-3">
        <?= ( $is_in_process ) ? 'Quiero iniciar mi proceso' : 
            ( $is_for_product ? 'Quiero solicitar informes sobre un producto' : 'Solicita informes' ); ?>
    </h1>
    <div class="category-description content-page-description">
         <?= 
            ( $is_in_process ) ? 'Estás muy cerca tener tu producto. <br>Completa el formulario y uno de nuestros asesores te contactará para ayudarte en tu proceso.' : 
            ( $is_for_product ? 'Regístrate en el siguiente formulario y uno de nuestros asesores te contactará vía telefónica para darte más información.' 
            : 'En RAC La mejor forma de comprar estamos listos para brindarte la información necesaria sobre el producto y promoción de interés. ¡Escríbenos! Y en breve nos pondremos en contacto contigo.' ); 
        ?>
    </div>
</section>
<section id="" class="container mt-4 content-page pb-4 mb-4 decorative-page shadow pt-4">
    <div class="row">
        <div class="col-xs-12 col-md-6 offset-md-1">
            <form id="solicita-informacion-form" action="" method="post" name="ganaracForm" novalidate="novalidate">
                <div class="row" style="background: #003566;">
                    <div class="col-xs-12 col-md-10 offset-md-1 p-4">
                        <?php if($is_for_product): ?>
                            <p class="text-yellow text-bold">El producto de tu interés</p>
                            <div class="row" style="margin: 0; background: white; border-radius: 4px;">
                                <div class="col-4">
                                    <img src="<?php echo $product_image[0];?>" class="w-100">
                                </div>
                                <div class="col-8 pt-3 pb-2" style="padding-left: 0;">
                                    <h1 class="product-page-title" style="font-size: 13px;"> <?= $product_title; ?></h1>
                                    <p style="font-size: 13px;">A $<?= $product_price; ?> semanales</p>
                                </div>
                            </div>
                            <p class="pt-3 text-yellow text-bold">Cuéntanos sobre ti</p>
                            <label class="pb-1" style="display:block;">Datos para contactarte</label>
                        <?php else: ?>
                            <p class="pb-3 text-yellow text-bold">Regístrate y nosotros te llamamos</p>
                        <?php endif; ?>

                        <div class="row">
                            <div class="form-group col-md-6"> <input class="form-control" id="nombre" name="nombre" placeholder="Nombre(s)"></input> </div>
                            <div class="form-group col-md-6"> <input class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Apellidos"></input> </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12"> <input class="form-control" id="celular" name="celular" maxlength="10" minlength="10" name="celular" placeholder="Teléfono celular a 10 dígitos"></input> </div>
                            <?php if($is_for_product): ?>
                                <input class="form-control" id="producto" name="producto" placeholder="Producto" value="<?= $product_title; ?>" hidden></input>
                            <?php else: ?>
                                <div class="form-group col-12">
                                    <select class="form-control" id="producto" name="producto">
                                        <option value="" disabled="" selected>Producto de interés</option>
                                        <option value="Celulares">Celulares</option>
                                        <option value="Computadoras">Computadoras</option>
                                        <option value="Electrónicos">Electrónicos</option>
                                        <option value="Línea Blanca">Línea Blanca</option>
                                        <option value="Muebles">Muebles</option>
                                        <option value="Motos">Motos</option>
                                    </select> 
                                </div>
                            <?php endif; ?>
                        </div>
                        <p class="pt-3 text-yellow text-bold">Elige la tienda más cercana a ti</p>
                        <div class="row">
                            <div class="form-group col-md-12"> 
                                <input class="form-control" id="codigoPostal" name="codigoPostal" maxlength="5" minlength="5" placeholder="Ingresa un código postal"></input> 
                                <label>Se mostrán las 5 tiendas más cercas al código postal</label>
                                <ul id="sucursalesAbiertas"></ul>
                                <input class="form-control" id="tienda_estado" name="tienda_estado" hidden></input>
                                <input class="form-control" id="tienda_ciudad" name="tienda_ciudad" hidden></input>
                                <input class="form-control" id="tienda_tienda" name="tienda_tienda" style="height: 0; padding: 0; border: none"></input>
                            </div>
                        </div>
                        <div class="form__group form__group--aviso-red mb-3 pb-1">
                            <label for="aviso">
                                <input type="checkbox" name="aviso" id="aviso"> <label for="aviso">Manifiesto que leí, conozco y estoy de acuerdo con el <a href="https://rac.mx/aviso-de-privacidad/" target="_blank"> aviso de privacidad</a></label>
                            </label>
                        </div>
                        <div class="link__container link__container--form text-center">
                            <button type="submit" value="Submit" class=" btn-send-form">
                                <?= ($is_in_process) ? 'Quiero este producto' : 'Quiero que me llamen'; ?> 
                            </button>
                            <div class="loading"><div class="loader"></div></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-xs-12 col-md-5">
            <div id="beneficios" class="mb-4 beneficios-solicitainformes">
                <h2>Además, disfruta de estos beneficios</h2>
                <h3><i class="newicn-entrega"></i> Entrega y colocación gratis</h3>
                <h3><i class="newicn-sinaval"></i> Mantenimiento gratis </h3>
                <h3><i class="newicn-sinburo"></i> Sin revisar buró de crédito</h3>
                <h3><i class="newicn-sinhistorial"></i> Sin historial crediticio</h3>
                <h3><i class="newicn-sinaval"></i> Sin aval y sin enganche</h3>
                <h3><i class="newicn-congelacuenta"></i> Congela tu cuenta en caso de imprevistos</h3>
                <h3><i class="newicn-50desc"></i> 50% de descuento en tu opción a compra</h3>
            </div>
        </div>
    </div>
    <script src="<?= get_template_directory_uri(); ?>/js/lista_sucursales.js?v=<?= rand();?>"></script>
    <script src="<?= get_template_directory_uri(); ?>/js/select_sucursales.js?v=2"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdy5wmGMEWScoIFxAsKMz3eWFKdbqyXns&region=MX&v=3&libraries=geometry"></script>
</section>

<?php get_footer();?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script type="text/javascript">

    var inputCP = document.getElementById('codigoPostal');
    var listadoSucursales = document.getElementById('sucursalesAbiertas');

    jQuery.validator.addMethod('lettersonly', function(value, element){ return this.optional(element) || /^[a-zá-úä-ü," "]+$/i.test(value); }, 'Letters only please');

    function setSucActive(estado_id, ciudad_id, tienda_id){
        $('#tienda_estado').val(estado_id);
        $('#tienda_ciudad').val(ciudad_id);
        $('#tienda_tienda').val(tienda_id);
    }

    $('#solicita-informacion-form').validate({
        rules: {
            nombre: { required: true, lettersonly: true },
            apellido_paterno: { required: true, lettersonly: true },
            celular: { required: true, number: true, minlength: 10, maxlength: 10 },
            producto: { required: true },
            tienda_estado: { required: true },
            tienda_ciudad: { required: true },
            tienda_tienda: { required: true },
            aviso: { required: true },
        }, messages: {
            nombre: "Por favor ingresa tu nombre",
            apellido_paterno: "Por favor ingresa tus apellidos",
            celular: "Por favor ingresa tu celular",
            producto: "Por favor seleccione un producto",
            tienda_estado: "Por favor seleccione un estado",
            tienda_ciudad: "Por favor seleccione una ciudad",
            tienda_tienda: "Por favor seleccione una tienda",
            aviso: "",
        }, submitHandler: function(form){
            $.ajax({
                type: "POST",
                url: '<?= site_url("api/v2.0/informes"); ?>',
                data: {
                    "nombre" : $("#nombre").val(),
                    "segundo_nombre" : ' ',
                    "apellido_paterno" : $("#apellido_paterno").val(),
                    "apellido_materno" : ' ',
                    "celular" : $("#celular").val(),
                    "horario" : ' ',
                    "producto" : $("#producto").val(),
                    "estado_id" : $("#tienda_estado").val(),
                    "ciudad_id" : $("#tienda_ciudad").val(),
                    "tienda_id" : $("#tienda_tienda").val(),
                    "proceso": <?= intval( $is_in_process ); ?>,
                    "aviso": $("#aviso").is(':checked')
                },
                success: function(data){
                    $("#nombre").val('');
                    $("#apellido_paterno").val('');
                    $("#celular").val('');
                    $("#producto").val('');
                    $("#codigoPostal").val('');
                    $("#tienda_estado").val('');
                    $("#tienda_ciudad").val('');
                    $("#tienda_tienda").val('');
                    listadoSucursales.innerHTML = '';
                    $("#aviso").prop('checked', false );
                    window.location.href = '<?= site_url(); ?>';
                },
                error: function (data) {
                    console.log(data)
                }
            });
        }
    });

    var counterSucursales = 0;
    var counterPrintedSucursales = 0;

    inputCP.addEventListener('keyup', function(){
        listadoSucursales.innerHTML = '';
        if(inputCP.value.length == 5){
            getSucursales(inputCP.value, function(sucursales){
                counterSucursales = 0;
                counterPrintedSucursales = 0;
                $('#preregistro-sucursal-none').hide();
                if(sucursales.length > 0){
                    sucursales.forEach(function(sucursal, index){ armarTabla(sucursal, index); });
                    if(counterPrintedSucursales == 0) $('#preregistro-sucursal-none').show();
                } else { $('#preregistro-sucursal-none').show(); }
            });
        }
    });

    function getSucursales(zip_code, callback){
        var sucursales_array = [];
        var filter_sucursales_array = [];
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({componentRestrictions:{ country: 'MX', postalCode: zip_code }}, function(results, status){
            if(status == google.maps.GeocoderStatus.OK){
                var zip_coords = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
                Object.entries(sucursales).forEach(([estado]) => {
                    Object.entries(sucursales[estado]).forEach(([ciudad]) => {
                        Object.entries(sucursales[estado][ciudad]).forEach(([key, value]) => {
                            var suc_coords = new google.maps.LatLng(value['lat'], value['lng']);
                            var distance = google.maps.geometry.spherical.computeDistanceBetween(zip_coords, suc_coords);
                            if(distance <= 200000){
                                var sucursal = sucursales[estado][ciudad][key];
                                sucursal['distance'] = distance;
                                sucursales_array.push(sucursal);
                            }
                        });
                    });
                });
                sucursales_array.sort(function(a, b){return a['distance']-b['distance']});
            }
            if(sucursales_array.length > 0){
                let nearest_distance = sucursales_array[0].distance;
                if(nearest_distance < 20000)
                    sucursales_array.forEach(function(sucursal){ if(sucursal.distance < 20000){ filter_sucursales_array.push(sucursal) } });
                else if(nearest_distance < 30000)
                    sucursales_array.forEach(function(sucursal){ if(sucursal.distance < 30000){ filter_sucursales_array.push(sucursal) } });
                else 
                    sucursales_array.forEach(function(sucursal){ filter_sucursales_array.push(sucursal) });
            }
            callback(filter_sucursales_array);
        });
    }

    function armarTabla(sucursal, index){
        idSucursal = parseInt(sucursal['tienda_id']);

        var code = '';
        code = '<li onclick="setSucActive('+sucursal['estado_id']+','+sucursal['ciudad_id']+','+sucursal['tienda_id']+'); $(\'#sucursalesAbiertas li\').removeClass(\'is-active\'); $(this).addClass(\'is-active\'); ">';
            code += '<div class="stores pt-2 pb-2" style="margin-left: 35px; margin-right: 35px;">';
                    code += '<svg style="position: absolute; left: 25px;" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1728_1069)"><path d="M12 24C12 24 21 15.471 21 9C21 6.61305 20.0518 4.32387 18.364 2.63604C16.6761 0.948211 14.3869 0 12 0C9.61305 0 7.32387 0.948211 5.63604 2.63604C3.94821 4.32387 3 6.61305 3 9C3 15.471 12 24 12 24ZM12 13.5C10.8065 13.5 9.66193 13.0259 8.81802 12.182C7.97411 11.3381 7.5 10.1935 7.5 9C7.5 7.80653 7.97411 6.66193 8.81802 5.81802C9.66193 4.97411 10.8065 4.5 12 4.5C13.1935 4.5 14.3381 4.97411 15.182 5.81802C16.0259 6.66193 16.5 7.80653 16.5 9C16.5 10.1935 16.0259 11.3381 15.182 12.182C14.3381 13.0259 13.1935 13.5 12 13.5Z" fill="#003566"/></g><defs><clipPath id="clip0_1728_1069"><rect width="24" height="24" fill="white"/></clipPath></defs></svg>';
                    
                    code += '<p class="seleccionar">Seleccionar</p>';
                    code += '<p class="selecionado"><svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M26.0809 5.79055C25.8297 5.79803 25.5914 5.90299 25.4163 6.08319L10.6331 20.8664L4.54988 14.7832C4.4608 14.6904 4.35411 14.6164 4.23606 14.5653C4.118 14.5143 3.99095 14.4873 3.86234 14.486C3.73374 14.4847 3.60616 14.5091 3.48709 14.5577C3.36802 14.6063 3.25984 14.6782 3.1689 14.7691C3.07796 14.8601 3.00608 14.9683 2.95746 15.0873C2.90885 15.2064 2.88448 15.334 2.88579 15.4626C2.8871 15.5912 2.91406 15.7182 2.96508 15.8363C3.01611 15.9544 3.09018 16.061 3.18295 16.1501L9.94962 22.9168C10.1309 23.098 10.3767 23.1998 10.6331 23.1998C10.8894 23.1998 11.1353 23.098 11.3165 22.9168L26.7832 7.45012C26.9229 7.31434 27.0183 7.13953 27.0569 6.94859C27.0956 6.75766 27.0756 6.55951 26.9997 6.38011C26.9238 6.20071 26.7954 6.04843 26.6315 5.94323C26.4675 5.83802 26.2756 5.78481 26.0809 5.79055Z" fill="#34A853"/></svg></p>';
                    code += '<p style="font-weight: bold; font-size: 16px; margin-bottom: 0px; margin-top: -5px; padding-right: 25px;"><a href="https://www.google.com/maps/search/?api=1&amp;query='+sucursal['lat']+','+sucursal['lng']+'&amp;zoom=20" target="_blank">'+ sucursal['titulo'] + '</a></p>';
                    code += '<p style=" color: #5A5A5A">'+(sucursal['distance']/1000).toFixed(2) +' km de distancia </p>';
                    code += '<p style=" margin-top: 10px">'+sucursal['horario']+'<br>'+sucursal['horario2']+'</p>';
                    code += '<p style=" margin-top: 10px">' + sucursal['direccion'] + '</p>';
            code += '</div>';
        code += '</li>';
        if(counterSucursales < 5){
            listadoSucursales.insertAdjacentHTML('beforeend', code);
            counterSucursales++;
            counterPrintedSucursales++;
        }
    }
</script>