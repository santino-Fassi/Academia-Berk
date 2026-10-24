<?php

$nombre = $_SESSION["nombre"];
$dragon = Dragon::dragonPorId($_SESSION["dragon"]);

$idMision = $_GET["mision"] ?? $_SESSION["mision"] ?? 1;
$mision = Mision::misionPorId($idMision);
$aliado = $mision->sugerirCompaniero($dragon);

$suministrosElegidos = $_SESSION["suministros_elegidos"] ?? [];
$inventario = Inventario::crearInventario(500, $suministrosElegidos);

$resultado = $mision->calcularResultadoMision($dragon, $aliado, $inventario);

?>

<section class="mt-5 mb-5 p-4 p-md-5 bg-light shadow rounded" id="resultadoMision">
    <div class="text-center mb-5">
        <p class="text-uppercase fw-bold text-primary">Informe Final de Expedición</p>
        <h2 class="text-primary mb-3 text-shadow-titles"><?= $mision->getTitulo() ?></h2>
        <p class="lead">Jinete al mando: <span class="fw-bold"><?= $nombre ?></span> junto a su <span class="fw-bold"><?= $dragon->getNombre() ?></span> y un <span class="fw-bold"><?= $aliado->getNombre() ?></span></p>
    </div>

    <!-- CARTEL DE PORCENTAJE Y VEREDICTO -->
    <div class="p-4 mb-5 text-center border rounded bg-white shadow-sm">
        <p class="text-uppercase fw-bold text-secondary mb-1">Probabilidad de Éxito</p>
        <p class="display-1 fw-bold text-<?= $resultado["color"] ?> mb-2">
            <?= $resultado["porcentaje"] ?>%
        </p>

        <div class="progress mb-4 barra-chance">
            <div class="progress-bar bg-<?= $resultado["color"] ?> progress-bar-striped progress-bar-animated fw-bold" 
                 role="progressbar" 
                 style="width: <?= $resultado['porcentaje'] ?>%" 
                 aria-valuenow="<?= $resultado['porcentaje'] ?>" aria-valuemin="0" aria-valuemax="100">
                <?= $resultado["porcentaje"] ?>%
            </div>
        </div>

        <h3 class="h2 fw-bold text-<?= $resultado["color"] ?> mb-3"><?= $resultado["veredicto"] ?></h3>
        <p class="lead mb-0"><?= $resultado["mensaje"] ?></p>
    </div>

    <!-- DESGLOSE TÁCTICO DE LA MISIÓN -->
    <div class="row g-4 mb-5">
        <div class="col-12 col-md-6">
            <div class="p-4 border rounded bg-white h-100">
                <h4 class="text-primary fw-bold mb-3">Desempeño y Logística</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Habilidades clave cubiertas:</span>
                        <span class="badge bg-primary rounded-pill">
                            <?= $resultado["habilidades_cubiertas"] ?> / <?= $resultado["habilidades_totales"] ?>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Raciones cargadas en alforjas:</span>
                        <span class="badge <?= ($resultado['kg_llevados'] >= $resultado['kg_requeridos']) ? 'bg-success' : 'bg-danger' ?> rounded-pill">
                            <?= $resultado["kg_llevados"] ?> / <?= $resultado["kg_requeridos"] ?> Kg
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Preferencias de dieta respetadas:</span>
                        <span class="badge bg-info rounded-pill">
                            <?= $resultado["comidas_cubiertas"] ?> / <?= $resultado["comidas_totales"] ?> alimentos
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Oro sobrante en el arca:</span>
                        <span class="badge bg-warning rounded-pill">
                            <?= $inventario->getOro() ?> monedas
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="p-4 border rounded bg-white h-100">
                <h4 class="text-primary fw-bold mb-3">Balance de Riesgos</h4>

                <h5 class="h6 fw-bold text-success">Debilidades neutralizadas con suministros:</h5>
                <?php if (count($resultado["debilidades_neutralizadas"]) > 0) { ?>
                    <ul class="mb-3">
                        <?php foreach ($resultado["debilidades_neutralizadas"] as $neutralizada) { ?>
                            <li class="text-success fw-bold"><?= $neutralizada ?></li>
                        <?php } ?>
                    </ul>
                <?php } else { ?>
                    <p class="text-muted small">Ninguna debilidad fue neutralizada con equipamiento.</p>
                <?php } ?>

                <h5 class="h6 fw-bold text-danger">Peligros sufridos durante la misión:</h5>
                <?php if (count($resultado["debilidades_sufridas"]) > 0 || count($resultado["problemas_tamanio"]) > 0) { ?>
                    <ul class="mb-0">
                        <?php foreach ($resultado["debilidades_sufridas"] as $sufrida) { ?>
                            <li class="text-danger"><?= $sufrida ?></li>
                        <?php } ?>
                        <?php foreach ($resultado["problemas_tamanio"] as $tam) { ?>
                            <li class="text-warning">Dificultad de maniobra por tamaño: <?= $tam ?></li>
                        <?php } ?>
                    </ul>
                <?php } else { ?>
                    <p class="text-success fw-bold mb-0">¡El escuadrón no sufrió ninguna vulnerabilidad crítica!</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- BOTONES DE NAVEGACIÓN -->
    <div class="d-flex flex-wrap justify-content-center gap-3">
        <a href="index.php?vista=preparacion&mision=<?= $mision->getId() ?>" class="btn btn-outline-primary btn-lg" role="button">
            Reintentar Preparación
        </a>
        <a href="index.php?vista=misiones" class="btn btn-primary btn-lg" role="button">
            Elegir otra Misión
        </a>
    </div>
</section>
