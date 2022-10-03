<?php include 'sections/header.php'; ?>

<div id="page" data-page="beneficios" class="container">
    <div class="main-page-image">
        <img class="slide-image" src="img/slides/banner-como-funciona.jpg" alt="Trabajamos">
    </div>

    <p id="como-funciona-text">
        Imagina una tienda donde no necesitas tener historial crediticio y donde jamás revisan<br />
        el buró.  Con las mejores marcas de muebles, línea blanca, computadoras, electrónica<br />
        y celulares.  <strong>Esto es RAC, en donde amueblar tu casa es ¡Superfácil!</strong>
    </p>
    
    <div class="titulo-pagina">
        <div id="mapa" class="no-border"></div>
        <h1>¿Como funciona?</h1>
    </div>
    
    <div class="pasos-como-funciona">
        <div class="next-step"></div>
        <div class="step step-1">
            <div class="paso"><span class="blue">Paso 1*</span><span class="white">Trae a la tienda RAC</span></div>
            <div class="point-icons">
                <div class="point">
                    <div class="icon"><img src="img/iconos/icono-identificacion.png" width="100%" alt=""></div>
                    <div class="content">Identificación Oficial</div>
                </div>
                <div class="point">
                    <div class="icon"><img src="img/iconos/icono-comprobante.png" width="100%" alt=""></div>
                    <div class="content">Comprobante de domicilio</div>
                </div>
                <div class="point">
                    <div class="icon"><img src="img/iconos/icono-referencias.png" width="100%" alt=""></div>
                    <div class="content">4 referencias personales</div>
                </div>
                <div class="point">
                    <div class="icon"><img src="img/iconos/icono-trabajo.png" width="100%" alt=""></div>
                    <div class="content">Compruébanos en que trabajas</div>
                </div>
            </div>
            <div class="notation">* Sujeto a aprobación</div>
        </div>
        <div class="step step-2">
            <div class="paso"><span class="blue">Paso 2</span><span class="white">Elige tu forma de pago</span></div>
            <div class="point-icons">
                <div class="point">
                    <div class="icon"><img src="img/iconos/icono-semanal.png" width="100%" alt=""></div>
                    <div class="content">Semanal</div>
                </div>
                <div class="point">
                    <div class="icon"><img src="img/iconos/icono-quincenal.png" width="100%" alt=""></div>
                    <div class="content">Quincenal</div>
                </div>
                <div class="point">
                    <div class="icon"><img src="img/iconos/icono-mensual.png" width="100%" alt=""></div>
                    <div class="content">Mensual</div>
                </div>
            </div>
            <div class="notation">&nbsp;</div>
        </div>
        <div class="step step-3">
            <div class="paso"><span class="blue">Paso 3</span><span class="white">Paga de a poco</span></div>
            <div class="point-icons">
                <div class="point">
                    <div class="icon"><img src="img/iconos/icono-compra.png" width="100%" alt=""></div>
                    <div class="content">Ejecuta la opción de compra y el producto es tuyo.</div>
                </div>
            </div>
            <div class="notation">&nbsp;</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-4 beneficio-historia">
            <img src="img/persona1.png" class="historia-persona" />
            <p class="historia-testimonio">
                "Es facilisimo, me llevaron todo hasta mi casa y no tuve que dar enganche."
            </p>
        </div>
        <div class="col-lg-4 beneficio-historia">
            <img src="img/persona2.png" class="historia-persona" />
            <p class="historia-testimonio">
                "Definitivamente RAC es la mejor forma de comprar."
            </p>
        </div>
        <div class="col-lg-4 beneficio-historia">
            <img src="img/persona3.png" class="historia-persona" />
            <p class="historia-testimonio">
                "Me encanta RAC porque tiene de todo y para todos.  Y lo mejor, ¡en pagos facilitos!"
            </p>
        </div>
    </div>
   
</div>

<script>
    $(document).ready(function (){
        $(".next-step").on("click", function (){
            if ( $(".step-1").is(":visible") ){
                $(".step-1").fadeOut(400, function (){
                    $(".step-2").fadeIn();
                });
            }
            if ( $(".step-2").is(":visible") ){
                $(".step-2").fadeOut(400, function (){
                    $(".step-3").fadeIn();
                });
            }
            if ( $(".step-3").is(":visible") ){
                $(".step-3").fadeOut(400, function (){
                    $(".step-1").fadeIn();
                });
            }
        });
    });
</script>

<?php include 'sections/footer.php'; ?>