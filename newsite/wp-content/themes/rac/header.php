<!DOCTYPE html>
<html>
	<head>
		
		<meta charset="UTF-8">
		<?php
		if( is_home() ){
			$resulttitle = get_bloginfo('name');
			$resultdescription = get_bloginfo('description');
			$resultkeywords = '';
			$resultlang = get_bloginfo('url');
		}
		
		elseif( is_post_type_archive('productos') ) {
			$resulttitle = 'Productos con facilidades de pago | RAC México';
			$resultdescription = 'En RAC tenemos todos los productos que necesitas para amueblar tu hogar con las mejores marcas. Contamos con servicio de entrega a domicilio. ¡Descubre más!';
			$resultkeywords = '';
			$resultlang = get_post_type_archive_link('productos');
		}
		elseif(is_category() || is_archive() ){
			$resulttitle = get_field('metatitle');
			$resultdescription = get_field('metadescription');
			$resultkeywords = get_field('keywords');
			//$resultlang = curPageURL();
		}
		else{
			if( have_posts() ) :
				while( have_posts() ) :
					the_post();
					$resulttitle = get_field('metatitle');
					$resultdescription = get_field('metadescription');
					$resultkeywords = get_field('keywords');
					$resultlang = get_permalink();
					$thumbID = get_post_thumbnail_id(get_the_ID());
					$imageThumb = wp_get_attachment_image_src( $thumbID, 'full' );
				endwhile;
			endif;
		}
		$metatitle = $resulttitle;
		$metadescription = $resultdescription;
		$metakeywords = $resultkeywords;
		$metalang = $resultlang;
		?>
		<title><?php echo $metatitle;?></title>
		<!-- Facebook tagging -->
		<meta property="fb:app_id" content=""/>
		<meta property="og:type"   content="website" />
		<meta property="og:url"    content="<?php bloginfo('url')?>" />
		<meta property="og:title"  content="<?php echo $metatitle;?>"/>
		<meta property="og:image"  content="" />
		<meta property="og:description"  content="<?php echo $metadescription;?>"/>
		<!-- End of facebook tagging -->
		<?php if( is_post_type_archive('vacantes') || is_singular('vacantes') ) : ?>
			<meta name="robots" content="noindex">
		<?php endif; ?>
		<link rel="icon" type="image/png" href="<?php bloginfo('template_url')?>/images/brand/rac-icon.png" />
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
		<meta name="description" content="<?php echo $metadescription;?>">
		<meta name="keywords" content="<?php echo $metakeywords;?>">
		<link rel="canonical" href="<?php echo $metalang;?>"/>
		<link rel="preconnect" href="https://fonts.googleapis.com"> 
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
		<link href="https://fonts.googleapis.com/css2?family=Lato:ital@0;1&display=swap" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url');?>/css/bootstrap.min.css">
		<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url');?>/css/generals.css">

		<link rel="alternate" hrefLang="x-default" href="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" />
		<link rel="alternate" hrefLang="es-mx" href="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" />

		<?php if( is_home() ) : ?>
			<link rel="alternate" hrefLang="en-us" href="https://www.rentacenter.com/en" />
			<link rel="alternate" hrefLang="es-us" href="https://www.rentacenter.com/es" />
		<?php endif; ?>

		<meta name="google-site-verification" content="z5dpl_4sOiMG3TwqannO9CI3hVwrUWjarUKNL3ywUhs" />
		<meta name="facebook-domain-verification" content="r54u4tvb8i42jeaufw4d3rclw8p19g" />

		<!--[if IE 6]>
			<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url');?>/css/ie6.css">
		<![endif]-->
		<!--[if IE 7]>
			<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url');?>/css/ie7.css">
		<![endif]-->
		 <!--[if IE 8]>
			<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url');?>/css/ie8.css">
		<![endif]-->
		<!--[if IE 9]>
			<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url');?>/css/ie9.css">
		<![endif]-->
		<script>
			function custom_trim(string, replace){
				while(string.charAt(0)==replace){ string = string.substring(1); }
				while(string.charAt(string.length-1)==replace){ string = string.substring(0,string.length-1); }
				return string;
			}
			const SITE_URL = custom_trim('<?= site_url(); ?>', '/') + '/'; 
			const THEME_URL = custom_trim('<?= get_template_directory_uri(); ?>', '/') + '/'; 
			function site_url(url){ return SITE_URL + custom_trim(url, '/');}
			function theme_url(url){ return THEME_URL + custom_trim(url, '/');}
		</script>
		<?php wp_head(); ?>
		<?php
			$postObject = get_queried_object();
			$reachSnippet = get_field('rich_snippet', $postObject);
			echo $reachSnippet;
		?>
		<?php if( is_home() ): ?>
			<script type='application/ld+json'>
				{
					"@context": "http://schema.org",
					"@type": "Organization",
					"brand": "RAC",
					"name": "RAC La mejor forma de comprar",
					"url": "https://www.rac.mx/",
					"logo": "https://www.rac.mx/wp-content/themes/rac/images/brand/logo-rac.png",
					"sameAs": [
						"https://www.facebook.com/racmx",
						"https://www.facebook.com/RAC-La-mejor-forma-de-comprar-108862915122546/",
						"https://es.wikipedia.org/wiki/Rent-A-Center"
					],
					"alternateName": "Rac México",
					"contactPoint": {
						"@type": "ContactPoint",
						"telephone": " (+52)800 722 4636",
						"contactType": "sales",
						"areaServed": "MX",
						"availableLanguage": "Spanish"
					}
				}
			</script>
		<?php endif; ?>
	</head>
	<body id="racSite">
	<header id="header">
	<!-- Navbar-->
		<nav class="navbar  top-bar p-0">
			<div class="container-fluid justify-content-between principal-nav">
				<!-- Left elements -->
				<div class="d-flex principal-nav">
				<!-- Brand -->
				<a class="navbar-brand p-0 me-2 mr-0 d-flex align-items-center" href="<?php bloginfo('url');?>">
					
					<img src="<?php bloginfo('template_url')?>/images/brand/logo-rac.png" alt="Logo Rent a Center" title=""/>
					
				</a>
				</div>
				<!-- Left elements -->

				<!-- Center elements -->
				<!-- Search form -->
				<?php get_search_form(); ?>
				<!-- Center elements -->

				<!-- Right elements -->
				<ul class="navbar-nav float-right">
					<li class="nav-item me-3 me-lg-1">
						<a class="visible-md" href="https://www.facebook.com/RAC-La-mejor-forma-de-comprar-108862915122546/" target="_blank"><span class="visible-md">Síguenos en Facebook</span> <i class="fab fa-facebook-f"></i></a>
					</li>
				</ul>
				<!-- Right elements -->
			</div>
		</nav>
		<!-- Navbar -->
		<nav class="navbar navbar-expand-md navbar-light shadow">
			<!-- links toggle -->
			<button class="navbar-toggler order-first" type="button" data-toggle="collapse" data-target="#links" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
			<!-- account toggle -->
			<div class="collapse navbar-collapse" id="links">
				<ul class="navbar-nav ml-auto">
			
				<li class="menu-item dropdown">
					<a href="<?php bloginfo('url');?>/productos/" class="dropdown-toggle nav-link focus" data-toggle="dropdown">Catálogo de productos<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class="menu-item">
							<a href="<?php bloginfo('url');?>/productos/celulares/" class="nav-link">Celulares</a>
						</li>
						<li class="menu-item dropdown dropdown-submenu">
							<a href="<?php bloginfo('url');?>/productos/electronicos/" class="nav-link dropdown-toggle" data-toggle="">Electrónicos</a>
							<ul class="dropdown-menu">
								<li class="menu-item ">
									<a class="nav-link" href="<?php bloginfo('url');?>/productos/electronicos/audifonos/">Audífonos</a>
								</li>
								<li class="menu-item ">
									<a class="nav-link" href="<?php bloginfo('url');?>/productos/electronicos/bocinas/">Bocinas</a>
								</li>
								<li class="menu-item ">
									<a class="nav-link" href="<?php bloginfo('url');?>/productos/electronicos/pantallas/">Pantallas</a>
								</li>
								<li class="menu-item ">
									<a class="nav-link" href="<?php bloginfo('url');?>/productos/electronicos/tablets/">Tablets</a>
								</li>
								<li class="menu-item ">
									<a class="nav-link" href="<?php bloginfo('url');?>/productos/electronicos/videojuegos/">Videojuegos</a>
								</li>
							</ul>
						</li>
						<li class="menu-item">
							<a href="<?php bloginfo('url');?>/productos/laptops/" class="nav-link">Laptops</a>
						</li>
						<li class="menu-item dropdown dropdown-submenu">
							<a href="<?php bloginfo('url');?>/productos/linea-blanca/" class="nav-link dropdown-toggle" data-toggle="">Línea Blanca</a>
							<ul class="dropdown-menu">
								<li class="menu-item ">
									<a class="nav-link" href="<?php bloginfo('url');?>/productos/linea-blanca/clima-y-ventilacion/">Clima y ventilación</a>
								</li>
								<li class="menu-item ">
									<a class="nav-link" href="<?php bloginfo('url');?>/productos/linea-blanca/electrodomesticos/">Electrodomésticos</a>
								</li>
								<li class="menu-item ">
									<a class="nav-link" href="<?php bloginfo('url');?>/productos/linea-blanca/estufas/">Estufas</a>
								</li>
								<li class="menu-item ">
									<a class="nav-link" href="<?php bloginfo('url');?>/productos/linea-blanca/lavadoras/">Lavadoras</a>
								</li>
								<li class="menu-item ">
									<a class="nav-link" href="<?php bloginfo('url');?>/productos/linea-blanca/refrigeradores/">Refrigeradores</a>
								</li>
							</ul>
						</li>
						<li class="menu-item dropdown dropdown-submenu">
							<a href="<?php bloginfo('url');?>/productos/movilidad/" class="nav-link dropdown-toggle" data-toggle="">Movilidad</a>
							<ul class="dropdown-menu">
								<li class="menu-item ">
									<a class="nav-link" href="<?php bloginfo('url');?>/productos/movilidad/bicicletas/">Bicicletas</a>
								</li>
								<li class="menu-item ">
									<a class="nav-link" href="<?php bloginfo('url');?>/motos/">Motos</a>
								</li>
							</ul>
						</li>
						<li class="menu-item dropdown dropdown-submenu">
							<a href="<?php bloginfo('url');?>/productos/muebles/" class="nav-link dropdown-toggle" data-toggle="">Muebles</a>
							<ul class="dropdown-menu">
								<li class="menu-item ">
									<a class="nav-link" href="<?php bloginfo('url');?>/productos/muebles/centro-de-entretenimiento/">Centro de entretenimiento</a>
								</li>
								<li class="menu-item ">
									<a class="nav-link" href="<?php bloginfo('url');?>/productos/muebles/cocinas-alacenas/">Cocinas / Alacenas</a>
								</li>
								<li class="menu-item ">
									<a class="nav-link" href="<?php bloginfo('url');?>/productos/muebles/colchones/">Colchones</a>
								</li>
								<li class="menu-item ">
									<a class="nav-link" href="<?php bloginfo('url');?>/productos/muebles/comedores/">Comedores</a>
								</li>
								<li class="menu-item ">
									<a class="nav-link" href="<?php bloginfo('url');?>/productos/muebles/recamaras/">Recámaras</a>
								</li>
								<li class="menu-item ">
									<a class="nav-link" href="<?php bloginfo('url');?>/productos/muebles/salas/">Salas</a>
								</li>
							</ul>
						</li>
						<li class="menu-item dropdown dropdown-submenu">
							<a href="<?php bloginfo('url');?>/productos/otros/" class="nav-link dropdown-toggle" data-toggle="">Otros</a>
							<ul class="dropdown-menu">
								<li class="menu-item ">
									<a class="nav-link" href="<?php bloginfo('url');?>/productos/otros/herramientas/">Herramientas</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>
					
				</ul>
				<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'principal-menu', 'menu_class' => 'navbar-nav mr-auto') ); ?>
			</div>
		</nav>
	</header>
