<?php
/**
 * Logic to add the filters on the list of vacantes in the wordpress admin
 */

/**
 * Returns the vacantes data from the js file parsed to an array
 * NOTE the number 17 in the function is to remove the 'var sucursales = ' from the js file
 * to have a valid json text
 */
function getVacantesData() {
    return get_object_vars(
        json_decode(
            file_get_contents(__DIR__ . '/../js/lista_sucursales-rh.js', true, null, 17)
        )
    );
}

/**
 * Returns an array with the list of the states for the states filter
 */
function getEstados() {
    $values = array();
    $values['Todos los estados'] = '';

    foreach(array_keys(getVacantesData()) as $estado) {
        $values[$estado] = $estado;
    }

    return $values;
}

/**
 * Returns an array with the list of the cities for the city filter
 */
function getCities() {
    $values = array();
    $values['Todas las ciudades'] = '';
    $vacantesData = getVacantesData();
    $state = $_GET['ADMIN_VACANTES_FILTER_ESTADO'];

    foreach(array_keys(get_object_vars($vacantesData[$state])) as $city) {
        $values[$city] = $city;
    }

    return $values;
}

 /**
  * Creates the dropdown for the custom filter with the options for 'estados'
  */
function admin_vacantes_post_estado_filter() {
    $type = 'vacantes';

    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }

    if ('vacantes' == $type) {
        $estados = getEstados();
        ?>
        <select name="ADMIN_VACANTES_FILTER_ESTADO">
        <?php
            $current_v = isset($_GET['ADMIN_VACANTES_FILTER_ESTADO'])? $_GET['ADMIN_VACANTES_FILTER_ESTADO']:'';
            foreach ($estados as $label => $value) {
                printf
                    (
                        '<option value="%s"%s>%s</option>',
                        $value,
                        $value == $current_v? ' selected="selected"':'',
                        $label
                    );
                }
        ?>
        </select>
        <?php
    }
}

/**
 * Modifies the wp query with the 'estados' filter
 */
function vacantes_posts_estado_filter( $query ) {
    global $pagenow;
    $type = 'vacantes';

    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }

    if ('vacantes' == $type && 
        is_admin() && 
        $pagenow=='edit.php' && 
        isset($_GET['ADMIN_VACANTES_FILTER_ESTADO']) && 
        $_GET['ADMIN_VACANTES_FILTER_ESTADO'] != ''
    ) {
        $query->query_vars['meta_key'] = 'estado';
        $query->query_vars['meta_value'] = $_GET['ADMIN_VACANTES_FILTER_ESTADO'];
    }
}

 /**
  * Creates the dropdown for the custom filter with the options for 'ciudades'
  */
  function admin_vacantes_post_ciudad_filter() {
    $type = 'vacantes';

    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }

    if ('vacantes' == $type &&
        isset($_GET['ADMIN_VACANTES_FILTER_ESTADO']) &&
        $_GET['ADMIN_VACANTES_FILTER_ESTADO'] != ''
    ) {
        $cities = getCities();
        ?>
        <select name="ADMIN_VACANTES_FILTER_CIUDAD">
        <?php
            $current_v = isset($_GET['ADMIN_VACANTES_FILTER_CIUDAD'])? $_GET['ADMIN_VACANTES_FILTER_CIUDAD']:'';
            foreach ($cities as $label => $value) {
                printf
                    (
                        '<option value="%s"%s>%s</option>',
                        $value,
                        $value == $current_v? ' selected="selected"':'',
                        $label
                    );
                }
        ?>
        </select>
        <?php
    }
}

/**
 * Modifies the wp query with the 'ciudades' filter
 */
function vacantes_posts_ciudad_filter( $query ) {
    global $pagenow;
    $type = 'vacantes';

    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }

    if ('vacantes' == $type && 
        is_admin() && 
        $pagenow=='edit.php' && 
        isset($_GET['ADMIN_VACANTES_FILTER_CIUDAD']) && 
        $_GET['ADMIN_VACANTES_FILTER_CIUDAD'] != ''
    ) {
        $query->query_vars['meta_key'] = 'ciudad';
        $query->query_vars['meta_value'] = $_GET['ADMIN_VACANTES_FILTER_CIUDAD'];
    }
}

add_action( 'restrict_manage_posts', 'admin_vacantes_post_estado_filter' );
add_filter( 'parse_query', 'vacantes_posts_estado_filter' );
add_action( 'restrict_manage_posts', 'admin_vacantes_post_ciudad_filter' );
add_filter( 'parse_query', 'vacantes_posts_ciudad_filter' );