<?php get_header();
/* Template Name: Mantenimiento */ 
?>
<div class="col-lg-12">
    <?php include(TEMPLATEPATH . '/breadcrumb.php') ?>
</div>
<section class="container mt-4 mb-4 content-page decorative-page pb-4 pt-4 shadow">
    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 459px;">
        <h1 class="primary-title mt-4 mb-3" style="text-align: center">SITIO EN MANTENIMIENTO</h1>
        <p>Estamos trabajando en nuestro sitio para mejorar tu experiencia en RAC La mejor forma de comprar.</p>
        <p>Si deseas más información sobre algún producto o si quieres iniciar tu proceso, comunicarte a la tienda más cercana:</p>
        <a href="<?php bloginfo('url');?>/ubica-tu-tienda" class="general-button btn btn-primary m-auto" style="margin: 1rem 0px !important;">Encuéntrala aquí</a>
    </div>
</section>
<?php get_footer();?>