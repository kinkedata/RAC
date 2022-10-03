<?php 
/* Template Name: Beneficios */ 
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
<h1 class="primary-title mt-4">Beneficios RAC</h1>
<div class="category-description content-page-description">
    <?php the_content(); ?>
</div>
</section>
<section class="container mt-4 content-page pb-4 pt-0 mb-4 decorative-page shadow">
    <div class="row">
         <div class="col pl-0 pr-0 mb-4">
            <img src="<?php echo $imageThumb;?>" alt="<?php echo $imgAttributes["alt"]?>" title="<?php echo $imgAttributes["title"]?>" class="w-100">
        </div>
    </div>
    

    <div id="beneficios">
        <div class="row row-flex">
            <div class="col-md-4 col-12 beneficio-item">
                
                <div class="over-info shadow p-4">
                    <i class="newicn-sinburo"></i>
                    <h3>Sin revisar buró de crédito</h3>
                    <p>Si en otras tiendas estás quemado con el Buró de Crédito. ¡No hay problema!</p>
                    <p><strong>NOSOTROS SÍ CONFIAMOS EN TI.</strong> En RAC es mucho más fácil y rápido, solo necesitas:</p>
                    <ul>
                        <li>Identificación Oficial</li>
                        <li>Comprobar en qué trabajas</li>
                        <li>Comprobante de domicilio</li>
                        <li>4 referencias personales</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-12 beneficio-item">
                
                <div class="over-info shadow p-4">
                    <i class="newicn-sinhistorial"></i>
                    <h3>Sin historial crediticio</h3>
                    <p>Si en otras tiendas no te aceptan por no tener historial, aquí en RAC <strong>NOSOTROS SÍ CONFIAMOS EN TI.</strong></p>
                    <p>Paga poco a poco y sin las broncas del crédito.</p>
                </div>
            </div>
            <div class="col-md-4 col-12 beneficio-item">
                <div class="over-info shadow p-4">
                    <i class="newicn-sinaval"></i> 
                    <h3>Sin aval y sin enganche</h3>
                    <p>Contamos con las <strong>mejores marcas</strong> y no te pedimos que des un enganche, solamente debes realizar tus <strong>pagos puntuales</strong>.</p>
                    <p>En base a tus ingresos o presupuesto, puedes elegir la manera en que quieras pagar más fácil, ya sea:</p>
                    <ul>
                        <li>Semanal</li>
                        <li>Quincenal</li>
                        <li>Mensual</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row row-flex">
            <div class="col-md-4 col-12 beneficio-item">
                <div class="over-info shadow p-4">
                    <i class="newicn-mantenimiento"></i> 
                    <h3>Mantenimiento gratis durante tu contrato</h3>
                    <p>Si de repente hay un problema con el producto que estás rentando en RAC, <strong>¡No te preocupes!</strong></p>
                    <ol style="text-align:left; padding-left: 15px;">
                        <li>Llama a tu tienda RAC, recogeremos el producto para revisar el desperfecto.</li>
                        <li>Te entregaremos temporalmente un producto similar al tipo y condición del actual que reemplace el que se encuentre en servicio</li>
                        <li>Una vez reparado, te devolvemos el producto a tu casa.</li>
                    </ol>
                </div>
            </div>
            <div class="col-md-4 col-12 beneficio-item">
                <div class="over-info shadow p-4">
                    <i class="newicn-entrega"></i> 
                    <h3>Entrega y colocación gratis</h3>
                    <p>Nosotros te llevamos el producto <strong>gratis</strong> hasta tu casa y lo colocamos en el espacio que tu indiques sin costo adicional para ti.</p>
                </div>
            </div>
            <div class="col-md-4 col-12 beneficio-item">
                <div class="over-info shadow p-4">
                    <i class="newicn-congelacuenta"></i> 
                    <h3>Congela tu cuenta en caso de imprevistos hasta por 30 días</h3>
                    <p>Si tuviste un imprevisto, en RAC te entendemos. Congelamos tu cuenta hasta por 30 días y no tendrás que preocuparte. Si antes de los 30 días puedes volver a pagar te regresamos tu producto o uno similar y reanudas la cuenta que ya tenías. Al regresar y renovar tu contrato también puedes actualizar tu producto por otro modelo.</p>
                </div>
            </div>
        </div>
        <div class="row row-flex">
            <div class="col-md-4 col-12 beneficio-item">
                <div class="over-info shadow p-4">
                    <i class="newicn-50desc"></i> 
                    <h3>50% de descuento en tu opción a compra</h3>
                    <p>¿Te cayó un dinerito extra? Puedes liquidar tus pagos antes de finalizar tu contrato y obtener 50% de descuento en tu opción a compra. ¡Tú decides cuando!</p>
                </div>
            </div>
        </div>
    </div>

    <h3 class="mb-4 mt-5">¡Ellos disfrutan los beneficios RAC!</h2>
    <div class="row testimoniales">
        <div class="col-lg-6 beneficio-historia">
            <img src="<?php bloginfo('template_url');?>/images/main/persona-beneficio-rac.png" alt="Testimonio de beneficios RAC" description="Conoce nuestros beneficios RAC">
            <p class="historia-testimonio">"A nosotros nos gusta el trato del personal, somos clientes desde hace 3 años y hemos disfrutado el beneficio de mantenimiento gratis."</p>
            <p class="historia-testimonio"><em>Desde Juárez, Nuevo León</em></p>
        </div>
        <div class="col-lg-6 beneficio-historia">
            <img src="<?php bloginfo('template_url');?>/images/main/testimonio-beneficios-rac.png" alt="Testimonio beneficios RAC" description="Cliente feliz con beneficios RAC">
            <p class="historia-testimonio">"Soy clienta desde hace 1 año y medio, muy contenta con el servicio del personal y considero excelente el beneficio de congelar cuentas en caso de imprevistos."</p>
            <p class="historia-testimonio"><em>Desde Tepic, Nayarit</em></p>
        </div>
    </div>


</section>

<?php get_footer();?>
