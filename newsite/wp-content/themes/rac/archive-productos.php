<?php get_header();?>
<div class="col-lg-12">
    <?php include(TEMPLATEPATH . '/breadcrumb.php') ?>
</div>
<section class="container">
  <h1 class="primary-title mt-4 mb-3">Productos RAC</h1>
  <div class="category-description content-page-description">En RAC te ofrecemos las mejores marcas para amueblar tu casa como Hisense, LG , Samsung, Whirlpool, Mabe, Easy, Acros, PS4, XBOX ONE, Spring Air, Serta y más. Puedes encontrar productos en renta con opción a compra. de Electrónicos, Celulares, Computadoras, Línea Blanca, Muebles, Colchones. y Motos.</div>
</section>
<section class="content-page container mt-4 mb-4 pt-4 pb-4">
    <!--div class="row">
      <img src="<?php bloginfo('template_url');?>/images/main/categorias.png" alt="" title="" class="w-100">
    </div-->
    
    
    <h3 class="title-divider mt-1">Encuentra lo que buscas</h3>
      <div id="home-categories" class="row justify-content-between">
        <?php include(TEMPLATEPATH . '/categories-block.php') ?>
      </div>
</section>



<?php get_footer();?>