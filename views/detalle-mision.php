<?php
$datos = $_GET;

$nombre = $_SESSION["nombre"];
$dragon = Dragon::dragonPorId($_SESSION["dragon"]);
$mision = Mision::misionPorId($datos["mision"] ?? 1);
$aliado = $mision->sugerirCompaniero($dragon);

?>

<section class="detalle-info pagina-mision">

    <!-- NAVEGACIÓN -->
    <div class="navegacion-mision">
        <a href="index.php?vista=misiones" class="btn-volver" role="button">
            ← Volver a las misiones
        </a>

        <span class="sello-mision">
            REGISTRO DE BERK / EXPEDICIÓN
        </span>
    </div>

    <!-- PORTADA -->
    <header class="portada-mision">

        <img class="imagen-portada-mision" src="img/misiones/<?= $mision->getImagen()["img"] ?>"
            alt="<?= $mision->getImagen()["alt"] ?>">

        <div class="contenido-portada-mision">

            <span class="etiqueta-mision">
                INFORME TÁCTICO
            </span>

            <h2 class="h1"><?= $mision->getTitulo() ?></h2>

            <p>
                Prepará a tu equipo. Estudiá el terreno.
                Ningún jinete parte sin conocer los riesgos.
            </p>

        </div>

    </header>

    <!-- DATOS PRINCIPALES -->
    <div class="datos-mision">

        <div class="dato-mision">
            <span class="icono-dato">✦</span>
            <span class="etiqueta-dato">Clima esperado</span>
            <span class="fw-bold"><?= $mision->getClima() ?></span>
        </div>

        <div class="dato-mision">
            <span class="icono-dato">⌖</span>
            <span class="etiqueta-dato">Tipo de terreno</span>
            <span class="fw-bold"><?= $mision->getTerreno() ?></span>
        </div>

        <div class="dato-mision">
            <span class="icono-dato">◷</span>
            <span class="etiqueta-dato">Duración</span>
            <span class="fw-bold"><?= $mision->getDuracion() ?> día<?= $mision->getDuracion() == 1 ? "" : "s" ?></span>
        </div>

    </div>

    <!-- OBJETIVO -->
    <section class="objetivo-mision">

        <div class="insignia-objetivo">OBJETIVO</div>
        <h3 class="h2">La misión</h3>
        <p class="text-light"><?= $mision->getObjetivo() ?></p>

    </section>


    <!-- EQUIPO DE VUELO -->
    <section class="seccion-mision equipo-mision">

        <div class="encabezado-seccion-mision">
            <span class="numero-seccion">01</span>

            <div>
                <p class="sobrelinea">COMPOSICIÓN DEL EQUIPO</p>
                <h3 class="h2">Tu compañero de misión</h3>
            </div>
        </div>

        <p class="introduccion-seccion">
            En Berk, ningún jinete vuela solo. Este dragón acompañará a tu equipo y aportará sus propias habilidades
            durante la expedición.
        </p>
        <div class="card mx-auto shadow-sm overflow-hidden">
            <div class="row g-0 align-items-center">

                <div class="col-12 col-md-5 p-3 text-center">
                    <img src="img/dragones/<?= $aliado->getIlustracion()["img"] ?>"
                        alt="<?= $aliado->getIlustracion()["alt"] ?>" class="img-fluid rounded mx-auto d-block">
                </div>

                <div class="col-12 col-md-7">
                    <div class="card-body text-center text-md-start">
                        <h4 class="h3 card-title display-6 text-primary fw-bold mb-2">
                            <?= $aliado->getNombre() ?>
                        </h4>
                        <p class="h4 mb-3">
                            <span class="fw-bold text-primary">Clase: </span>
                            <span class="badge bg-warning"><?= $aliado->getClase() ?></span>
                        </p>

                        <div class="border rounded overflow-hidden mb-3 text-start">
                            <div class="card-header fw-bold h5 mb-0 text-primary">
                                Resumen
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <span class="fw-bold">Peso: </span><?= $aliado->getPeso() ?> Kg
                                </li>
                                <li class="list-group-item">
                                    <span class="fw-bold">Tamaño: </span><?= $aliado->getTamanio()["tipo"] ?>
                                    (<?= $aliado->getTamanio()["ancho"] ?>m x <?= $aliado->getTamanio()["alto"] ?>m)
                                </li>
                                <li class="list-group-item">
                                    <span class="fw-bold">Curiosidad: </span>¿Sabías que los
                                    <?= $aliado->getNombre() ?>
                                    tienen
                                    <?= strtolower($aliado->getCaracteristicas()[array_rand($aliado->getCaracteristicas())]) ?>?
                                </li>
                            </ul>
                        </div>

                        <div class="card-footer bg-transparent border-0 px-0 pb-0 text-center text-md-end">
                            <a href="index.php?vista=detalle-dragon&dragon_id=<?= $aliado->getId() ?>"
                                class="btn btn-purple px-4 fw-bold" target="_blank" role="button">
                                Saber más
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <div class="col-12 pt-5">
        <h3>Aptitudes recomendadas y riesgos</h3>
        <p>La misión cuenta con una serie de características que la harán más o menos difícil dependiendo de los
            dragones que participen.<br>Los elementos marcados en verde, significan que tu dragón cumple con la
            condición. Lo marcado en azul, es lo que vos no cumplís, pero tu compañero sí. Lo marcado en rojo son
            atributos que tu dragón posee y serán perjudiciales en la misión. Y lo marcado en amarillo son los
            atributos de tu compañero que lo perjudicarán a él.</p>
        <div class="row pt-3">
            <div class="col-12 col-md-6">
                <h4>Afinidad de territorios</h4>
                <p>Los dragones que se saben manejar en estos tipos de entornos se desenvolverán mejor en la misión.
                </p>
                <ul class="ps-0">
                    <?php
                    foreach ($mision->getHabitatFavorable() as $habitat) {
                        $clase = "";
                        if (in_array($habitat, $dragon->getHabitat())) {
                            $clase = "text-success";
                        } else if (in_array($habitat, $aliado->getHabitat())) {
                            $clase = "text-primary";
                        }
                        ?>
                        <li class="opcion-atributo <?= $clase ?>"><?= $habitat ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="col-12 col-md-6">
                <h4>Habilidades Clave</h4>
                <p>Dragones que tengan las siguientes habilidades tendrán un mejor desempeño en la misión.</p>
                <ul class="ps-0">
                    <?php
                    foreach ($mision->getHabilidadesClave() as $habilidad) {
                        $clase = "";
                        if (in_array($habilidad, $dragon->getHabilidades())) {
                            $clase = "text-success";
                        } else if (in_array($habilidad, $aliado->getHabilidades())) {
                            $clase = "text-primary";
                        }
                        ?>
                        <li class="opcion-atributo <?= $clase ?>"><?= $habilidad ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-12 col-md-6">
                <h4>Debilidades</h4>
                <p>Los dragones con las siguientes debilidades poseen tendrán más problemas en la misión.</p>
                <ul class="ps-0">
                    <?php
                    foreach ($mision->getRiesgosDebilidades() as $debilidad) {
                        $clase = "";
                        if (in_array($debilidad, $dragon->getDebilidades())) {
                            $clase = "text-danger";
                        } else if (in_array($debilidad, $aliado->getDebilidades())) {
                            $clase = "text-warning";
                        }
                        ?>
                        <li class="opcion-atributo <?= $clase ?>"><?= $debilidad ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="col-12 col-md-6">
                <h4>Tamaños de dragón peligrosos</h4>
                <p>Los dragones que sean de estos tipos de tamaño se verán perjudicados a la hora de hacer maniobras
                    en la misión.</p>
                <ul class="ps-0">
                    <?php
                    foreach ($mision->getTamaniosRiesgosos() as $tamanio) {
                        $clase = "";
                        if ($tamanio == $dragon->getTamanio()["tipo"]) {
                            $clase = "text-danger";
                        } else if ($tamanio == $aliado->getTamanio()["tipo"]) {
                            $clase = "text-warning";
                        }
                        ?>
                        <li class="opcion-atributo <?= $clase ?>"><?= $tamanio ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>

    </div>

    <div class="col-12">
        <?php
        $raciones = $mision->calcularRacionesViaje($dragon, $aliado);
        ?>

        <section class="seccion-mision provisiones-mision">

            <div class="encabezado-seccion-mision">
                <span class="numero-seccion">02</span>

                <div>
                    <p class="sobrelinea">ANTES DE PARTIR</p>
                    <h3 class="h2">Provisiones de vuelo</h3>
                </div>
            </div>

            <p class="introduccion-seccion">
                Cada dragón tiene su propia dieta. Prepará las
                raciones necesarias para que ambos puedan completar
                la expedición.
            </p>

            <div class="inventario-provisiones">

                <h4 class="h3">Inventario de alimentos</h4>

                <ul class="lista-provisiones">
                    <?php
                    foreach ($raciones["dieta_combinada"] as $comida) {

                        $para = "";
                        if (
                            in_array($comida, $dragon->getDieta()) &&
                            in_array($comida, $aliado->getDieta())
                        ) {
                            $para = $dragon->getNombre()
                                . " y " . $aliado->getNombre();

                        } else if (in_array($comida, $dragon->getDieta())) {
                            $para = $dragon->getNombre();
                        } else {
                            $para = $aliado->getNombre();
                        }
                        ?>

                        <li>
                            <span class="icono-provision">✦</span>

                            <span class="nombre-provision">
                                <?= $comida ?>
                            </span>

                            <span class="destino-provision">
                                <?= $para ?>
                            </span>
                        </li>

                        <?php
                    }
                    ?>
                </ul>

            </div>

            <div class="total-provisiones">
                <span>COMIDA MÍNIMA NECESARIA</span>

                <span class="fw-bold">
                    <?= $raciones["total_kg"] ?> kg
                </span>

                <p>Raciones calculadas para ambos dragones.</p>
            </div>

            <div class="accion-mision">
                <a href="index.php?vista=preparacion&mision=<?= $mision->getId() ?>" class="btn btn-preparar"
                    role="button">
                    Preparar suministros →
                </a>
            </div>
        </section>
    </div>


</section>