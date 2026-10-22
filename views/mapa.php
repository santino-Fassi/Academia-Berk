<?php



?>


<section class="mapa'berk mt-5 mb-5" id="mapaBerk">
    
    <div class="banner-mapa">
        <img
            src="img/berk.webp"
            alt="Vista panorámica de la isla de Berk y sus paisajes"
            class="imagen-banner-mapa"
        >

        <div class="contenido-banner-mapa">
            <p class="etiqueta-banner-mapa">ARCHIPIÉLAGO DE BERK</p>

            <h2>EXPLORÁ UN MUNDO DE DRAGONES</h2>

            <p>
                Descubrí las regiones del archipiélago, explorá sus territorios
                y conocé los dragones que habitan en cada rincón.
            </p>

            <a href="#mapaInteractivo" class="btn btn-descubrir" id="mapaInteractivo">
                Explorar el mapa ↓
            </a>

        </div>
    </div>


    <div class="mapa-interactivo">

        <img src="img/mapa.webp" alt="ahi ta boba">
        
        <button type="button" class="punto-mapa activo" style="left: 66%; top: 49%;" data-region="berk" aria-label="Explorar la isla de Berk"></button>

        <button type="button" class="punto-mapa activo" style="left: 29%; top: 52%;" data-region="bosques" aria-label="Explorar los bosques"></button>

        <button type="button" class="punto-mapa activo" style="left: 64%; top: 10%;" data-region="montanas" aria-label="Explorar las montañas del norte"></button>

        <button type="button" class="punto-mapa activo" style="left: 88%; top: 17%;" data-region="glaciares" aria-label="Explorar los glaciares helados"></button>

        <button type="button" class="punto-mapa activo" style="left: 35%; top: 27%;" data-region="fuego" aria-label="Explorar las montañas de fuego"></button>

        
        <div class="tarjeta-region" id="informacionRegion" hidden>

            <div class="encabezado-tarjeta-region">
                <div>
                    <p class="etiqueta-mapa mb-1">ARCHIPIÉLAGO DE BERK</p>
                    <h3 class="titulo-region mb-0">Región seleccionada</h3>
                </div>

                <button type="button"
                        class="cerrar-tarjeta-region"
                        id="cerrarTarjetaRegion"
                        aria-label="Cerrar tarjeta">
                    x
                </button>
            </div>

            <div class="contenido-tarjeta-region">
                <p class="descripcion-region"></p>

                <h4 class="h5 mt-4 mb-3">Dragones de la región</h4>

                <div class="dragones-region"></div>
            </div>
        </div>
    </div>
</section>

<script src="scripts/mapa.js"></script>