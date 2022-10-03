<?php 
/* Template Name: Quienes Somos */ 
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
  <h1 class="primary-title mt-4 mb-3">Conócenos</h1>
  <div class="category-description content-page-description">
    <?php the_content(); ?>
    </div>
</section>
<section class="container mt-4 mb-4 content-page decorative-page pb-4 pt-0 shadow">
    <div class="row">
         <div class="col pl-0 pr-0 mb-4">
            <img src="<?php echo $imageThumb;?>" alt="<?php echo $imgAttributes["alt"]?>" title="<?php echo $imgAttributes["title"]?>" class="w-100">
        </div>
    </div>

    <div id="quienes-somos" class="row">
        <div class="col-lg-12 col-12">
            <div class="shadow p-4 mb-4">
                <h2>Cultura RAC</h2>
                <hr class="mb-4">
                <p>Tenemos un pensamiento que nos hace el lugar ideal para trabajar. Contamos con una serie de valores y lo que nosotros llamamos “impulsores culturales” los cuales nos guían y recuerdan lo que RAC busca impulsar a sus colaboradores a vivir día a día.</p>
                <p>Impulsores culturales</p>
                <ul>
                    <li><strong>Conseguimos Resultados:</strong> Nos enfocamos en conseguir mejores resultados en nuestro trabajo, alineados a  los objetivos de la compañía.</li>
                    <li><strong>Nos Enfocamos en el Cliente:</strong> Generamos relaciones de confianza y satisfacción de nuestros clientes internos y externos en base a resultados y nuestra atención.</li>
                    <li><strong>Nos Comunicamos Efectivamente:</strong> Somos claros, directos y honestos, asumimos la responsabilidad de garantizar que nuestras palabras se entiendan.</li>
                    <li><strong>Iniciativa e innovación:</strong> Proponemos mejoras, hacemos nuestro trabajo sin que nos lo pidan, encontramos mejores formas de hacer las cosas que reditúen en un beneficio para la empresa.</li>
                    <li><strong>Hacemos Equipo:</strong>  Buscamos la participación activa de todos los integrantes del equipo y nos comprometemos a favor de una meta en común.</li>
                    <li><strong>Cuidamos Nuestros Recursos:</strong> Administramos eficientemente nuestros recursos, cuidando la rentabilidad de la compañía.</li>
                </ul>
                <p><br>Balance Vida y Trabajo</p>
                <p>En RAC ofrecemos beneficios lograr el equilibrio adecuado entre el Trabajo y la Vida Personal teniendo mayor resultado en la <strong>productividad y compromiso</strong> por parte de los colaboradores con RAC.</p>
                <p><strong><br>Permiso por Maternidad</strong> - Transferencia 4 a 6 semanas de descanso previas al parto para después del mismo, a solicitud de la colaboradora.<br><br> <strong>Permiso por Paternidad</strong> - 10 días disponibles para nuestros colaboradores por paternidad.<br><br> Día Libre de Cumpleaños- Si tu día de cumpleaños es en un día laboral, ¡RAC te lo regala para que lo disfrutes junto a tus seres queridos! <br><br><strong>Adicional, contamos con prestaciones superiores a las de Ley como:</strong></p>
                <ul>
                <li>Seguro de gastos médicos menores familiar</li>
                <li>Fondo de ahorro</li>
                <li>Aguinaldo superior</li>
                <li>Prima vacacional superior</li>
                <li>Vales de despensa</li>
                <li>Descuentos de empleado</li>
                <li>Seguro de vida</li>
                </ul>
            </div>
    
        </div>
        <div class="col-lg-12 col-12">
            <div class="shadow p-4 mb-4">
            <h2>Misión y valores</h2>
            <hr class="mb-4">
                <p>MEJORAR LA CALIDAD DE VIDA DE NUESTROS COMPAÑEROS DE TRABAJO Y DE NUESTROS CLIENTES.</p>
                <p>Respetando los valores fundamentales de la empresa:</p>
                <ul>
                <li>Tener espíritu ganador</li>
                <li>Actuar con corazón de servicio</li>
                <li>Traer honor a nuestro equipo</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-12 col-12">
            <div class="shadow p-4 mb-4">
                <h2>Nuestra historia</h2>
                <hr class="mb-4">
                <p>Somos la ÚNICA tienda que ofrece productos de las mejores marcas para <strong>amueblar el hogar</strong> con la posibilidad de rentarlos en pagos facilitos incluyendo la opción de compra.<br><br> En 1986 se fundó Rent-A-Center (RAC) en Estados Unidos iniciando con tan solo 16 tiendas. Actualmente opera más de 3,000 tiendas en los 50 estados de los Estados Unidos, Washington, D.C., Canadá, Puerto Rico y México. Nuestras oficinas corporativas están localizadas en Plano, Texas. <br><br> El concepto del negocio, renta con opción a compra, desde sus inicios hace como 60 años, nace por cumplir el deseo de un mercado por adquirir productos que necesita pero no cuenta con la capacidad de pago para el monto total y sin oportunidad de crédito. Hoy en día la industria ha crecido $6.7 mil billones de dólares con millones de clientes.<br><br> En Octubre 2010, se iniciaron las operaciones en México con una tienda en Reynosa, Tamaulipas. En 2002 evoluciona la identidad de la empresa a <strong>RAC La mejor forma de comprar</strong> y actualmente hay 122 tiendas en el país, en los siguientes estados: Aguascalientes, Coahuila, Colima, Guanajuato, Jalisco, Nayarit, Nuevo León, Querétaro, San Luis Potosí y Tamaulipas. Hoy más de 70,000 familias mexicanas disfrutan en sus hogares los beneficios de <strong>RAC La mejor forma de comprar.</strong><br><br></p>
                <p>Las empresas adicionales en Rent a Center son:</p>
                <ul>
                <li><strong>Get It Now!</strong> - En Wisconsin, ofrece mercancía basado en ventas con pagos a plazos. 28 tiendas.</li>
                <li><strong>Acceptance Now</strong> - Opera módulos dentro de otras tiendas para ofrecer la facilidad de pago con RTO a quienes no tienen oportunidad del crédito tradicional en estas tiendas.</li>
                <li><strong>Home Choice</strong> - Home Choice opera 17 tiendas en Minnesota y ofrece opciones de compra flexibles con las mejores marcas en muebles, electrodomésticos, electrónica y computadoras.</li>
                <li><strong>RAC La mejor forma de comprar</strong> - Nuestras operaciones en México. 122 tiendas.</li>
                </ul>
            </div>
        </div>
        
    </div>
    
</section>

<?php include(TEMPLATEPATH . '/hr.php') ?>

<?php get_footer();?>
