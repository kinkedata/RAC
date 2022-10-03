<?php 
/* Template Name: Sucursales */ 
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
?>

<div class="col-lg-12">
    <?php include(TEMPLATEPATH . '/breadcrumb.php') ?>
</div>
<section class="container ">
  <h1 class="primary-title mt-4 mb-3">Ubica tu tienda</h1>
  <div class="category-description content-page-description">
    <?php the_content(); ?>
    </div>
</section>
<section class="container mt-4 mb-4 content-page decorative-page pb-4 pt-4 shadow" style="min-height: 459px;">
    <div class="row">
        <img src="<?php echo $imageThumb;?>" alt="<?php echo $imgAttributes["alt"]?>" title="<?php echo $imgAttributes["title"]?>" class="w-100">
    </div>
    <div class="page-content">
        <div class="row" style="justify-content: center">
            <div class="col-xs-12 col-md-4">
                <div class="form-group"> <label for="tienda_estado">Selecciona un estado</label> <select class="form-control" id="tienda_estado"><option value="" disabled="" selected></option></select> </div>
                <div class="form-group"> <label for="tienda_ciudad">Selecciona una ciudad</label> <select class="form-control" id="tienda_ciudad"><option value="" disabled="" selected></option></select> </div>
            </div>
            <div class="col-xs-12 col-md-8">
                <div id="map"></div>
            </div>
            <div class="col-xs-12">
                <div id="tienda_listado"></div>
            </div>
        </div>
        <script src="<?= get_template_directory_uri(); ?>/js/lista_sucursales.js?v=<?= rand();?>"></script>
        <script src="<?= get_template_directory_uri(); ?>/js/buscador_sucursales.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdy5wmGMEWScoIFxAsKMz3eWFKdbqyXns"></script>
    </div>
</section>
<?php get_footer();?>