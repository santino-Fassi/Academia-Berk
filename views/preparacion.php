<?php
$datos = $_GET;

$nombre = $_SESSION["nombre"];
$dragon = Dragon::dragonPorId($_SESSION["dragon"]);
$mision = Mision::misionPorId($datos["mision"] ?? 1);
$aliado = $mision->sugerirCompaniero($dragon);
$raciones = $mision->calcularRacionesViaje($dragon, $aliado);
$suministros = Suministro::catalogo_completo();



// Procesamos los suministros seleccionados por POST
$seleccionadosIds = $_POST["suministros"] ?? [];
$_SESSION["suministros_elegidos"] = $seleccionadosIds;
$inventario = Inventario::crearInventario(500, $seleccionadosIds);



// Unimos habilidades y características de ambos dragones
$poolPropio = array_merge($dragon->getHabilidades(), $dragon->getCaracteristicas());
$poolAliado = array_merge($aliado->getHabilidades(), $aliado->getCaracteristicas());
?>

<section class="mt-5 mb-5 p-4 p-md-5 bg-light shadow rounded" id="preparacionMision">
    <a href="index.php?vista=detalle-mision&mision=<?= $mision->getId() ?>" class="btn btn-secondary mb-4" role="button">Volver al detalle</a>

    <div class="text-center mb-5">
        <p class="text-uppercase fw-bold text-primary">Intendencia de Berk</p>
        <h2 class="text-primary mb-3 text-shadow-titles">Preparación para: <?= $mision->getTitulo() ?></h2>
        <p class="lead">
            Valiente <?= $nombre ?>, tenés un presupuesto de <span class="fw-bold"><?= $inventario->getOroInicial() ?> monedas de oro</span>. Elegí sabiamente qué raciones y equipamiento llevar para vos y tu <span class="fw-bold"><?= $dragon->getNombre() ?></span> y tu compañero con su <span class="fw-bold"><?= $aliado->getNombre() ?></span>.
        </p>
    </div>

    <!-- PANEL DE RECURSOS (ORO Y COMIDA) -->
    <?php
    $oroActual = $inventario->getOro();
    $presupuestoExcedido = $oroActual < 0;

    $comidaCubierta = $inventario->obtenerRaciones();
    ?>
    <div class="row text-center mb-5 g-3">
        <div class="col-12 col-md-6">
            <div class="p-3 border rounded bg-white shadow-sm h-100">
                <h3 class="h5 fw-bold">Oro de la Academia</h3>
                <p class="display-6 fw-bold <?= $presupuestoExcedido ? 'text-danger' : 'text-warning' ?>">
                    <?= $oroActual ?> / <?= $inventario->getOroInicial() ?>
                </p>
                <?php if ($presupuestoExcedido){ ?>
                    <p class="text-danger fw-bold mb-0">¡Superaste el oro disponible! Desmarcá suministros para poder partir.</p>
                <?php } else{ ?>
                    <p class="text-muted mb-0">Oro gastado: <?= $inventario->getOroInicial() - $oroActual ?> monedas</p>
                <?php } ?>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="p-3 border rounded bg-white shadow-sm h-100">
                <h3 class="h5 fw-bold">Raciones de Viaje (<?= $mision->getDuracion() ?> días)</h3>
                <p class="display-6 fw-bold <?= ($comidaCubierta["total_kg"] >= $raciones['total_kg']) ? 'text-success' : 'text-danger' ?>">
                    <?= $comidaCubierta["total_kg"] ?> / <?= $raciones["total_kg"] ?> Kg
                </p>
                <p class="mb-0">
                    <span class="fw-bold">Dieta requerida:</span>
                    <?php foreach ($raciones["dieta_combinada"] as $comida){ 
                        $cubierta = in_array($comida, $comidaCubierta["tipos"]);
                    ?>
                        <span class="badge <?= $cubierta ? 'bg-success' : 'bg-secondary' ?> me-1"><?= $comida ?></span>
                    <?php } ?>
                </p>
            </div>
        </div>
    </div>

    <!-- ESTADO DE HABILIDADES Y DEBILIDADES -->
    <?php
    $poolPropio = $dragon->getHabilidades();
    $poolAliado = $aliado->getHabilidades();
    $habilidadesPorItems = $inventario->obtenerHabilidades();

    $debilidadesDragon = $dragon->getDebilidades();
    $debilidadesAliado = $aliado->getDebilidades();
    $debilidadesNeutralizadas = $inventario->obtenerNeutralizantes();
    ?>
    <div class="row mb-5 g-4">
        <!-- HABILIDADES CLAVE -->
        <div class="col-12 col-md-6">
            <div class="p-4 border rounded bg-white h-100">
                <h3 class="h4 text-primary fw-bold mb-3">Habilidades Clave de la Misión</h3>
                <p class="small text-muted">En verde/azul las que ya cubren tus dragones o tus suministros; en negrita las que aún te faltan.</p>
                <ul class="list-group list-group-flush">
                    <?php foreach ($mision->getHabilidadesClave() as $habilidad) { 
                        $clase = "fw-bold text-dark";
                        $origen = "(Faltante)";

                        if (in_array($habilidad, $poolPropio)) {
                            $clase = "text-success fw-bold";
                            $origen = "(Cubierta por " . $dragon->getNombre() . ")";
                        } elseif (in_array($habilidad, $poolAliado)) {
                            $clase = "text-warning fw-bold";
                            $origen = "(Cubierta por " . $aliado->getNombre() . ")";
                        } elseif (in_array($habilidad, $habilidadesPorItems)) {
                            $clase = "text-success fw-bold";
                            $origen = "(Otorgada por Suministro)";
                        }
                    ?>
                        <li class="list-group-item <?= $clase ?>">
                            <?= $habilidad ?> <span class="small fw-normal"><?= $origen ?></span>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <!-- DEBILIDADES Y RIESGOS -->
        <div class="col-12 col-md-6">
            <div class="p-4 border rounded bg-white h-100">
                <h3 class="h4 text-primary fw-bold mb-3">Riesgos y Debilidades</h3>
                <p class="small text-muted">En rojo/amarillo los riesgos activos de tus dragones; tachados los que lograste neutralizar con suministros.</p>
                <ul class="list-group list-group-flush">
                    <?php foreach ($mision->getRiesgosDebilidades() as $debilidad) {
                        $sufrePropio = in_array($debilidad, $debilidadesDragon);
                        $sufreAliado = in_array($debilidad, $debilidadesAliado);
                        $neutralizada = in_array($debilidad, $debilidadesNeutralizadas);

                        $clase = "text-muted";
                        $estado = "(Sin riesgo para tu equipo)";

                        if ($sufrePropio || $sufreAliado) {
                            $afectado = $sufrePropio ? $dragon->getNombre() : $aliado->getNombre();
                            if ($neutralizada) {
                                $clase = "text-success text-decoration-line-through fw-bold";
                                $estado = "(Neutralizada con suministro para $afectado)";
                            } elseif ($sufrePropio) {
                                $clase = "text-danger fw-bold";
                                $estado = "(Peligro activo para " . $dragon->getNombre() . ")";
                            } else {
                                $clase = "text-warning fw-bold";
                                $estado = "(Peligro activo para " . $aliado->getNombre() . ")";
                            }
                        }
                    ?>
                        <li class="list-group-item <?= $clase ?>">
                            <?= $debilidad ?> <span class="small fw-normal"><?= $estado ?></span>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- FORMULARIO DE SELECCIÓN DE SUMINISTROS -->
    <?php

    ?>
    <form action="index.php?vista=preparacion&mision=<?= $mision->getId() ?>" method="post">
        <h3 class="text-primary fw-bold mb-4 text-center">Catálogo de Suministros de Bocón</h3>

        <div class="row g-4 mb-5">
            <?php foreach ($suministros as $item) {
                $checked = $inventario->tengoSuministro($item->getId()) ? "checked" : "";
            ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm <?= $checked ? 'border-primary border-2' : '' ?>">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h4 class="h5 card-title fw-bold mb-0"><?= $item->getNombre() ?></h4>
                                <span class="badge bg-warning fs-6"><?= $item->getPrecio() ?> Oro</span>
                            </div>

                            <p class="text-uppercase small fw-bold text-secondary mb-2">
                                Categoría: <?= $item->getCategoria() ?>
                            </p>
                            <p class="card-text small flex-grow-1"><?= $item->getDescripcion() ?></p>

                            <ul class="list-unstyled small mb-3">
                                <?php if ($item->getAporteKg() > 0) { ?>
                                    <li class="text-success fw-bold">+ <?= $item->getAporteKg() ?> Kg de comida (<?= implode(", ", $item->getAlimentos()) ?>)</li>
                                <?php } ?>
                                <?php if ($item->getOtorgaHabilidad()) { ?>
                                    <li class="text-primary fw-bold">+ Habilidad: <?= $item->getOtorgaHabilidad() ?></li>
                                <?php } ?>
                                <?php if ($item->getNeutralizaDebilidad()) { ?>
                                    <li class="text-danger fw-bold">✔ Neutraliza: <?= $item->getNeutralizaDebilidad() ?></li>
                                <?php } ?>
                            </ul>

                            <div class="form-check mt-auto pt-2 border-top">
                                <?php if ($item->getCategoria() == "racion") { ?>
                                <input onchange="this.form.submit()" class="form-control d-inline w-50" type="number" name="suministros[<?=$item->getId()?>]" id="item_<?= $item->getId() ?>" min="0" value="<?= $inventario->cantidadSuministro($item->getId()) ?>">
                                <label class="form-check-label fw-bold" for="item_<?= $item->getId() ?>">
                                    Unidades
                                </label>
                                <?php } else { ?>
                                <input onchange="this.form.submit()" class="form-check-input" type="checkbox" name="suministros[<?=$item->getId()?>]" 
                                       id="item_<?= $item->getId() ?>" value="<?= 1 ?>" 
                                       <?= $checked ?>>
                                <label class="form-check-label fw-bold" for="item_<?= $item->getId() ?>">
                                    Equipar en las alforjas
                                </label>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- BOTONES DE ACCIÓN -->
        <div class="d-flex justify-content-center gap-3">
            <a href="index.php?vista=preparacion&mision=<?=$mision->getId()?>" class="btn btn-outline-primary btn-lg" role="button">
                Reiniciar Preparación
            </a>

            <a href="index.php?vista=resultado-mision&mision=<?=$mision->getId()?>"
                    class="btn btn-primary btn-lg px-5 fw-bold <?=$presupuestoExcedido? "d-none": ""?>" role="button">
                ¡Emprender Misión!
            </a>
        </div>
    </form>
</section>