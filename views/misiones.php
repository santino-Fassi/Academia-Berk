<?php


$nombre = $_SESSION["nombre"];
$dragon = Dragon::dragonPorId($_SESSION["dragon"]);

$misiones = Mision::catalogo_completo();

?>


<section class="mt-5 mb-5 p-4 p-md-5 bg-light shadow rounded" id="resultadoCompañero">

    <div class="text-center mb-5">

        <h2 class="text-primary mb-4 text-shadow-titles">Misiones disponibles</h2>

        <div class="row">

            <?php
            foreach ($misiones as $mision) {
                $aliado = $mision->sugerirCompaniero($dragon);
                ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <h3><?= $mision->getTitulo() ?></h3>
                    <p><?= $mision->getObjetivo() ?></p>
                    <p>Duración: <?= $mision->getDuracion() ?> días</p>
                    <p>Compañero de misión: <?=$aliado->getNombre()?></p>
                    <a href="index.php?vista=detalle-mision&mision=<?=$mision->getId()?>" class="btn btn-primary">Ver Detalles</a>
                </div>
                <?php
            }
            ?>

        </div>
    </div>


</section>