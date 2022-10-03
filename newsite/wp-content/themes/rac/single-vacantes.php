<?php get_header();?>
<div class="container-fluid">
    <div class="row">
        <img src="<?php echo get_bloginfo('template_url');?>/images/rh/trabaja-en-rac.jpg" alt="" class="w-100">
    </div>
</div>
<div class="col-lg-12">
    <?php include(TEMPLATEPATH . '/breadcrumb.php') ?>
</div>
<section class="container">
  
</section>
<section class="content-page container mt-4 mb-4 pt-4 pb-4 vacantes-page single">
    <div class="row">
        <div class="col-12 col-md-9 pt-0">
            <div class="row">
                <div class="col-md-12 col-12 mb-3">
                    <div class="">
                        <h1 class="primary-title mb-0"><?php the_title();?></h1>
                        <p class="vacantes-store mb-2">Sucursal <?php echo get_field('sucursal');?></p>
                        <p class="vacantes-address p-0 m-0"><?php echo get_field('ciudad');?>, <?php echo get_field('estado');?></p>
                        <p class="vacantes-area p-0  m-0"><?php echo get_field('area_de_negocio');?></p>
                    </div>
                </div>                    
            </div>
            <div class="row">
                <div class="col-md-12 col-12 mb-3">
                    <div class="">
                        <h4 class="mb-1">Descripción de la vacante</h4>
                        <?php the_content();?>
                    </div>
                </div>                    
            </div> 
            <div class="row">
                <div class="col-md-6 col-12 mb-3">
                    <div class="">
                        <h4 class="mb-1">Prestaciones y beneficios</h4>
                        <?php echo get_field('prestaciones');?>
                    </div>
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <div class="">
                        <h4 class="mb-1">Requisitos</h4>
                        <?php echo get_field('requisitos');?>
                    </div>
                </div>                    
            </div>      
            <div class="row">
				<?php if( get_field('suelo_base') ) {?>
                <div class="col-md-6 col-12 mb-3">
                    <div class="">
                        <h4 class="mb-1">Sueldo base</h4>
                        <p>$<?php echo get_field('suelo_base');?></p>
                    </div>
                </div>
				<?php } ?>     
                <div class="col-md-6 col-12 mb-3">
                    <div class="">
                        <h4 class="mb-1">Horario de trabajo</h4>
                        <p><?php echo get_field('horario_de_trabajo');?></p>
                    </div>
                </div>               
            </div>
            <?php 
            
            $author_id=$post->post_author; 
            $customUserV = "user_" . $author_id;
            ?>
            <?php if(get_field('numero_telefonico', $customUserV) ) : ?>
            <div class="contact-data p-3">
                <p>Para más información contacta a <?php echo the_author_meta( 'display_name' , $author_id ); ?> al <a href="tel:<?php echo get_field('numero_telefonico', $customUserV);?>"><?php echo get_field('numero_telefonico', $customUserV);?></a></p>
            </div>
            <?php endif; ?>

			<?php if( get_field('formulario_soho') ) {?>
            <div class="formulario-soho shadow" style="text-align:center;">
                <div id="zf_div_Rdhyk_JxXG95aHtIi-sckHtTGiEh-1q21GGVfY1yZG0"></div>
                <script type="text/javascript">(function() {
                try{
                var f = document.createElement("iframe");
                f.src = 'https://forms.zohopublic.com/rentacenter/form/RACReclutamiento/formperma/Rdhyk_JxXG95aHtIi-sckHtTGiEh-1q21GGVfY1yZG0?zf_rszfm=1';
                f.style.border="none";
                f.style.height="12846px";
                f.style.width="90%";
                f.style.transition="all 0.5s ease";
                var d = document.getElementById("zf_div_Rdhyk_JxXG95aHtIi-sckHtTGiEh-1q21GGVfY1yZG0");
                d.appendChild(f);
                window.addEventListener('message', function (){
                var evntData = event.data;
                if( evntData && evntData.constructor == String ){
                var zf_ifrm_data = evntData.split("|");
                if ( zf_ifrm_data.length == 2 ) {
                var zf_perma = zf_ifrm_data[0];
                var zf_ifrm_ht_nw = ( parseInt(zf_ifrm_data[1], 10) + 15 ) + "px";
                var iframe = document.getElementById("zf_div_Rdhyk_JxXG95aHtIi-sckHtTGiEh-1q21GGVfY1yZG0").getElementsByTagName("iframe")[0];
                if ( (iframe.src).indexOf('formperma') > 0 && (iframe.src).indexOf(zf_perma) > 0 ) {
                var prevIframeHeight = iframe.style.height;
                if ( prevIframeHeight != zf_ifrm_ht_nw ) {
                iframe.style.height = zf_ifrm_ht_nw;
                }
                }
                }
                }
                }, false);
                }catch(e){}
                })();</script>
            </div>
			<?php } ?>      
        </div>
        <div class="col-12 col-md-3 pt-3">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="shadow p-3 vacantes-rac-module">
                        <h2>Acerca de RAC</h2>
                        <img src="<?php echo get_bloginfo('template_url');?>/images/brand/logo-rac-single.png" alt="" class="w-50" style="margin:auto; display:block;">
                        <p>Tenemos un pensamiento que nos hace el lugar ideal para trabajar. Contamos con una serie de valores y lo que nosotros llamamos “impulsores culturales” los cuales nos guían y recuerdan lo que RAC busca impulsar a sus colaboradores a vivir día a día.</p>
                        <h3>Cultura</h3>
                        <p>En Rac ofrecemos una cultura centrada en nuestra Gente, entusiastas de revivir nuestras fiestas y costumbres y con el ánimo de que se trasmita en todas nuestras ubicaciones.</p>
                        <h3>Valores</h3>
                        <ul>
                            <li>Tener espíritu ganador</li>
                            <li>Actuar con corazón de servicio</li>
                            <li>Traer honor a nuestro equipo</li>
                        </ul>
                        <p><a href="<?php bloginfo('url')?>/conocenos/">Más acerca de RAC México</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>



<?php get_footer();?>