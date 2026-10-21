<?php


$nombre = $_SESSION["nombre"];
$dragon = Dragon::dragonPorId($_SESSION["dragon"]);

$misiones = Mision::catalogo_completo();

?>


<section class="catalogo-misiones mt-5 mb-5" id="resultadoCompañero">

    <header class="portada-catalogo text-center">
        <span class="sello-catalogo">ACADEMIA DE BERK · TABLÓN OFICIAL</span>

        <h2>Misiones disponibles</h2>

        <div class="separador-catalogo">
            <span>✦</span>
        </div>

        <p>
            <?= $nombre ?>, el Archipiélago necesita jinetes valientes.
            Revisá las expediciones disponibles y preparate para volar.
        </p>

        <div class="estado-catalogo">
            <span class="punto-estado"></span>
            EXPEDICIONES ABIERTAS
        </div>
    </header>

        <div class="grid-misiones">

            <?php
            foreach ($misiones as $mision) {
                $aliado = $mision->sugerirCompaniero($dragon);
                ?>
                <article class="tarjeta-mision">
                <div class="imagen-mision">
                    <img
                        src="img/misiones/<?= $mision->getImagen()["img"] ?>"
                        alt="<?= $mision->getImagen()["alt"] ?>"
                    >
                    <span class="sello-duracion">
                        <?= $mision->getDuracion() ?> DÍAS
                    </span>
                </div>
                
                <div class="contenido-mision">

                    <span class="etiqueta-mision">ORDEN DE MISIÓN</span>
                    <h3><?= $mision->getTitulo() ?></h3>

                    <div class="linea-mision"></div>
                    <p class="objetivo-mision">
                        <?= $mision->getObjetivo() ?>
                    </p>

                    <div class="aliado-mision">
                    <span class="icono-aliado">✦</span>
                    <div>
                        <span class="texto-aliado">COMPAÑERO ASIGNADO</span>
                        <p><?= $aliado->getNombre() ?></p>
                    </div>
                </div>

                    <a href="index.php?vista=detalle-mision&mision=<?=$mision->getId()?>" class="btn btn-primary">Ver Detalles</a>
                </div>
                </article>    
                <?php
            }
            ?>

            <div class="pie-catalogo">
                <span>✦</span>
                <p>Un buen jinete conoce el desafío antes de emprender el vuelo.</p>
                <span>✦</span>
            </div>

</section>