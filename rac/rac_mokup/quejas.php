<?php include 'sections/header.php'; ?>

<div id="page" data-page="index" class="container">

    <div class="main-page-image">
        <img class="slide-image" src="img/quejas.jpg" alt="Quejas">
    </div>

    <div id="quejas-container">

        <div class="titulo-pagina">
            <h1>¿Que nos quiere decir?</h1>
        </div>

        <form action="">

            <div class="form-row">
                <label>Nombre</label>
                <input type="text">
            </div>

            <div class="form-row">
                <label>Email</label>
                <input type="text">
            </div>

            <div class="form-row">
                <h2>Selecciona una opci&oacute;n</h2>
                <label><input name="opc" type="radio"> Comentario</label>
                <label><input name="opc" type="radio"> Sugerencia</label>
                <label><input name="opc" type="radio"> Queja</label>
            </div>

            <div class="form-row">
                <textarea name=""></textarea>
            </div>

            <div class="buttons">
                <a href="#">Enviar</a>
            </div>

        </form>

    </div>
    <!-- end quejas-container -->

    <div id="quejas-info" class="row">
        <div class="col-xs-6">
            <p>
                <strong>Horario de Servicio al Cliente <br></strong>
                Lunes a viernes: de 9:00 a.m. – 8:45 p.m. hora central <br>
                Sábado: 8:00 a.m. – 7:45 p.m. hora central<br>
                Domingo: Cerrado <br>
            </p>

            <p>
                <strong>Cont&aacute;ctanos por correo electr&oacute;nico:<br></strong>
                <a href="mailto:serviciocliente@rentacenter.com">serviciocliente@rentacenter.com</a>
            </p>
        </div>
        <div class="col-xs-6">
            <p>
                <strong>
                    Para conocer nuestros productos y la ubicaci&oacute;n<br>
                    de nuestras tiendas...<br>
                </strong>
                Llama al 01 800 RACINFO (722-4636)
            </p>

            <p>
                <strong>
                    Para hacer una ACLARACIÓN o dar una SUGERENCIA...<br>
                </strong>
                Llama al 01 800 RACCION (722-2466)
            </p>
        </div>
    </div>

</div>
<!-- end page -->

<?php include 'sections/footer.php'; ?>