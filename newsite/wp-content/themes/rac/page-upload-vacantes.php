<?php 
/* Template Name: Upload Vacantes */ 
// ini_set('display_errors',1);
// error_reporting(E_ALL);
get_header();

function createList($text) {
    $list = '<ul>';
    
    foreach(explode('*', $text) as $item) {
        $list .= '<li>' . $item . '</li>';
    }

    $list .= '</ul>';

    return $list;
}

function getAuthorId($email) {
    $user = get_user_by( 'email', trim($email) );
    return $user->ID;
}

if ($_FILES['vacantes']) {
    $uploadPath = '/var/www/html/wordpress/wp-content/uploads/';
    $status = move_uploaded_file($_FILES['vacantes']['tmp_name'], $uploadPath . 'vacantes.csv');

    if ($status) {
        if (($handle = fopen($uploadPath . 'vacantes.csv', 'r')) !== FALSE) { // Check the resource is valid
            $insertedPosts = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Check opening the file is OK!
                $post_id = wp_insert_post(array(
                    'post_type' => 'vacantes',
                    'post_title' => $data[1],
                    'post_content' => $data[2],
                    'post_status' => 'publish',
                    'comment_status' => 'closed',
                    'ping_status' => 'closed',
                    'post_author' => getAuthorId($data[0]),
                    'meta_input' => array(
                        'prestaciones' => createList($data[3]),
                        'requisitos' => createList($data[4]),
                        'suelo_base' => $data[5],
                        'horario_de_trabajo' => $data[6],
                        'area_de_negocio' => $data[7],
                        'jornada_laboral' => 'Tiempo completo',
                        'estado' => $data[8],
                        'ciudad' => $data[9],
                        'sucursal' => $data[10]

                    ),
                ));

                $insertedPosts++;
            }

            echo '<b>Inserted Posts ' . $insertedPosts . '</b>';
            fclose($handle);
        }
    } else {
        echo "¡Error al subir fichero!\n" . $_FILES["vacantes"]["error"];
    }
}
?>
<div class="col-lg-12">
    <form enctype="multipart/form-data" action="" method="post">
        <input type="file" name="vacantes" id="vacantes">
        <input type="submit" value="Enviar" />
    </form>
</div>
<?php get_footer();?>