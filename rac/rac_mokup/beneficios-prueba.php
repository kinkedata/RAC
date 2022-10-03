<?php include 'sections/header.php'; ?>

    <div id="sucursales-rac" class="container">

        <div class="titulo-pagina">
            <h1 class="grey">Tiendas RAC</h1>
        </div>

        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-0 col-lg-3">
                <div id="mapaControles" class="mapa-controles-container">
                    <div class="mapa-control-item">
                        <h2>UBICA TU TIENDA</h2>
                    </div>
                    <div class="mapa-control-item">
                        <label for="estado">Estado</label>
                        <select id="mapa-estado-suc" name="mapa-estado"><option selected="selected"></option></select>
                    </div>
                    <div class="mapa-control-item">
                        <label for="ciudad">Ciudad</label>
                        <select id="mapa-ciudad-suc" name="mapa-ciudad"><option selected="selected"></option></select>
                    </div>
                    <div class="mapa-control-item">
                        <button id="buscar-sucursal" class="blue-submit">BUSCAR</button>
                    </div>
                </div>
            </div>
            <div id="mapaContainer" class="hidden-xs col-sm-8 col-lg-9">
                <div id="map-suc"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="resultados-container">
                    <h2>Resultados</h2>
                    <div id="resultados" class="resultados">

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'sections/footer.php'; ?>