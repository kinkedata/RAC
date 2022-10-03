<?php 
/* Template Name: Marcas */ 
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
<h1 class="primary-title mt-4">¡Y con las mejores marcas!</h1>
<div class="category-description content-page-description">
    <?php the_content(); ?>
</div>
</section>
<section class="container mt-4 content-page pb-4 pt-4 mb-4 decorative-page shadow">
   
    
    <div class="row row-flex brands-grid">
        <div class="col-md-2">
            <div>
                <img src="<?php bloginfo('template_url')?>/images/brands/1_0000_infocus-logo-png-transparent.png" alt="">
            </div>
        </div>
        <div class="col-md-2">
            <div>
                <img src="<?php bloginfo('template_url')?>/images/brands/1_0000_ZTE.png" alt="">
            </div>
            
        </div>
        <div class="col-md-2">
            <div>
                <img src="<?php bloginfo('template_url')?>/images/brands/1_0001_1529545790.png" alt="">
            </div>
        </div>
        <div class="col-md-2">
            <div>
                <img src="<?php bloginfo('template_url')?>/images/brands/1_0001_XboxOne.png" alt="">
            </div>
        </div>
        <div class="col-md-2">
            <div>
                <img src="<?php bloginfo('template_url')?>/images/brands/1_0002_sansui-logo-png-transparent.png" alt="">
            </div>
        </div>
        <div class="col-md-2">
            <div>
                <img src="<?php bloginfo('template_url')?>/images/brands/1_0002_Whirlpool.png" alt="">
            </div>
        </div>

    </div>    
    <div class="row row-flex brands-grid">
        <div class="col-md-2">
           <div>
            <img src="<?php bloginfo('template_url')?>/images/brands/1_0003_logotipo.png" alt="">
           </div>
        </div>
        <div class="col-md-2">
            <div>
                <img src="<?php bloginfo('template_url')?>/images/brands/1_0004_SpringAir.png" alt="">
            </div>
        </div>
        <div class="col-md-2">
            <div>
                <img src="<?php bloginfo('template_url')?>/images/brands/1_0006_Serta.png" alt="">
            </div>
        </div>
        <div class="col-md-2">
            <div>
                <img src="<?php bloginfo('template_url')?>/images/brands/1_0007_Samsung.png" alt="">
            </div>
        </div>
        <div class="col-md-2">
            <div>
                <img src="<?php bloginfo('template_url')?>/images/brands/1_0008_QFX.png" alt="">
            </div>
        </div>
        <div class="col-md-2">
            <div>
                <img src="<?php bloginfo('template_url')?>/images/brands/1_0009_Motorola.png" alt="">
            </div>
        </div>
    </div>

    <div class="row row-flex brands-grid">
        <div class="col-md-2">
            <div>
                <img src="<?php bloginfo('template_url')?>/images/brands/1_0011_Mabe.png" alt="">
            </div>
        </div>
        <div class="col-md-2">
            <div>
                <img src="<?php bloginfo('template_url')?>/images/brands/1_0012_LG.png" alt="">
            </div>
        </div>
        <div class="col-md-2">
            <div>
                <img src="<?php bloginfo('template_url')?>/images/brands/1_0014_Huawei.png" alt="">
            </div>
        </div>
        <div class="col-md-2">
            <div>
                <img src="<?php bloginfo('template_url')?>/images/brands/1_0015_HP.png" alt="">
            </div>
        </div>
        <div class="col-md-2">
           <div>
                <img src="<?php bloginfo('template_url')?>/images/brands/1_0016_Hisense.png" alt="">
           </div>
        </div>
        <div class="col-md-2">
            <div>
                <img src="<?php bloginfo('template_url')?>/images/brands/1_0022_Acros.png" alt="">
            </div>
        </div>


    </div>
    
    <div class="row row-flex brands-grid">
        <div class="col-md-2">
            <div>
                <img src="<?php bloginfo('template_url')?>/images/brands/1_0023_Acer.png" alt="">
            </div>
        </div>
        <div class="col-md-2">
            <div>
                <img src="<?php bloginfo('template_url')?>/images/brands/Logo_Hyundai.png" alt="">
            </div>
        </div>  
    </div>

        

    </div>
    

</section>

<?php get_footer();?>
