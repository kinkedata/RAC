<?php 
/* Template Name: Promociones */ 
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
    <h1 class="primary-title mt-4"><?php the_title();?></h1>
    <div class="category-description content-page-description font-size-mb-1 d-none d-sm-block">
        <?php the_content(); ?>
    </div>
</section>
<section class="container mt-4 mb-4 pb-4 pt-4 content-page shadow">
    <!--div class="row">
        <img src="<?php echo $imageThumb;?>" alt="<?php echo $imgAttributes["alt"]?>" title="<?php echo $imgAttributes["title"]?>" class="w-100">
    </div-->
    <div class="row row-flex">
    <?php
    $argsPromos = array(
    'post_type' => 'promocion',
    'posts_per_page' => -1
    );
    $promociones = new WP_Query( $argsPromos );
    if( $promociones->have_posts() ) :
        while( $promociones->have_posts() ) :
            $promociones->the_post();
            $thumbID = get_post_thumbnail_id(get_the_ID());
            $imageThumb = wp_get_attachment_image_src( $thumbID, 'full' );
            $imageThumb = $imageThumb[0];
            $attachment_meta = wp_get_attachment($thumbID);
            $imgAttributes["alt"] = $attachment_meta["alt"];
            $imgAttributes["title"] = $attachment_meta["title"]; ?>

            <div class="col-md-6 col-12 mb-4">
                <div class="promotion shadow p-4">
                    <img src="<?php echo $imageThumb;?>" alt="<?php echo $imgAttributes["alt"]?>" title="<?php echo $imgAttributes["title"]?>" class="w-100 mt-1">
                    <hr>
                    <p class=""><?php the_content();?></p>
                </div>
            </div>

        <?php
        endwhile;
    endif;
    ?>
    </div>

    <div class="clearfix">

    </div>
    <a class="general-button btn btn-secondary mr-auto ml-auto mx-auto d-inline-block" href="<?php bloginfo('url')?>/terminos-legales-de-promociones/">Términos y condiciones</a>
</section>
<div class="container d-block d-sm-none">
    <div class="category-description content-page-description font-size-mb-1">
        <?php the_content(); ?>
    </div>
</div>

<?php get_footer();?>
