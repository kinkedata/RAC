<?php
// Thumbnails Support
add_theme_support( 'post-thumbnails' );

//Menu Support
function register_my_menus() {
		register_nav_menus(
			array(
				'principal-menu' => __( 'Principal Menu' ),
			)
		);
		register_nav_menus(
			array(
				'principal-footer1' => __( 'Footer Información 1' ),
			)
		);
		register_nav_menus(
			array(
				'principal-footer2' => __( 'Footer Información 2' ),
			)
		);
	}
	add_action( 'init', 'register_my_menus' );

	// Add Clases to li on Menu

	function add_classes_on_li($classes, $item, $args) {
		$classes[] = 'nav-item';
		return $classes;
	}
	add_filter('nav_menu_css_class','add_classes_on_li',1,3);

	//Add Clases to a on Menu

	function add_menuclass($ulclass) {
		return preg_replace('/<a /', '<a class="nav-link"', $ulclass);
 }
add_filter('wp_nav_menu','add_menuclass');

 function codex_custom_init() {
    $argsSliders = array(
      'public' => true,
      'label'  => 'Sliders',
			'has_archive' => true,
			'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'),
			'taxonomies'  => array( 'category', 'post_tag')
    );
	register_post_type( 'slider', $argsSliders );
	
	$argsProducts = array(
		'public' => true,
		'label'  => 'Productos',
			  'has_archive' => true,
			  'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'),
			  'taxonomies'  => array( 'category', 'post_tag')
	  );
	  register_post_type( 'productos', $argsProducts );
	}

	$argsPromos = array(
		'public' => true,
		'label'  => 'Promociones',
			  'has_archive' => true,
			  'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'),
			  'taxonomies'  => array( 'category', 'post_tag')
	  );
	  register_post_type( 'promocion', $argsPromos );

add_action( 'init', 'codex_custom_init' );

function wp_get_attachment( $attachment_id ) {

	$attachment = get_post( $attachment_id );
		return array(
				'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
				'title' => $attachment->post_title
		);
}


add_filter('use_block_editor_for_post_type', '__return_false', 100);

require('library/vacantes_custom_post.php');
require('library/vacantes_admin_filters.php');
?>
