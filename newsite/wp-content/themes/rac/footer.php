<?php
$argsFooterProducts = array(
    'post_type' => 'productos',
    'post_status'=> 'publish',
    'posts_per_page' => -1,
    'order'=> 'ASC'

);
$footerProducts = new WP_Query( $argsFooterProducts );
if( $footerProducts->have_posts() ) : ?>
  <!--section class="container mb-4">
      <div class="row d-flex justify-content-center">
        <img src="<?php bloginfo('template_url')?>/images/main/banner-estamos-para-ti-rac-info.png" alt="" class="w-100">
      </div>
    </section-->
  <footer id="footer" class="">
    <section class=" p-3 mb-4 rac-info">
      <div class="text-center">
        <h4> Estamos HOY aquí para ti al <span><a href="tel:8007224636">800 RAC INFO(722 4636)</a></span> </h4>
      </div>
    </section>
    <section class="container">
      <div class="row d-flex justify-content-center">
          <div class="col-md-4  col-sm-12 mb-4">
            <h5><strong>Acerca de RAC</strong></h5>
            <?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'principal-footer1', 'menu_class' => 'footer-list') ); ?>
          </div>
          <div class="col-md-4  col-sm-12 mb-4">
            <h5><strong>Atención a clientes</strong></h5>
            <?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'principal-footer2', 'menu_class' => 'footer-list') ); ?>
          </div>
          <div class="col-md-4 col-sm-12 mb-4">
            <ul class="social-media">
              <li class="">
     
                  <a class="" href="https://www.facebook.com/RAC-La-mejor-forma-de-comprar-108862915122546/" target="_blank">Síguenos en Facebook <i class="fab fa-facebook-f"></i></a>
              </li>
            </ul>
          </div>
      </div>
    </section>
    <section>
      <div class="text-center p-3">
        <p style="margin: 0px 0px 8px 0px; color: white;">La transacción anunciada es un contrato de renta con opción a compra. Consulta disponibilidad de producto en tienda.</p>
        <p style="margin: 0px; color: white;">Derechos reservados de RAC México Operaciones, S. de R.L. de C.V.</p>
      </div>
    </section>
  </footer>
<?php
endif;
wp_reset_postdata();?>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/lib/framework.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/generals.min.js?v=<?= date('ymd'); ?>"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/lib/respond.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/lib/modernizr.js"></script>
<script type="text/javascript">
  Modernizr.load({
    test: Modernizr.geolocation,
    yep : 'geo.js',
    nope: 'geo-polyfill.js'
  });
</script>
<![endif]-->
<?php wp_footer(); ?>
</body>
</html>
