<?php 
/* Template Name: Cómo funciona */ 
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
  <h1 class="primary-title mt-4 mb-3">Cómo funciona</h1>
  <div class="category-description content-page-description font-size-mb-1">
    <?php the_content(); ?>
    </div>
</section>
<section class="container content-page  decorative-page mt-4 mb-4 pt-0 pb-4 shadow">
    <div class="row">
       <div class="col pl-0 pr-0 mb-4">
        <img src="<?php echo $imageThumb;?>" alt="<?php echo $imgAttributes["alt"]?>" title="<?php echo $imgAttributes["title"]?>" class="w-100">
       </div>
    </div>
    <div class="row row-flex mb-5">
        <div class="col-12 col-md-6">
            <div class="shadow p-4 h-100">
                <h2 class="secondary-title">Proceso y beneficios</h2>
                <hr class="mb-4">
                <ul>
                    <li>En RAC jamás revisamos el buró de crédito.</li>
                    <li>Elige el producto que necesites sin enganche, sin aval y con entrega a domicilio y colocación GRATIS.</li>
                    <li>Te ofrecemos mantenimiento GRATIS durante la vigencia de tu contrato. Si el producto sufre un desperfecto,
            NO TE PREOCUPES, te daremos un artículo similar que lo reemplace temporalmente.</li>
                    <li>¿Tuviste algún imprevisto y no puedes seguir pagando? RAC CONGELA TU CUENTA, sólo devuelve el producto
            y si antes de 30 días puedes volver a pagar, ¡te lo regresamos! y reanudas tu cuenta.</li>
                    <li>Obtén 50% de descuento en tu opción a compra ¡Tu decides cuando!</li>
            </ul>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="shadow p-4 h-100">
                <h2 class="secondary-title">¿Cómo empiezo?</h2>
                <hr class="mb-4">
                <p>¡Es muy fácil!</p>
                <ul>
                    <li>Presenta en tienda: identificación oficial, 4 referencias, comprobar tus ingresos y comprobante de domicilio.</li>
                    <li>Selecciona el producto que necesites.</li>
                    <li>Elige tu plan de pagos: semanal. quincenal o mensual.</li>
                </ul>
            </div>
        </div>
    </div>
    <h3 class="mb-4 mt-4">Ellos confían en nosotros</h2>
    <div class="row testimoniales">
        <div class="col-lg-6 beneficio-historia">
            <img src="<?php bloginfo('template_url');?>/images/main/cliente-como-funciona-rac.png" alt="Experiencia de cliente con renta de muebles" description="La renta de muebles ha sido la mejor decisión ">
            <p class="historia-testimonio">"Clientes desde hace 5 años, nos gusta que nos atienden muy bien. Llevamos varios productos, el próximo es una estufa para mi esposa"</p>
            <p class="historia-testimonio"><em>Desde Acuña, Coahuila</em></p>
        </div>
        <div class="col-lg-6 beneficio-historia">
            <img src="<?php bloginfo('template_url');?>/images/main/persona-como-funciona-rac.png" alt="Testimonio de como funciona RAC " description="Funcionamiento de Rac">
            <p class="historia-testimonio">"He amueblado mi casa con RAC, soy cliente por más de 5 años y siempre me han tratado excelente. La Tienda está muy cerca de mi casa."</p>
            <p class="historia-testimonio"><em>Juárez, Nuevo León</em></p>
        </div>
    </div>
</section>

<?php get_footer();?>
