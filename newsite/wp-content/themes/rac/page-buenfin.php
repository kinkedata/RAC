<?php 
/* Template Name: Buen Fin */ 
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
  <h1 class="primary-title mt-4 mb-3">Buen Fin</h1>
  <div class="category-description content-page-description">
    <?php the_content(); ?>
    </div>
</section>
<section class="container mt-4 mbcontent-page decorative-page pb-4 pt-0 shadow">
    <div class="row">
         <div class="col pl-0 pr-0">
            <img src="<?php echo $imageThumb;?>" alt="<?php echo $imgAttributes["alt"]?>" title="<?php echo $imgAttributes["title"]?>" class="w-100">
        </div>
    </div>
    <div id="benefits-block" class="buen-fin row row-flex content-page pt-4 pb-4">
        <h2 class="text-center">Las ofertas de El Buen Fin 2021 se aprovechan mejor con los beneficios únicos que sólo RAC La mejor forma de comprar ofrece:</h2>
        <div class="clearfix"></div>
        <div class="col beneficio-item">
                <i class="newicn-sinburo"></i>
                <h3>Sin revisar buró de crédito</h3>

        </div>
        <div class="col beneficio-item">
            
                <i class="newicn-sinhistorial"></i>
                <h3>Sin historial crediticio</h3>

        </div>
        <div class="col beneficio-item">

                <i class="newicn-sinaval"></i> 
                <h3>Sin aval y sin enganche</h3>

        </div>
        <div class="col beneficio-item">

                <i class="newicn-entrega"></i> 
                <h3>Entrega y colocación gratis</h3>

        </div>
        <div class="col beneficio-item">

                <i class="newicn-mantenimiento"></i> 
                <h3>Mantenimiento gratis <span>durante tu contrato</span></h3>

        </div>
        
        <div class="col beneficio-item">

                <i class="newicn-congelacuenta"></i> 
                <h3>Congela tu cuenta en caso de imprevistos <span>hasta por 30 días</span></h3>

        </div>
        <div class="col beneficio-item">

                <i class="newicn-50desc"></i> 
                <h3>50% de descuento en tu opción a compra</h3>
        </div>
    </div>


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

<?php include(TEMPLATEPATH . '/hr.php') ?>

<?php get_footer();?>
