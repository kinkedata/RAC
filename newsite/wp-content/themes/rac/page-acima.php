<?php 
/* Template Name: Acima */ 
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
  <h1 class="primary-title mt-4 mb-3"><?php the_title();?></h1>
  <div class="category-description content-page-description">
    <?php the_content(); ?>
    </div>
</section>
<section class="container mt-4 content-page decorative-page product-grid pb-4 mb-4">
    <img class="w-100" src="<?php bloginfo('template_url');?>/images/acima/header-acima.jpeg" alt="" />
    <img  class="w-100"src="<?php bloginfo('template_url');?>/images/acima/info-acima-nueva-min.jpeg" alt="" />
    
    <a href="https://www.facebook.com/acimamexico " target="_blank">
        <img class="w-100" src="<?php bloginfo('template_url');?>/images/acima/facebook-acima-min.jpeg" alt="" />
    </a>

    <img  class="w-100"src="<?php bloginfo('template_url');?>/images/acima/acima-titulo-modulos.jpeg" alt="" />


<div class="element-pl">
<a href="https://www.alamomuebles.com/contacto/" target="_blank">
<img src="<?php bloginfo('template_url');?>/images/acima/alamo-acima_1.jpeg" alt="" />
</a>
<div class="listado-acima">
<ul>
<li><a href="https://api.whatsapp.com/send?phone=+5213318934665&text=Bienvenido%20a%20Acima%20Leasing,%20m%C3%B3dulo%20%C3%81lamo%20Muebles,%20deja%20tu%20mensaje%20para%20solicitar%20informaci%C3%B3n.
" target="_blank">Tlaquepaque</a></li>
<li><a href="https://api.whatsapp.com/send?phone=+5218331185478&text=Bienvenido%20a%20Acima%20Leasing,%20m%C3%B3dulo%20%C3%81lamo%20Muebles,%20deja%20tu%20mensaje%20para%20solicitar%20informaci%C3%B3n." target="_blank">Zapopan</a></li>
</ul>
</div>
<a href="https://www.alamomuebles.com/contacto/" target="_blank">
<img src="<?php bloginfo('template_url');?>/images/acima/boton-acima.jpeg" alt="" />
</a>
</div>

<div class="element-pl">

<a href="https://standard.mstd.mx/tiendas" target="_blank">
<img src="<?php bloginfo('template_url');?>/images/acima/standard-acima.jpeg" alt="" />
</a>
<div class="listado-acima">
<ul>
<li><a href="https://api.whatsapp.com/send?phone=+5218134041021&text=Bienvenido%20a%20Acima%20Leasing,%20m%C3%B3dulo%20Muebler%C3%ADa%20Standard,%20deja%20tu%20mensaje%20para%20solicitar%20informaci%C3%B3n." target="_blank">Madero</a></li>
<li><a href="https://api.whatsapp.com/send?phone=+5218134041068&text=Bienvenido%20a%20Acima%20Leasing,%20m%C3%B3dulo%20Muebler%C3%ADa%20Standard,%20deja%20tu%20mensaje%20para%20solicitar%20informaci%C3%B3n." target="_blank">San Nicolás</a></li>
<li><a href="https://api.whatsapp.com/send?phone=+5218134041031&text=Bienvenido%20a%20Acima%20Leasing,%20m%C3%B3dulo%20Muebler%C3%ADa%20Standard,%20deja%20tu%20mensaje%20para%20solicitar%20informaci%C3%B3n." target="_blank">Saltillo</a></li>
</ul>
</div>
<a href="https://standard.mstd.mx/tiendas" target="_blank">
<img src="<?php bloginfo('template_url');?>/images/acima/boton-acima.jpeg" alt="" />
</a>

</div>

<div class="element-pl">
<a href="https://santamariamueblerias.com/pages/sucursales-1" target="_blank">

<img src="<?php bloginfo('template_url');?>/images/acima/santa-maria-acima.jpeg" alt="" />

