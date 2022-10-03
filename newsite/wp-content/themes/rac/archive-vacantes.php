<?php get_header();?>
<div class="container-fluid">
    <div class="row">
        <img src="<?php echo get_bloginfo('template_url');?>/images/rh/trabaja-en-rac.jpg" alt="" class="w-100">
    </div>
</div>
<div class="col-lg-12">
    <?php include(TEMPLATEPATH . '/breadcrumb.php') ?>
</div>
<section class="container">
  <h1 class="primary-title mt-4 mb-3">Trabaja con nosotros</h1>
  <div class="category-description content-page-description">

  </div>
</section>
<section class="content-page container mt-4 mb-4 pt-4 pb-4 vacantes-page">
    <div class="row">
        <div class="col-12 col-md-9">
            <div class="row">
            <?php
                $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
                $args = array(
                    'post_type' => 'vacantes',
                    'posts_per_page' => -1,
                    'paged' => $paged,
                    'meta_query' => array(
                        'relation' => 'AND'
                    )
                );

                if (get_query_var('state')) {
                    array_push(
                        $args['meta_query'],
                        array(
                            'key'	 	=> 'estado',
                            'value'	  	=> get_query_var('state'),
                            'compare' 	=> '=',
                        )
                    );
                }

                if (get_query_var('type')) {
                    array_push(
                        $args['meta_query'],
                        array(
                            'key'	 	=> 'area_de_negocio',
                            'value'	  	=> get_query_var('type'),
                            'compare' 	=> '=',
                        )
                    );
                }

                $sliders = new WP_Query( $args );
                ?>
                    <div class="col-md-6">
                        <p>Vacantes publicadas: <strong><?php echo $sliders->found_posts; ?></strong></p>
                    </div>
                    
                    <div class="col-md-3">
                        <select class="form-control" id="vacante_type">
                            <option value="" <?php echo get_query_var('type')? '' : 'selected';  ?>>Filtrar por tipo</option>
                            <option value="Choferes" <?php echo get_query_var('type') == 'Choferes'? 'selected' : '';  ?>>Choferes</option>
							<option value="Cobrador en moto" <?php echo get_query_var('type') == 'Cobrador en moto'? 'selected' : '';  ?>>Cobrador en moto</option>
							<option value="Vendedores" <?php echo get_query_var('type') == 'Vendedores'? 'selected' : '';  ?>>Vendedores</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="form-control" id="vacante_state" data-value="<?php echo get_query_var('state')?>">
                            <option value="" selected>Filtrar por estado</option>
                        </select>
                    </div>

                <?php if( $sliders->have_posts() ) : ?>
                    <?php while( $sliders->have_posts() ) : $sliders->the_post(); ?>
                    <div class="col-md-12 col-12 mb-3 mt-3">
                        <div class="shadow p-3 vacantes-preview">
                            <a href="<?php the_permalink(); ?>">
                                <h2 class="vacantes-title mb-0 pb-0">
                                    <?php the_title();?>
                                </h2>
                            </a>
                            <!--div class="vacantes-jornada p-2"><?php echo get_field('jornada_laboral');?></div-->
                            <p class="vacantes-store">Sucursal <?php echo get_field('sucursal');?></p>
                            <p class="vacantes-address p-0 m-0"><?php echo get_field('ciudad');?>, <?php echo get_field('estado');?></p>
                            <p class="vacantes-area p-0  m-0"><?php echo get_field('area_de_negocio');?></p>
                        </div>
                    </div>                    
                    <?php endwhile;
                endif;
                wp_reset_postdata();?>  
            </div>    
        </div>
        <div class="col-12 col-md-3 pt-3">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="shadow p-3 vacantes-rac-module">
                        <h2>Acerca de RAC</h2>
                        <img src="<?php echo get_bloginfo('template_url');?>/images/brand/logo-rac-single.png" alt="" class="w-50" style="margin:auto; display:block;">
                        <p>Tenemos un pensamiento que nos hace el lugar ideal para trabajar. Contamos con una serie de valores y lo que nosotros llamamos “impulsores culturales” los cuales nos guían y recuerdan lo que RAC busca impulsar a sus colaboradores a vivir día a día.</p>
                        <h3>Cultura</h3>
                        <p>En Rac ofrecemos una cultura centrada en nuestra Gente, entusiastas de revivir nuestras fiestas y costumbres y con el ánimo de que se trasmita en todas nuestras ubicaciones.</p>
                        <h3>Valores</h3>
                        <ul>
                            <li>Tener espíritu ganador</li>
                            <li>Actuar con corazón de servicio</li>
                            <li>Traer honor a nuestro equipo</li>
                        </ul>
                        <p><a href="<?php bloginfo('url')?>/conocenos/">Más acerca de RAC México</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<?php get_footer();?>
<script src="<?= get_template_directory_uri(); ?>/js/lista_sucursales-rh.js?v=<?= rand();?>"></script>
<script src="<?= get_template_directory_uri(); ?>/js/buscador_vacantes.js?v=<?= rand();?>"></script>