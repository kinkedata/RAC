<?php include 'sections/header.php'; ?>

<div id="page" data-page="beneficios" class="container">
    <div class="main-page-image">
        <img class="slide-image" src="img/slides/banner-gana-rac.jpg" alt="Trabajamos">
    </div>

    <div class="gana-rac-logo">
        <img class="img-responsive" src="img/gana-rac.jpg" />
    </div>
    <p id="gana-rac-text">
        ¡Superfácil, registra tus datos y selecciona<br />
        el código GANA RAC que corresponde a tu promoción! Consulta bases y condiciones.
    </p>
    
    <form class="gana-rac">
        <div class="field-item">
            <label>Tienda RAC</label>
            <input type="text" name="tienda" id="tienda" />
        </div>
        <div class="field-item">
            <label>Nombre</label>
            <input type="text" name="nombre" id="nombre" />
        </div>
        <div class="field-item">
            <label>Contacto</label>
            <input type="text" name="contacto" id="contacto" />
        </div>
        <div class="field-item">
            <label>Celular </label>
            <input type="text" name="celular" id="celular" />
        </div>
        <div class="field-item">
            <label>E-mail</label>
            <input type="email" name="email" id="email" />
        </div>
        <div class="field-item">
            <label>Código Gana RAC</label>
            <input type="text" name="codigo" id="codigo" />
        </div>
        <div class="gana-rac-buttons">
            <input type ="checkbox" name="acepto" id="acepto" /><label for="acepto">Aviso de privacidad</label>
            <button type="submit" class="gana-rac-enviar">ENVIAR</button>
            <a class="gana-rac-consulta">Consulta Bases y Condiciones</a>
        </div>
    </form>
   
</div>

<?php include 'sections/footer.php'; ?>