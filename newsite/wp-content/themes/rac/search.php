<?php 
    get_header();

    function list_searcheable_acf(){
        $list_searcheable_acf = array("descripcion_corta", "sku");
        return $list_searcheable_acf;
    }

    function advanced_custom_search( $where, $wp_query ) {
        global $wpdb;
    
        if ( empty( $where ))
            return $where;
    
        // get search expression
        $terms = $wp_query->query_vars[ 's' ];
    
        // explode search expression to get search terms
        $exploded = explode( ' ', $terms );
        if( $exploded === FALSE || count( $exploded ) == 0 )
            $exploded = array( 0 => $terms );
    
        // reset search in order to rebuilt it as we whish
        $where = '';
    
        // get searcheable_acf, a list of advanced custom fields you want to search content in
        $list_searcheable_acf = list_searcheable_acf();
        foreach( $exploded as $tag ) :
            $where .= "
              AND " . $wpdb->posts . ".post_type = 'productos' 
              AND " . $wpdb->posts . ".post_status = 'publish' 
              AND (
                (" . $wpdb->posts . ".post_title LIKE '%$tag%')
                OR (" . $wpdb->posts . ".post_content LIKE '%$tag%')
                OR EXISTS (
                  SELECT * FROM wpracsite_postmeta
                      WHERE post_id = " . $wpdb->posts . ".ID
                        AND (";
            foreach ($list_searcheable_acf as $searcheable_acf) :
                if ($searcheable_acf == $list_searcheable_acf[0]):
                    $where .= " (meta_key LIKE '%" . $searcheable_acf . "%' AND meta_value LIKE '%$tag%') ";
                else :
                    $where .= " OR (meta_key LIKE '%" . $searcheable_acf . "%' AND meta_value LIKE '%$tag%') ";
                endif;
            endforeach;
            $where .= ")
                )
                OR EXISTS (
                  SELECT * FROM wpracsite_comments
                  WHERE comment_post_ID = " . $wpdb->posts . ".ID
                    AND comment_content LIKE '%$tag%'
                )
                OR EXISTS (
                  SELECT * FROM wpracsite_terms
                  INNER JOIN wpracsite_term_taxonomy
                    ON wpracsite_term_taxonomy.term_id = wpracsite_terms.term_id
                  INNER JOIN wpracsite_term_relationships
                    ON wpracsite_term_relationships.term_taxonomy_id = wpracsite_term_taxonomy.term_taxonomy_id
                  WHERE (
                      taxonomy = 'post_tag'
                        OR taxonomy = 'category'
                        OR taxonomy = 'myCustomTax'
                      )
                      AND object_id = " . $wpdb->posts . ".ID
                      AND wpracsite_terms.name LIKE '%$tag%'
                )
            )";
        endforeach;
        return $where;
    }
    
?>
<div class="col-lg-12">
    <?php include(TEMPLATEPATH . '/breadcrumb.php') ?>
</div>
<section class="container">
    <h1 class="primary-title mt-4">Resultados de tu búsqueda sobre: "<?php echo get_query_var('s'); ?>"</h1>
    <div class="category-description content-page-description">
        <?php echo category_description();?>
    </div>
</section>
<section class="container product-page product-grid mt-4 mb-4 pb-4 shadow">
    <div class="row">
        <div class="col-12 col-md-12 pt-3">
            <div class="row">
                <?php
                    add_filter( 'posts_where', 'advanced_custom_search', 500, 2 );
                    $s=get_search_query();
                    $args = array(
                        's' => $s
                    );
                    $the_query = new WP_Query( $args );
                    remove_filter( 'posts_where', 'advanced_custom_search', 500 );
                    if ( $the_query->have_posts() ) : ?>
                        <?php while( $the_query->have_posts() ) :
                            $the_query->the_post();
                            $thumbID = get_post_thumbnail_id(get_the_ID());
                            $imageThumb = wp_get_attachment_image_src( $thumbID, 'full' );
                            $attachment_meta = wp_get_attachment($thumbID);
                            $presentacion = get_field('presentacion_centrada'); ?>
                                <div class="col-6 col-md-4">
                                    <div class="product-preview">
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
                                    <?php if(get_post_type() == 'productos'): ?>
                                        <div class="">
                                            Desde $<?php echo get_field('precio_semanal');?> semanales
                                        </div>
                                    <?php endif; ?>
                                    </div>
                                </div>    
                            <?php endwhile;
                    else : ?>
                        <div class="col-12 col-md-12">
                            <h2>Lo sentimos</h2>
                            <p>No encontramos lo que estás búscando. Te invitamos a visitar nuestro catálogo de productos.</p>
                        </div>
                <?php endif;
                wp_reset_postdata();?>
            </div>    
        </div>
    </div>
</section>
<?php get_footer();?>