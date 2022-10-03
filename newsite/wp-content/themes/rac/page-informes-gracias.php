<?php 
/* Template Name: Informes gracias */ 
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
<script type="text/javascript">
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({'event': 'registro',
       'section': 'tkp',
       'producto': '<?= $_COOKIE['producto_formulario']; ?>',
       'tid': '<?= $_COOKIE['folio_formulario']; ?>'
    });
</script>
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
<section id="" class="container mt-4 content-page pb-4 mb-4 decorative-page shadow pt-4">
    <div class="row">
        <div class="col-xs-12 col-md-8 offset-md-2" >
            <h3 class="text-center" style="color: #797979;">¡Tu registro está completo!</h3>
            <h2 class="text-center" style="color: #003566; font-weight: 100;">En un <strong style="font-weight: bold;">lapso de 24 horas uno de nuestros asesores te contactará</strong> vía telefónica.</h2>
            <div class="row my-5">
                <div class="col-xs-12 col-md-4 offset-md-1" style="color:#003566; font-weight: bold;"><big>Horario de llamada: </big></div>
                <div class="col-xs-12 col-md-6" style="color:#797979; font-weight: bold;"><big>Lunes a domingo de 10:00 a 20 hrs</big></div>

                <?php if($_GET['store']): ?>
                    <div class="col-xs-12 col-md-4 offset-md-1" style="color:#003566; font-weight: bold;"><big>Tienda seleccionada: </big></div>
                    <div class="col-xs-12 col-md-6" style="color:#797979; font-weight: bold;"><big id="nombreTienda"></big></div>
                <?php endif; ?>
                <?php if($is_for_product): ?>
                    <div class="col-xs-12 col-md-4 offset-md-1 mt-5" style="color:#003566; font-weight: bold;"><big>Producto de interés: </big></div>
                    <div class="col-xs-12 col-md-10 offset-md-1">
                        <div class="row shadow mt-3" style="margin: 0; background: white; border-radius: 4px;">
                            <div class="col-4">
                                <img src="<?php echo $product_image[0];?>" class="w-100">
                            </div>
                            <div class="col-8 pt-3 pb-2" style="padding-left: 0;">
                                <h1 class="product-page-title"> <?= $product_title; ?></h1>
                                <p >A $<?= $product_price; ?> semanales</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="<?= get_template_directory_uri(); ?>/js/cookies.js?v=<?= rand();?>"></script>
    <script src="<?= get_template_directory_uri(); ?>/js/lista_sucursales.js?v=<?= rand();?>"></script>
</section>

<?php get_footer();?>

<script type="text/javascript">
    Object.entries(sucursales).forEach(([estado]) => {
        Object.entries(sucursales[estado]).forEach(([ciudad]) => {
            Object.entries(sucursales[estado][ciudad]).forEach(([key, value]) => {
                var sucursal = sucursales[estado][ciudad][key];
                var tienda_id = sucursal['tienda_id'];
                if(tienda_id == parseInt("<?= $_GET['store']; ?>")){
                    $('#nombreTienda').html(sucursal['titulo']);
                }
            });
        });
    });
</script>