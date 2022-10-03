<div class="p-1 breadcrumbs  container mt-4">
<?php
function breadcrumbs() {
	$url = get_bloginfo('url');
	$a = explode("/",$url);
	$b = explode("/",$_SERVER["REQUEST_URI"]);
	//intersección de arrays para poder quitar la URL
	$c = array_intersect($a, $b);
	$url_array = array_diff($b, $c);
	//quitamos el nombre del post del array
	array_pop($url_array);
	//para quitar las "/page/2"
	if(preg_match('@(/page/)([0-9])@',$_SERVER["REQUEST_URI"])) {
		array_pop($url_array); //quitamos sacar el "/2"
		array_pop($url_array); //quitamos sacar el "/page"
	}
	//para quitar los comentarios "/coment-page-"
	if(preg_match('/comment-page-/',$_SERVER["REQUEST_URI"]) || preg_match('/?/',$_SERVER["REQUEST_URI"])) {
		//sacamos el post ya que ya sacamos el comentario
		array_pop($url_array);
	}
	echo '<a href="'.$url.'/" rel="home">Inicio</a>';
	$dir = $url.'/';
	if( is_singular('productos') ){
		echo ' &raquo; <a href="'.$url.'/productos">Productos</a>';
	}
	elseif( is_singular('recetas') ){
		echo ' &raquo; <a href="'.$url.'/recetas">Recetas</a>';
	}
	elseif(is_category()) {
		//algoritmo para single.php
		$category = '';
		foreach($url_array as $folder) {
			if($folder != 'category'){
				$category .= $folder;
				//hay confusion con las categorias hijos
				$dir = $url.'/'.$category.'/';
				//con URL para que jale del URL al que pertenece
				echo ' &raquo; <a href="'.$dir.'" rel="category tag">'.ucwords(str_replace("-", " ", $folder)) . '</a>';
			}
		}
	}
	else {
		//para page.php y otros (archivos)
		foreach($url_array as $folder) {
			if($folder != 'tag' && $folder != 'author'){
				if(!is_numeric($folder)){
					$dir = $dir.$folder.'/';//los folders se van acoplando
					echo ' &raquo; <a href="'.$dir.'">'.ucwords(str_replace("-", " ", $folder)) . '</a>';
				}
			}
		}
	}
	echo wp_title();
}
breadcrumbs();
?>
</div>
