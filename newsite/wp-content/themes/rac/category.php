<?php 
/**
* The template for displaying Category pages
*/
get_header(); ?>
<div class="col-lg-12">
    <?php include(TEMPLATEPATH . '/breadcrumb.php') ?>
</div>
<section class="container">
<h1 class="primary-title mt-4"><?php single_cat_title(); ?></h1>
<div class="category-description content-page-description font-size-mb-1 d-none d-sm-block">
    <?php echo category_description();?>
</div>
</section>
<section class="container product-page product-grid mt-4 mb-4 pb-4 shadow">
    <div class="row">
        <div class="col-12 col-md-3 pt-3 d-none d-md-block">
            <?php include(TEMPLATEPATH . '/filters.php') ?>
        </div>
        <div class="col-12 col-md-9 pt-3">
            <div class="row">
            <?php
                $category = get_queried_object();
                $category->term_id;
                $argsCatPost = array(
                'post_type' => 'productos',
                'paged' => $paged,
                'orderby' => 'date',
                'posts_per_page' => -1,
                'cat'=>$category->term_id
                );
                $catProducts = new WP_Query( $argsCatPost );
                while( $catProducts->have_posts() ) :
                    $catProducts->the_post();
                    $thumbID = get_post_thumbnail_id(get_the_ID());
                    $imageThumb = wp_get_attachment_image_src( $thumbID, 'full' );
                    $attachment_meta = wp_get_attachment($thumbID);
                    $presentacion = get_field('presentacion_centrada'); ?>
                        <div class="col-6 col-md-4">
                            <div class="product-preview text-center">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo  $imageThumb[0]; ?>" alt="<?php echo $imagedata['alt'];?>" title="<?php echo $imagedata['title'];?>" class="w-100">
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
                wp_reset_postdata();?>
            </div>    
        </div>
    </div>
</section>
<div class="container d-block d-sm-none">
    <div class="category-description content-page-description font-size-mb-1">
        <?php echo category_description();?>
    </div>
</div>
<?php get_footer();?>