<?php 
/* Template Name: Motos */ 
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
  <div class="category-description content-page-description">
    <?php the_content(); ?>
    </div>
</section>
<section id="motos-landingpage" class="container mt-4 content-page decorative-page product-grid pb-4 mb-4">
    <div class="row">
        <img src="<?php echo $imageThumb;?>" alt="<?php echo $imgAttributes["alt"]?>" title="<?php echo $imgAttributes["title"]?>" class="w-100">
    </div>
    <p class="mt-4 mb-4 text-center secondary-title">Ofrecemos motos Italika sin revisar tu buró de crédito.</p>

    <div class="row mb-5 justify-content-center">
        <?php
          $args = array(
            'post_type' => 'productos',
            'posts_per_page' => -1,
            'cat'=> 5
          );
          $sliders = new WP_Query( $args );
          if( $sliders->have_posts() ) :
            while( $sliders->have_posts() ) : $sliders->the_post();

              $thumbIDslider = get_post_thumbnail_id(get_the_ID());
              $imageThumbslider = wp_get_attachment_image_src( $thumbIDslider, 'full' );
              $imagedata = wp_get_attachment($thumbIDslider);
              ?>

                <div class="col-md-3">
                    <div class="product-preview text-center">
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
                            $<?php echo get_field('precio_semanal');?> semanales
                        </div>
                    </div>
                </div>
              
            <?php endwhile;
          endif;
          wp_reset_postdata();?>  
    </div>

    <!--h2 class="mt-5 mb-5 text-center">Envíanos tus datos y nuestro equipo te contactará para brindarte más información o iniciar tu proceso.</h2>

    <div class="row motos-formulario mt-4">
        <div class="col-md-6 col-12 estados-cont">
            <p class="mb-5">Contamos con motos en exhibición en las siguientes tiendas.
                Si tu tienda RAC más cercana no se encuentra en el listado podemos transferirla sin compromiso, solo regístrate en cualquier tienda de tu ciudad para solicitar informes y nosotros nos encargamos.</p>
            <div id="categories-menu">
                <h3>DISPONIBLES EN</h3>
                <ul class="category-list-accordion">
                    <li class="principal-list">Aguascalientes<i class="fa fa-angle-down"></i>
                        <ul>
                            <li>Velaria Mall</li>
                            <li>Jesús María Centro</li>
                        </ul>
                    </li>
                    <li class="principal-list">Colima<i class="fa fa-angle-down"></i>
                        <ul>
                            <li>Hidalgo</li>
                        </ul>
                    </li>
                    <li class="principal-list">Jalisco<i class="fa fa-angle-down"></i>
                        <ul>
                            <li>Francisco Villa</li>
                            <li>Multiplaza Del Valle Tlajomulco</li>
                            <li>Hacienda Eucaliptos Tlajomulco</li>
                            <li>Centro Sur Tlaquepaque</li>
                            <li>Hacienda Tesistán Zapopan</li>
                            <li>Plaza Belenes Zapopan</li>
                        </ul>
                    </li>
                    <li class="principal-list">Nayarit<i class="fa fa-angle-down"></i>
                        <ul>
                            <li>Bahia de Banderas</li>
                        </ul>
                    </li>
                    <li class="principal-list">Nuevo León <i class="fa fa-angle-down"></i>
                        <ul>
                            <li>Sun Mall</li>
                            <li>Santa María Guadalupe</li>
                            <li>Solidaridad Monterrey</li>
                            <li>Plaza Santa Cruz Guadalupe</li>
                            <li>Ciudadela Juárez</li>
                            <li>Hacienda del Sol Garcia</li>
                            <li>Sor Juana Garcia</li>
                            <li>Valle de Lincoln Garcia</li>
                            <li>Cadereyta</li>
                            <li>Aztlán</li>
                            <li>Ave. Raúl Salinas</li>
                            <li>Linares Centro</li>
                            <li>Diego Diaz de Berlanga</li>
                            <li>Montemorelos</li>
                        </ul>
                    </li>
                    <li class="principal-list">Querétaro<i class="fa fa-angle-down"></i>
                        <ul>
                            <li>5 de Febrero</li>
                            <li>Av. La Luz Santiago de Querétaro</li>
                            <li>Pie de la Cuesta Santiago de Querétaro</li>
                        </ul>
                    </li>
                    <li class="principal-list">San Luis Potosí<i class="fa fa-angle-down"></i>
                        <ul>
                            <li>Carretera a Zacatecas</li>
                            <li>Plaza Cactus Soledad de Graciano Sánchez</li>
                            <li>San Pedro Soledad de Graciano Sánchez</li>
                        </ul>
                    </li>
                    <li class="principal-list">Guanajuato<i class="fa fa-angle-down"></i>
                        <ul>
                            <li>Plaza Juarez</li>
                            <li>Andrés Delgado</li>
                            <li>Blvd. Delta</li>
                        </ul>
                    </li>
                    <li class="principal-list">Coahuila<i class="fa fa-angle-down"></i>
                        <ul>
                            <li>Mirasierra</li>
                            <li>Plaza Bella Ramos Arizpe</li>
                            <li>Piedras Negras</li>
                        </ul>
                    </li>
                    <li class="principal-list">Tamaulipas<i class="fa fa-angle-down"></i>
                        <ul>
                            <li>Plaza Reforma</li>
                            <li>Patio Matamoros</li>
                            <li>Plaza Aeropuerto</li>
                            <li>Citadina</li>
                        </ul>
                    </li>
                </ul>
            </div>
            <br>
            <span>*Las motos están disponibles solo en tiendas participantes.</span>
        </div>
        <div class="col-md-6 col-12 formulario-crm-rac">
            <p>
           </p>
            <br><br>
            <iframe src="https://formulario.rac.mx/formularios/motos"></iframe>
        </div>
    </div-->

    <div class="mt-5">
        <h2 >¿POR QUÉ OBTENER TU MOTO CON RAC?</h2> 
        Las motocicletas Italika son las motos económicas por excelencia. Con más de 16 años en el mercado, han logrado introducirse en los hogares y negocios mexicanos a tal grado que difícilmente lograrás salir de casa sin ver una de ellas.
        Al adquirir una moto con RAC, te olvidas de las broncas del crédito pues no necesitas tener historial crediticio, no revisamos buró y no te pedimos aval ni enganche. Con RAC te liberas de gastos y engorrosos procesos de emplacado, impuestos y trámites.
        En RAC también sabemos lo importante que es la seguridad para ti, por lo que incluimos un plan de mantenimiento ordinario para la moto.
        Además tendrás todo el control sobre tus gastos pues tu eliges como hacer tus pagos, de manera semanal, quincenal o mensual. No olvides que puedes hacer tuya la moto en el momento que quieras, con un 50% de descuento en tu opción a compra.
        ¿Así o más fácil?

    </div>
   
</section>

<?php get_footer();?>
