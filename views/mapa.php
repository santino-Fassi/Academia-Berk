<?php

$regionSeleccionada = "";

if (isset($_GET["region"])) {
    $regionSeleccionada = $_GET["region"];
}

$region = null;
$dragonesRegion = [];

if ($regionSeleccionada != "") {
    $region = Region::regionPorId($regionSeleccionada);
}

if ($region !== null) {
    $dragones = Dragon::catalogo_completo();

    foreach ($dragones as $dragon) {
        foreach ($dragon->getHabitat() as $habitat) {
            foreach ($region->getHabitats() as $habitatRegion) {
                if (strtolower($habitat) == strtolower($habitatRegion)) {
                    $dragonesRegion[] = $dragon;
                    break 2;
                }
            }
        }
    }
}

?>


<section class="mapa-berk mt-5 mb-5" id="mapaBerk">

    <div class="banner-mapa">
        <img src="img/berk.webp" alt="Vista panorámica de la isla de Berk y sus paisajes" class="imagen-banner-mapa">

        <div class="contenido-banner-mapa">
            <p class="etiqueta-banner-mapa">ARCHIPIÉLAGO DE BERK</p>

            <h2>EXPLORÁ UN MUNDO DE DRAGONES</h2>

            <p>
                Descubrí las regiones del archipiélago, explorá sus territorios
                y conocé los dragones que habitan en cada rincón.
            </p>

            <a href="#mapaInteractivo" class="btn btn-descubrir">
                Explorar el mapa ↓
            </a>
        </div>
    </div>

    <div class="mapa-interactivo" id="mapaInteractivo">

        <img src="img/mapa.webp" alt="Mapa del archipiélago de Berk" class="imagen-mapa">

        <form action="index.php" method="get">
        <input type="hidden" name="vista" value="mapa">

            <button type="submit" name="region" value="berk" class="punto-mapa 
            <?php echo $regionSeleccionada == 'berk' ? 'activo' : ''; ?>" style="left: 66%; top: 49%;"
                aria-label="Explorar la isla de Berk">
            </button>

            <button type="submit" name="region" value="bosques" class="punto-mapa 
            <?php echo $regionSeleccionada == 'bosques' ? 'activo' : ''; ?>" style="left: 29%; top: 52%;"
                aria-label="Explorar los bosques">
            </button>

            <button type="submit" name="region" value="montanas" class="punto-mapa 
            <?php echo $regionSeleccionada == 'montanas' ? 'activo' : ''; ?>" style="left: 64%; top: 10%;"
                aria-label="Explorar las montañas del norte">
            </button>

            <button type="submit" name="region" value="glaciares" class="punto-mapa 
            <?php echo $regionSeleccionada == 'glaciares' ? 'activo' : ''; ?>" style="left: 88%; top: 17%;"
                aria-label="Explorar los glaciares helados">
            </button>

            <button type="submit" name="region" value="fuego" class="punto-mapa 
            <?php echo $regionSeleccionada == 'fuego' ? 'activo' : ''; ?>" style="left: 35%; top: 27%;"
                aria-label="Explorar las montañas de fuego">
            </button>
        </form>

        <?php if ($region !== null) { ?>

            <div class="tarjeta-region" id="informacionRegion">

                <div class="encabezado-tarjeta-region">
                    <div>
                        <p class="etiqueta-mapa mb-1">ARCHIPIÉLAGO DE BERK</p>

                        <h3 class="titulo-region mb-0">
                            <?php echo htmlspecialchars($region->getNombre()); ?>
                        </h3>
                    </div>

                    <a href="index.php?vista=mapa#mapaInteractivo" class="cerrar-tarjeta-region" aria-label="Cerrar tarjeta"
                    style="text-decoration: none; display: flex; align-items: center; justify-content: center;" role="button">
                        ×
                    </a>
                </div>

                <div class="contenido-tarjeta-region">

                    <p class="descripcion-region">
                        <?php echo htmlspecialchars($region->getDescripcion()); ?>
                    </p>

                    <h4 class="h5 mt-4 mb-3">Dragones de la región</h4>

                    <div class="dragones-region">

                        <?php if (count($dragonesRegion) > 0) { ?>

                            <?php foreach ($dragonesRegion as $dragon) { ?>

                                <div class="card mx-auto shadow-sm overflow-hidden">
                                    <div class="row g-0 align-items-center">

                                        <div class="col-12 col-md-5 p-3 text-center">
                                            <img src="img/dragones/<?= $dragon->getIlustracion()["img"] ?>"
                                                alt="<?= $dragon->getIlustracion()["alt"] ?>"
                                                class="img-fluid rounded mx-auto d-block">
                                        </div>

                                        <div class="col-12 col-md-7">
                                            <div class="card-body text-center text-md-start">
                                                <h5 class="h3 card-title display-6 text-primary fw-bold mb-2 italic-font">
                                                    <?= $dragon->getNombre() ?>
                                                </h5>
                                                <p class="h4 mb-3">
                                                    <span class="fw-bold text-primary">Clase: </span>
                                                    <span class="badge bg-warning"><?= $dragon->getClase() ?></span>
                                                </p>

                                                <div class="border rounded overflow-hidden mb-3 text-start">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <span class="fw-bold">Peso: </span><?= $dragon->getPeso() ?> Kg
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="fw-bold">Tamaño:
                                                            </span><?= $dragon->getTamanio()["tipo"] ?>
                                                            (<?= $dragon->getTamanio()["ancho"] ?>m x
                                                            <?= $dragon->getTamanio()["alto"] ?>m)
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="card-footer bg-transparent border-0 px-0 pb-0 text-center text-md-end">
                                                    <a href="index.php?vista=detalle-dragon&dragon_id=<?= $dragon->getId() ?>"
                                                        class="btn btn-purple px-4 fw-bold" target="_blank" role="button">
                                                        Saber más
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            <?php } ?>

                        <?php } else { ?>

                            <p>
                                No hay dragones asociados a esta región según
                                los hábitats registrados en el catálogo.
                            </p>

                        <?php } ?>

                    </div>
                </div>
            </div>

        <?php } ?>

    </div>
</section>

<?php if ($region !== null) { ?>
    <script>
        window.addEventListener("load", function () {
            const mapa = document.getElementById("mapaInteractivo");

            if (mapa) {
                mapa.scrollIntoView({
                    behavior: "instant",
                    block: "center"
                });
            }
        });
    </script>
<?php } ?>
