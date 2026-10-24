<?php
$idDragon = ($_GET["dragon_id"] ?? 1);
$dragon = Dragon::dragonPorId($idDragon) ?? Dragon::dragonPorId(1);

$tamanio = $dragon->getTamanio();
$ilustracion = $dragon->getIlustracion();
?>

<section class="mt-5 mb-5 p-4 p-md-5 bg-light shadow rounded" id="detalleDragon">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="index.php?vista=compendio" class="btn btn-secondary" role="button">
            Volver al Compendio
        </a>
    </div>

    <!-- ENCABEZADO E ILUSTRACIÓN PRINCIPAL -->
    <div class="row align-items-center mb-5 g-4">
        <div class="col-12 col-lg-5 text-center">
            <div class="p-3 bg-white border rounded shadow-sm">
                <img src="img/dragones/<?= $ilustracion["img"] ?>" alt="<?= $ilustracion["alt"] ?>"
                    class="img-fluid rounded mx-auto d-block">
            </div>
        </div>

        <div class="col-12 col-lg-7 text-center text-lg-start">
            <p class="d-none d-lg-block text-uppercase fw-bold text-secondary mb-1">Compendio Oficial de Berk</p>
            <h2 class="display-5 text-primary fw-bold mb-2 text-shadow-titles">
                <?= $dragon->getNombre() ?>
            </h2>
            <p class="h4 mb-4">
                <span class="fw-bold text-primary">Clase:</span>
                <span class="badge bg-warning"><?= $dragon->getClase() ?></span>
            </p>

            <!-- FICHA TÉCNICA DE DIMENSIONES Y BIOLOGÍA -->
            <div class="card shadow-sm">
                <div class="card-header fw-bold h5 mb-0 text-primary">
                    Ficha Anatómica y Biológica
                </div>
                <ul class="list-group list-group-flush text-start">
                    <li class="list-group-item">
                        <span class="fw-bold">Porte y categoría:</span> <?= $tamanio["tipo"] ?>
                    </li>
                    <li class="list-group-item">
                        <span class="fw-bold">Dimensiones:</span> <?= $tamanio["ancho"] ?> m de largo x
                        <?= $tamanio["alto"] ?> m de alto
                    </li>
                    <li class="list-group-item">
                        <span class="fw-bold">Envergadura de alas:</span> <?= $tamanio["alas"] ?> m
                    </li>
                    <li class="list-group-item">
                        <span class="fw-bold">Peso promedio:</span>
                        <?= number_format($dragon->getPeso(), 1, ",", ".") ?> Kg
                    </li>
                    <li class="list-group-item">
                        <span class="fw-bold">Colores de escamas:</span>
                        <?php foreach ($dragon->getColores() as $color) { ?>
                            <span class="badge bg-secondary me-1"><?= $color ?></span>
                        <?php } ?>
                    </li>
                    <li class="list-group-item">
                        <span class="fw-bold">Hábitat natural:</span>
                        <?= implode(", ", $dragon->getHabitat()) ?>
                    </li>
                    <li class="list-group-item">
                        <span class="fw-bold">Dieta principal:</span>
                        <?php foreach ($dragon->getDieta() as $alimento) { ?>
                            <span class="badge bg-success me-1"><?= $alimento ?></span>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- HABILIDADES, CARACTERÍSTICAS Y DEBILIDADES -->
    <div class="row g-4">
        <!-- HABILIDADES -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-primary text-light">
                    <h3 class="h5 mb-0">Habilidades de Combate</h3>
                </div>
                <div class="card-body">
                    <p class="small text-muted">Capacidades especiales de vuelo, ataque y defensa registradas por Hipo:
                    </p>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($dragon->getHabilidades() as $habilidad) { ?>
                            <li class="list-group-item fw-bold text-success">
                                ✔ <?= $habilidad ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- CARACTERÍSTICAS FÍSICAS -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-secondary text-light">
                    <h3 class="h5 mb-0">Rasgos Físicos</h3>
                </div>
                <div class="card-body">
                    <p class="small text-muted">Particularidades morfológicas para identificar a la especie:</p>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($dragon->getCaracteristicas() as $caracteristica) { ?>
                            <li class="list-group-item">
                                • <?= $caracteristica ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- DEBILIDADES -->
        <div class="col-12 col-lg-4">
            <div class="card h-100 shadow-sm border-danger">
                <div class="card-header bg-danger text-light">
                    <h3 class="h5 mb-0">Puntos Débiles y Riesgos</h3>
                </div>
                <div class="card-body">
                    <p class="small text-muted">Vulnerabilidades críticas que un jinete debe cuidar en misión:</p>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($dragon->getDebilidades() as $debilidad) { ?>
                            <li class="list-group-item text-danger fw-bold">
                                ⚠ <?= $debilidad ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- NAVEGACIÓN ENTRE FICHAS DEL COMPENDIO -->
    <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
        <?php if ($dragon->getId() > 1) { ?>
            <a href="index.php?vista=detalle-dragon&dragon_id=<?= $dragon->getId() - 1 ?>" class="btn btn-outline-primary" role="button">
                ← Dragón Anterior
            </a>
        <?php } else { ?>
            <span></span>
        <?php } ?>

        <a href="index.php?vista=conoce-tu-companero" class="btn btn-purple fw-bold" role="button">
            Hacer Test de Afinidad
        </a>

        <?php if ($dragon->getId() < count(Dragon::catalogo_completo())) { ?>
            <a href="index.php?vista=detalle-dragon&dragon_id=<?= $dragon->getId() + 1 ?>" class="btn btn-outline-primary" role="button">
                Siguiente Dragón →
            </a>
        <?php } else { ?>
            <span></span>
        <?php } ?>
    </div>

</section>