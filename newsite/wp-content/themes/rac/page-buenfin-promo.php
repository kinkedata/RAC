<?php 
/* Template Name: Buen Fin  Promos*/ 
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
<section class="container">
  <h1 class="primary-title mt-4 mb-3"><?php the_title();?></h1>
</section>
<section id="motos-landingpage" class="container mt-4 content-page decorative-page product-grid pb-4 mb-4">
    <div class="row">
        <img src="<?php echo $imageThumb;?>" alt="<?php echo $imgAttributes["alt"]?>" title="<?php echo $imgAttributes["title"]?>" class="w-100">
    </div>
    <p class="mt-4 mb-4 text-center secondary-title">Ofrecemos estos productos de Buen Fin y sin revisar tu buró de crédito.</p>

    <div class="row mb-5">
        <?php
          $args = array(
            'post_type' => 'productos',
            'posts_per_page' => -1,
            'cat'=> 29
          );
          $sliders = new WP_Query( $args );
          if( $sliders->have_posts() ) :
            while( $sliders->have_posts() ) : $sliders->the_post();

              $thumbIDslider = get_post_thumbnail_id(get_the_ID());
              $imageThumbslider = wp_get_attachment_image_src( $thumbIDslider, 'full' );
              $imagedata = wp_get_attachment($thumbIDslider);
              $preciopromo = get_field('precio_promo');
              ?>

                <div class="col-md-3">
                    <div class="product-preview">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo  $imageThumbslider[0]; ?>" alt="<?php echo $imagedataslider['alt'];?>" title="<?php echo $imagedataslider['title'];?>" class="w-100">
                    </a>
                    <div class="product-preview-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title();?>
                        </a>
                        <p style="margin: 0; font-size: 0.9em">
                            <?php echo get_field('sku'); ?>
                        </p>
                    </div>
                    <div class="">
                        <?php if ($preciopromo ) : ?>
                            <span class="price-underline">Precio regular $<?php echo get_field('precio_semanal');?> semanales<br></span>
                            <strong>Con promo $<?php echo $preciopromo;?> semanales</strong>
                        <?php else : ?>
                            <span class="">Precio regular $<?php echo get_field('precio_semanal');?> semanales<br></span>
                            <strong><?php echo get_field('extra_promo');?></strong>
                        <?php endif; ?>
                    </div>
                    </div>
                </div>
              
            <?php endwhile;
          endif;
          wp_reset_postdata();?>  
    </div>

    <!--h2 class="mt-5 mb-1 text-center">Envíanos tus datos y nuestro equipo te contactará para brindarte más información o iniciar tu proceso.</h2>

    <div class="row solicita-informacion-frame text-center center-block">
        <div class="w-100 formulario-crm-rac text-center center-block" style="height: 75vh; margin: 0 auto;">
            <iframe id="" src="https://formulario.rac.mx/formularios/contacto" style="height: 100%; width:100%;"></iframe>
        </div>
	    <div class="category-description content-page-description">
	      <?php the_content(); ?>
	     </div>
    </div-->
    <!--div class="row motos-formulario mt-4">
        <div class="col-md-6 col-12 formulario-crm-rac">
            <iframe src="https://formulario.rac.mx/formularios/motos"></iframe>
        </div>
    </div-->

    <div class="row mt-4">
        <div class="col">
            <h4>¿Cuándo comienzan las promociones del Buen Fin 2021? </h4>
            <p>Este año el Buen Fin comienza el 10 de noviembre de 2021 y finaliza el 16 de noviembre, para que aproveches los descuentos y beneficios especiales que solo RAC la mejor forma de comprar, te ofrece.</p>

            <h4>¿Puedo comprar si no tengo historial crediticio o estoy en buró de crédito?</h4>
            <p>Nosotros creemos en ti y entendemos que pudiste haber pasado por un tiempo difícil, por ello nosotros no te pedimos historial crediticio, además puedes elegir un plan de pagos que se adapte a tus necesidades, sin aval, sin enganche y sin revisar buró de crédito o historial crediticio..</p>

            <h4>¿Cómo puedo amueblar o equipar mi casa o negocio? </h4>
            <p>En RAC la mejor forma de comprar nos comprometemos a hacer tu vida más fácil, con productos de las mejores marcas y beneficios que nadie más te ofrece. En nuestro sitio encontrarás productos que podrás adquirir en renta con opción a compra y con un plan de pagos a tu medida perfecto para equipar tu casa, negocio u oficina. Adicionalmente te ofrecemos la entrega, colocación y mantenimiento gratis durante tu contrato.</p>
                <p>Te esperamos en éste Buen Fin.</p>
           
        </div>
    </div>
   
</section>

<?php get_footer();?>
