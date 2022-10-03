<?php 

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
        $videoRecipeLink = get_field('video_link');
    endwhile;
endif;
?>
<div class="col-lg-12">
    <?php include(TEMPLATEPATH . '/breadcrumb.php') ?>
</div>
<section class="container mt-4 content-page pb-4 mb-4 shadow">
    <div class="row">
        <div class="g" >
            <img src="<?php echo $imageThumb;?>" alt="<?php echo $imgAttributes["alt"]?>" title="<?php echo $imgAttributes["title"]?>" class="w-100">
        </div>
    </div>
    <div class="page-content">
        <h1 class="primary-title mb-4"><?php the_title();?></h1>
        <div>
            <?php the_content();?>
        </div>
    </div>

</section>

<?php get_footer();?>
