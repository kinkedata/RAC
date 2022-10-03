<?php get_header();?>

<div class="col-lg-12">
    <?php include(TEMPLATEPATH . '/breadcrumb.php') ?>
</div>
<section class="product-page container mt-4 mb-4 pt-4 pb-4 shadow">

    <div class="row">
        <div class="col-12 col-md-5">
            <?php
                $thumbID = get_post_thumbnail_id(get_the_ID());
                $imageThumb = wp_get_attachment_image_src( $thumbID, 'full' );
                $imagedata = wp_get_attachment($thumbID);
                $preciopromo = get_field('precio_promo');
            ?>
            <div href="<?php echo $imageThumb[0];?>" class="show ">
                <img src="<?php echo $imageThumb[0];?>" alt="<?php echo $imagedata['alt'];?>" title="<?php echo $imagedata['title'];?>" id="show-img" class="w-100">
            </div>
            <div class="small-img">
                <img src="<?php bloginfo('template_url');?>/images/main/online_icon_right@2x.png" class="icon-left" alt="RAC más imagenes" title="RAC Más fotos del catálogo" id="prev-img">
                <div class="small-container">
                    <div id="small-img-roll">
                        <img src="<?php echo $imageThumb[0];?>" alt="<?php echo $imagedata['alt'];?>" title="<?php echo $imagedata['title'];?>" class="show-small-img">
                        <?php 
                            $images = get_field('imagenes_relacionadas');
                            foreach($images as $image ){ ?>
                                <img src="<?php echo $image->guid; ?>" alt="<?php echo $imagedata['alt'];?>" title="<?php echo $imagedata['title'];?>" class="show-small-img">
                            <?php }
                        ?>
                    </div>
                </div>
                <img src="<?php bloginfo('template_url');?>/images/main/online_icon_right@2x.png" class="icon-right" alt="RAC más imagenes" title="RAC Más fotos del catálogo" id="next-img">
            </div>  
        </div>
        <div class="col-12 col-md-4">
            <h1 class="product-page-title"> 
                <?php the_title();?>
            </h1>
            <p>
                <?php echo get_field('sku'); ?>
            </p>
            <h2 class="product-page-price">
                <?php  if($preciopromo) : ?>
                    <span class="price-underline min-price">Precio regular $<?php echo get_field('precio_semanal');?> semanales<br></span>
                    Con promo $<?php echo $preciopromo;?> semanales
                <?php elseif( get_field('extra_promo') ) : ?>
                    <span class="">A $<?php echo get_field('precio_semanal');?> semanales<br></span>
                    <span class="min-price"><?php echo get_field('extra_promo');?></span>
                <?php else : ?>
                    $<?php echo get_field('precio_semanal');?> semanales
                <?php endif; ?>
            </h2>
            <span>Hasta por <?php echo get_field('plazo');?> meses</span>
            <!--
                        <?php if ($preciopromo ) : ?>
                            <span class="price-underline">Precio regular $<?php echo get_field('precio_semanal');?> semanales<br></span>
                            <strong>Buen Fin $<?php echo $preciopromo;?> semanales</strong>
                        <?php else : ?>
                            <span class="">Precio regular $<?php echo get_field('precio_semanal');?> semanales<br></span>
                            <strong><?php echo get_field('extra_promo');?></strong>
                        <?php endif; ?>

            -->
            <hr>
            <h4 class="mt-3 mb-2">Acerca de este artículo</h4>
            <div class="product-page-short-description">
                <?php echo get_field('descripcion_corta');?>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <h3 class="mb-3 product-value-proposition">Disfruta ya los beneficios de rentar con opción a compra y <span>sin las broncas del crédito</span></h3>
            <a href="<?= site_url('solicita-informes/?producto=').get_post_field( 'post_name', get_post() ).'&idprod='.get_the_ID().'&act=proceso'; ?>" class="general-button btn btn-primary m-auto">Inicia tu proceso</a>
            <a href="<?= site_url('solicita-informes/?producto=').get_post_field( 'post_name', get_post() ).'&idprod='.get_the_ID(); ?>" class="general-button btn  mt-2">Solicita más información</a>

            <h2 class="product-price-title-benefits mt-4">Beneficios incluidos</h2>
            <ul class="product-page-benefits">
                <li><i class="newicn-entrega"></i>Entrega y colocación gratis</li>
                <li><i class="newicn-mantenimiento"></i>Mantenimiento gratis</li>
                <li><i class="newicn-sinburo"></i>Sin revisar buró de crédito</li>
                <li><i class="newicn-sinhistorial"></i>Sin historial crediticio</li>
                <li><i class="newicn-sinaval"></i>Sin aval y sin enganche</li>
                <li><i class="newicn-congelacuenta"></i>Congela tu cuenta en caso de imprevistos</li>
                <li><i class="newicn-50desc"></i>50% de descuento en tu opción a compra</li>
            </ul> 
        </div>
    </div>
    <div class="row mt-3 hidden">
        <div class="col-12 col-md-12">
            <div class="product-page-content">
                <h3>Descripción del producto</h3>
                <?php the_content();?>
            </div>
        </div>
    </div>
</section>

<section id="" class="mt-3 mb-3 pt-3 pb-3 container">
    <div class="row row-flex brands-grid content-page" style="background-color: #004B91;">
        <div class="col col-12 col-md-12">
            <p class="text-center" style="margin: 1rem; color: white">La transacción anunciada es un contrato de renta con opción a compra. Consulta disponibilidad de producto en tienda.</p>
        </div>
    </div>
</section>

<?php include(TEMPLATEPATH . '/brands-block.php') ?>
            
<?php get_footer();?>
