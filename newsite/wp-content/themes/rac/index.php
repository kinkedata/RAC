<?php get_header();?>

<section id="home-slider" class="container mt-4 mb-4">
  <div class="row">
      <div class="home-slider  owl-carousel carousel-block">
        <?php
          $args = array(
            'post_type' => 'slider',
            'posts_per_page' => -1
          );
          $sliders = new WP_Query( $args );
          if( $sliders->have_posts() ) :
            while( $sliders->have_posts() ) : $sliders->the_post();

              $thumbIDslider = get_post_thumbnail_id(get_the_ID());
              $imageThumbslider = wp_get_attachment_image_src( $thumbIDslider, 'full' );
              $imagedata = wp_get_attachment($thumbIDslider);
              $externalLink = get_field('link');
              $title = get_post( $post_id )->post_title;
      
              ?>
              
                <div class="item">
                  <?php if( $externalLink != '') : ?>
                    <a href="<?php echo get_field('link');?>" target="_blank" onclick="dataLayer.push({'event': 'slider', 'titulo': '<?php echo $title ?>' });">
                      <img src="<?php echo $imageThumbslider[0]; ?>" alt="<?php echo $imagedata['alt'];?>" title="<?php echo $imagedata['title'];?>">
                    </a>
                  <?php else : ?>
                    <a href="<?php echo get_field('link_para_elemento');?>" onclick="dataLayer.push({'event': 'slider', 'titulo': '<?php echo $title ?>' });">
                      <img src="<?php echo $imageThumbslider[0]; ?>" alt="<?php echo $imagedata['alt'];?>" title="<?php echo $imagedata['title'];?>">
                    </a>
                  <?php endif; ?>
                </div>
            <?php endwhile;
          endif;
          wp_reset_postdata();?>
      </div>        
  </div>
  <div class="row">
  </div>
  <?php // Se ocultó banner de benefios iclude(TEMPLATEPATH . '/benefits-block.php') ?>
     
</section>

<section id="home-categories" class="container mt-0 mb-2">
<h3 class="title-divider text-center">¡El producto que necesitas está aquí!</h3>
      <div class="row justify-content-between">
        <?php include(TEMPLATEPATH . '/categories-block.php') ?>
      </div>
      <div class="row justify-content-between">
          <h4 class="mt-3 text-center home-title-subheader">Descubre lo mejor en electrónica, línea blanca, hogar y motos.</h4>
      </div>
</section>

<section id="" class="container mt-3 mb-4 pt-3 pb-3 product-block shadow">
  <div class="text-center mb-4">
    <h3 class="title-divider">Increíbles smartphones con los mejores beneficios</h3>
    <a href="<?php bloginfo('url');?>/productos/celulares/">Ver más</a>
  </div>

  <div class="carousel-block owl-carousel home-products-slider-block-1">
    <?php 
        $argsProductosblock1 = array(
          'post_type' => 'productos',
          'posts_per_page' => 9,
          'cat'=>11
        );
        $productosblock1 = new WP_Query( $argsProductosblock1 );
        if( $productosblock1->have_posts() ) :
          while( $productosblock1->have_posts() ) : $productosblock1->the_post();

            $thumbIDProducto = get_post_thumbnail_id(get_the_ID());
            $imageThumbsProducto = wp_get_attachment_image_src( $thumbIDProducto, 'full' );
            $imagedata = wp_get_attachment($thumbIDProducto);
            ?>
            <div class="item">
              <div class="product-preview text-center">
                <a href="<?php the_permalink(); ?>">
                  <img src="<?php echo  $imageThumbsProducto[0]; ?>" alt="<?php echo $imagedata['alt'];?>" title="<?php echo $imagedata['title'];?>">
                </a>
                <div style="padding: 0px 5px;" class="product-preview-title">
                  <a href="<?php the_permalink(); ?>">
                    <?php the_title();?>
                  </a>
                  <p style="margin: 10px 0px 0px; font-size: 0.9em">
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
</section>

<section id="" class="container mt-4 mb-4 pt-3 pb-3 product-block shadow">
    <div class="text-center mb-4">
      <h3 class="title-divider">La pantalla de tus sueños sin las broncas del crédito</h3>
      <a href="<?php bloginfo('url');?>/productos/electronicos/pantallas/">Ver más</a>
    </div>

    <div class="carousel-block owl-carousel home-products-slider-block-2">
    <?php 
          $argsProductosblock1 = array(
            'post_type' => 'productos',
            'posts_per_page' => 9,
            'cat'=>8
          );
          $productosblock1 = new WP_Query( $argsProductosblock1 );
          if( $productosblock1->have_posts() ) :
            while( $productosblock1->have_posts() ) : $productosblock1->the_post();

              $thumbIDProducto = get_post_thumbnail_id(get_the_ID());
              $imageThumbsProducto = wp_get_attachment_image_src( $thumbIDProducto, 'full' );
              $imagedata = wp_get_attachment($thumbIDProducto);
              ?>
              <div class="item">
                <div class="product-preview text-center">
                  <a href="<?php the_permalink(); ?>">
                    <img src="<?php echo  $imageThumbsProducto[0]; ?>" alt="<?php echo $imagedata['alt'];?>" title="<?php echo $imagedata['title'];?>">
                  </a>
                  <div style="padding: 0px 5px;" class="product-preview-title">
                    <a href="<?php the_permalink(); ?>">
                      <?php the_title();?>
                    </a>
                    <p style="margin: 10px 0px 0px; font-size: 0.9em">
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
</section>

<section id="" class="container mt-4 mb-4 pt-3 pb-3 product-block shadow">

    <div class="text-center mb-4">
      <h3 class="title-divider">Los mejores refrigeradores sin aval y sin enganche</h3>
      <a href="<?php bloginfo('url');?>/productos/linea-blanca/refrigeradores/">Ver más</a>
    </div>

    <div class="carousel-block owl-carousel home-products-slider-block-3">
    <?php 
          $argsProductosblock1 = array(
            'post_type' => 'productos',
            'posts_per_page' => 9,
            'cat'=>16
          );
          $productosblock1 = new WP_Query( $argsProductosblock1 );
          if( $productosblock1->have_posts() ) :
            while( $productosblock1->have_posts() ) : $productosblock1->the_post();

              $thumbIDProducto = get_post_thumbnail_id(get_the_ID());
              $imageThumbsProducto = wp_get_attachment_image_src( $thumbIDProducto, 'full' );
              $imagedata = wp_get_attachment($thumbIDProducto);
              ?>
              <div class="item">
                <div class="product-preview text-center">
                  <a href="<?php the_permalink(); ?>">
                    <img src="<?php echo  $imageThumbsProducto[0]; ?>" alt="<?php echo $imagedata['alt'];?>" title="<?php echo $imagedata['title'];?>">
                  </a>
                  <div style="padding: 0px 5px;" class="product-preview-title">
                    <a href="<?php the_permalink(); ?>">
                      <?php the_title();?>
                    </a>
                    <p style="margin: 10px 0px 0px; font-size: 0.9em">
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
    
</section>

<?php include(TEMPLATEPATH . '/brands-block.php') ?>


<!-- <?php include(TEMPLATEPATH . '/hr.php') ?> -->


<?php get_footer();?>
