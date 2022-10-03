<?php
/**
 * This file contains all the logic related to the custom post "Vacantes"
 * any logic related to this custom post should be added here
 */

function addMetaboxes() {
    add_meta_box(
        'Estado',
        'Estado',
        'estado_meta_box_callback'
    );
    
    add_meta_box(
        'Ciudad',
        'Ciudad',
        'ciudad_meta_box_callback'
    );

    add_meta_box(
        'Sucursal',
        'Sucursal',
        'sucursal_meta_box_callback'
    );
}

function estado_meta_box_callback( $post ) {
    $value = get_post_meta( $post->ID, 'estado', true );
    echo '
        <select name="estado" id="estado_vacante" data-value="' . esc_attr( $value ) . '"></select>
    ';
}

function ciudad_meta_box_callback( $post ) {
    $value = get_post_meta( $post->ID, 'ciudad', true );
    echo '
        <select name="ciudad" id="ciudad_vacante" data-value="' . esc_attr( $value ) . '"></select>
    ';
}

function sucursal_meta_box_callback( $post ) {
    $value = get_post_meta( $post->ID, 'sucursal', true );
    echo '
        <select name="sucursal" id="sucursal_vacante" data-value="' . esc_attr( $value ) . '"></select>
    ';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id
 */
function save_vacantes_meta_box_data( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( isset($post) && get_post_status( $post->ID ) === 'auto-draft' ) {
        return;
    }

    if (count($_POST) <= 0) {
        return;
    }

    // Sanitize user input.
    $estado = sanitize_text_field( $_POST['estado'] );
    $ciudad = sanitize_text_field( $_POST['ciudad'] );
    $sucursal = sanitize_text_field( $_POST['sucursal'] );

    // Update the meta field in the database.
    update_post_meta( $post_id, 'estado', $estado );
    update_post_meta( $post_id, 'ciudad', $ciudad );
    update_post_meta( $post_id, 'sucursal', $sucursal );
}


/**
 * Creates the custom post for "Vacantes"
 */
$argsVacantes = array(
    'public' => true,
    'label'  => 'Vacantes',
    'has_archive' => true,
    'register_meta_box_cb' => 'addMetaboxes',
    'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'),
    'taxonomies'  => array( 'category', 'post_tag'),
    'capability_type' => 'vacante',
    'map_meta_cap'    => true,
);

/**
 * Adds the branches file to the admin
 * Adds the branches logic to set the values into the branches select in the vacantes custom post
 */
function select_sucursales_vacantes() {
	$branches = get_bloginfo('template_directory') . '/js/lista_sucursales-rh.js?v=' . rand();
    $logic = get_bloginfo('template_directory') . '/js/select_sucursales_admin.js';

	echo '"<script type="text/javascript" src="'. $branches . '"></script>"';
    echo '"<script type="text/javascript" src="'. $logic . '"></script>"';
}

/**
 * Allows to read the 'state' and 'type' query vars in wp-content/themes/rac/archive-vacantes.php
 */
function add_get_val() { 
    global $wp; 
    $wp->add_query_var('state');
    $wp->add_query_var('type');
}

add_action('init','add_get_val');
add_action('admin_footer', 'select_sucursales_vacantes');
add_action( 'save_post', 'save_vacantes_meta_box_data' );
register_post_type( 'vacantes', $argsVacantes );

/**
 * Creates a new role for vacantes
 */
remove_role('vacantes_editor');
$capabilitiesForVacantes = array(
    'read' => true,
    'post_vacantes' => true,
    'read_vacantes' => true,
    'publish_vacantes' => true,
    'delete_vacantes' => true,
    'delete_others_vacantes' => true,
    'delete_private_vacantes' => true,
    'delete_published_vacantes' => true,
    'edit_vacantes' => true,
    'edit_others_vacantes' => true,
    'edit_private_vacantes' => true,
    'edit_published_vacantes' => true,
    'read_private_vacantes' => true
);

add_role(
    'vacantes_editor',
    'Editor Vacantes',
    $capabilitiesForVacantes
);

// Set vacantes capabilities to admin role when the url has ?reload_caps=1
if ( is_admin() && '1' == $_GET['reload_caps'] ) {
    $administrator = get_role('administrator');

    foreach ( $capabilitiesForVacantes as $cap => $val) {
        $administrator->add_cap( $cap );
    }
}