</a>
<div class="listado-acima">
<ul>
<li><a href="https://api.whatsapp.com/send?phone=+5218443505495&text=Bienvenido%20a%20Acima%20Leasing,%20m%C3%B3dulo%20Santa%20Mar%C3%ADa%20Muebler%C3%ADas,%20deja%20tu%20mensaje%20para%20solicitar%20informaci%C3%B3n." target="_blank">Miramar</a></li>
<li><a href="https://api.whatsapp.com/send?phone=+5218443505503&text=Bienvenido%20a%20Acima%20Leasing,%20m%C3%B3dulo%20Santa%20Mar%C3%ADa%20Muebler%C3%ADas,%20deja%20tu%20mensaje%20para%20solicitar%20informaci%C3%B3n." target="_blank">Tlajomulco</a></li>
<li><a href="https://api.whatsapp.com/send?phone=+5218134041024&text=Bienvenido%20a%20Acima%20Leasing,%20m%C3%B3dulo%20Santa%20Mar%C3%ADa%20Muebler%C3%ADas,%20deja%20tu%20mensaje%20para%20solicitar%20informaci%C3%B3n." target="_blank">Santa Fe</a></li>
<li><a href="https://api.whatsapp.com/send?phone=+5218331185106&text=Bienvenido%20a%20Acima%20Leasing,%20m%C3%B3dulo%20Santa%20Mar%C3%ADa%20Muebler%C3%ADas,%20deja%20tu%20mensaje%20para%20solicitar%20informaci%C3%B3n." target="_blank">Pueblito</a></li>
<li><a href="https://api.whatsapp.com/send?phone=+5218331839079&text=Bienvenido%20a%20Acima%20Leasing,%20m%C3%B3dulo%20Santa%20Mar%C3%ADa%20Muebler%C3%ADas,%20deja%20tu%20mensaje%20para%20solicitar%20informaci%C3%B3n." target="_blank">Agua Blanca</a></li>
<li><a href="https://api.whatsapp.com/send?phone=+5218134041033&text=Bienvenido%20a%20Acima%20Leasing,%20m%C3%B3dulo%20Santa%20Mar%C3%ADa%20Muebler%C3%ADas,%20deja%20tu%20mensaje%20para%20solicitar%20informaci%C3%B3n." target="_blank">Paraíso</a></li>
<li><a href="https://api.whatsapp.com/send?phone=+5218771016436&text=Bienvenido%20a%20Acima%20Leasing,%20m%C3%B3dulo%20Santa%20Mar%C3%ADa%20Muebler%C3%ADas,%20deja%20tu%20mensaje%20para%20solicitar%20informaci%C3%B3n." target="_blank">Sayula</a></li>
</ul>
</div>
<a href="https://santamariamueblerias.com/pages/sucursales-1" target="_blank">

<img src="<?php bloginfo('template_url');?>/images/acima/boton-acima.jpeg" alt="" />

</a>
</div>
<!--div class="element-pl">
<a href="http://www.lasubastamueblerias.com/inicio.html" target="_blank">

<img src="<?php bloginfo('template_url');?>/images/acima/subasta-acima_1.jpeg" alt="" />

</a>
<div class="listado-acima">
<ul>
<li><a href="https://api.whatsapp.com/send?phone=+5218331195162&text=Bienvenido%20a%20Acima%20Leasing,%20m%C3%B3dulo%20La%20Subasta%20Muebler%C3%ADas,%20deja%20tu%20mensaje%20para%20solicitar%20informaci%C3%B3n." target="_blank">Guadalupe</a></li>
<li><a href="https://api.whatsapp.com/send?phone=+5218331193560&text=Bienvenido%20a%20Acima%20Leasing,%20m%C3%B3dulo%20La%20Subasta%20Muebler%C3%ADas,%20deja%20tu%20mensaje%20para%20solicitar%20informaci%C3%B3n." target="_blank">Lincoln</a></li>
<li><a href="https://api.whatsapp.com/send?phone=+5218331192774&text=Bienvenido%20a%20Acima%20Leasing,%20m%C3%B3dulo%20La%20Subasta%20Muebler%C3%ADas,%20deja%20tu%20mensaje%20para%20solicitar%20informaci%C3%B3n." target="_blank">Apodaca</a></li>
<li><a href="https://api.whatsapp.com/send?phone=+5218443505496&text=Bienvenido%20a%20Acima%20Leasing,%20m%C3%B3dulo%20La%20Subasta%20Muebler%C3%ADas,%20deja%20tu%20mensaje%20para%20solicitar%20informaci%C3%B3n." target="_blank">Juárez</a></li>
<li><a href="https://api.whatsapp.com/send?phone=+5218683675152&text=Bienvenido%20a%20Acima%20Leasing,%20m%C3%B3dulo%20La%20Subasta%20Muebler%C3%ADas,%20deja%20tu%20mensaje%20para%20solicitar%20informaci%C3%B3n." target="_blank">San Nicolás</a></li>
<li><a href="https://api.whatsapp.com/send?phone=+5218331208494&text=Bienvenido%20a%20Acima%20Leasing,%20m%C3%B3dulo%20La%20Subasta%20Muebler%C3%ADas,%20deja%20tu%20mensaje%20para%20solicitar%20informaci%C3%B3n." target="_blank">Santa Catarina</a></li>
</ul>
</div>
<a href="http://www.lasubastamueblerias.com/inicio.html" target="_blank">

<img class="w-100" src="<?php bloginfo('template_url');?>/images/acima/boton-acima.jpeg" alt="" />

</a>

</div-->

<img class="w-100" src="<?php bloginfo('template_url');?>/images/acima/whatapp.jpeg" alt="" />

</div>

</section>



<style type="text/css">
.element-pl{
width:33.3%;
float:left;
text-align:center;
}

#marcas{
display:none !important;
}

.listado-acima{
min-height: 180px;
text-align:center;
}

.listado-acima ul {
padding-left:0;
}

.listado-acima li {
display:block;
margin-bottom:0;
}

.listado-acima li a{
display:block;
color:#000;
font-size:18px;
}
</style>




   

    

    
   
</section>

<?php get_footer();?>
