<?php
$datos = $_GET;

$nombre = $_SESSION["nombre"];
$dragon = Dragon::dragonPorId($_SESSION["dragon"]);
$mision = Mision::misionPorId($datos["mision"] ?? 1);
$aliado = $mision->sugerirCompaniero($dragon);

?>

<section class="detalle-info">
    <a href="index.php?vista=misiones" class="btn btn-secondary">Volver</a>
    <div>
        <img class="img-fluid d-block mx-auto" src="img/misiones/<?= $mision->getImagen()["img"] ?>"
            alt="<?= $mision->getImagen()["alt"] ?>">
    </div>
    <div class="text-center row">
        <h2 class=""><?= $mision->getTitulo() ?></h2>
        <h3>Carácteristicas de la misión</h3>
        <ul>
            <li><span class="fw-bold">Clima esperado: </span><?= $mision->getClima() ?></li>
            <li><span class="fw-bold">Tipo de entorno: </span><?= $mision->getTerreno() ?></li>
            <li><span class="fw-bold">Duración de la misión: </span><?= $mision->getDuracion() ?></li>
        </ul>
        <h3><span class="fw-bold h2">Tu Objetivo</span></h3>
        <p><?= $mision->getObjetivo() ?></p>


        <div class="col-12">
            <h3>Tu compañero de misión</h3>
            <p>En Berk nunca hacemos las cosas en solitario. Para facilitar la misión, te asignamos a un compañero cuyo
                dragón se complementa con el tuyo y es ideal para la misión.</p>
            <div class="card card-dragon mx-auto">
                <img src="img/dragones/<?= $aliado->getIlustracion()["img"] ?>"
                    alt="<?= $aliado->getIlustracion()["alt"] ?>" class="card-img-top">
                <div class="card-body">
                    <h3 class="card-title"><?= $aliado->getNombre() ?></h3>
                    <p class="h4"><span class="fw-bold">Clase: </span> <?= $aliado->getClase() ?></p>
                    <div class="card-header h5">Resumen</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><span class="fw-bold">Peso: </span><?= $aliado->getPeso() ?> Kg</li>
                        <li class="list-group-item"><span class="fw-bold">Tamaño:
                            </span><?= $aliado->getTamanio()["tipo"] ?> (<?= $aliado->getTamanio()["ancho"] ?>m x
                            <?= $aliado->getTamanio()["alto"] ?>m)</li>
                        <li class="list-group-item"><span class="fw-bold">Curiosidad: </span>¿Sabías que los
                            <?= $aliado->getNombre() ?> tienen
                            <?= strtolower($aliado->getCaracteristicas()[array_rand($aliado->getCaracteristicas())]) ?>?
                        </li>
                    </ul>
                    <div class="card-footer">
                        <a href="index.php?vista=compendio&dragon_id=1" class="btn btn-purple" target="_blank">Saber más</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12">
            <h3>Aptitudes recomendadas y riesgos</h3>
            <p>La misión cuenta con una serie de características que la harán más o menos difícil dependiendo de los
                dragones que participen.<br>Los elementos marcados en verde, significan que tu dragón cumple con la
                condición. Lo marcado en azul, es lo que vos no cumplís, pero tu compañero sí. Lo marcado en rojo son
                atributos que tu dragón posee y serán perjudiciales en la misión. Y lo marcado en amarillo son los
                atributos de tu compañero que lo perjudicarán a él.</p>
            <div class="row">
                <div class="col-12 col-md-6">
                    <h4>Afinidad de territorios</h4>
                    <p>Los dragones que se saben manejar en estos tipos de entornos se desenvolverán mejor en la misión.
                    </p>
                    <ul>
                        <?php
                        foreach ($mision->getHabitatFavorable() as $habitat) {
                            $clase = "";
                            if (in_array($habitat, $dragon->getHabitat())) {
                                $clase = "text-success fw-bold";
                            } else if (in_array($habitat, $aliado->getHabitat())) {
                                $clase = "text-primary fw-bold";
                            }
                            ?>
                            <li class="<?= $clase ?>"><?= $habitat ?></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-12 col-md-6">
                    <h4>Habilidades Clave</h4>
                    <p>Dragones que tengan las siguientes habilidades tendrán un mejor desempeño en la misión.</p>
                    <ul>
                        <?php
                        foreach ($mision->getHabilidadesClave() as $habilidad) {
                            $clase = "";
                            if (in_array($habilidad, $dragon->getHabilidades())) {
                                $clase = "text-success fw-bold";
                            } else if (in_array($habilidad, $aliado->getHabilidades())) {
                                $clase = "text-primary fw-bold";
                            }
                            ?>
                            <li class="<?= $clase ?>"><?= $habilidad ?></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <h4>Debilidades</h4>
                    <p>Los dragones con las siguientes debilidades poseen tendrán más problemas en la misión.</p>
                    <ul>
                        <?php
                        foreach ($mision->getRiesgosDebilidades() as $debilidad) {
                            $clase = "";
                            if (in_array($debilidad, $dragon->getDebilidades())) {
                                $clase = "text-danger fw-bold";
                            } else if (in_array($debilidad, $aliado->getDebilidades())) {
                                $clase = "text-warning fw-bold";
                            }
                            ?>
                            <li class="<?= $clase ?>"><?= $debilidad ?></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-12 col-md-6">
                    <h4>Tamaños de dragón peligrosos</h4>
                    <p>Los dragones que sean de estos tipos de tamaño se verán perjudicados a la hora de hacer maniobras
                        en la misión.</p>
                    <ul>
                        <?php
                        foreach ($mision->getTamaniosRiesgosos() as $tamanio) {
                            $clase = "";
                            if ($tamanio == $dragon->getTamanio()["tipo"]) {
                                $clase = "text-danger fw-bold";
                            } else if ($tamanio == $aliado->getTamanio()["tipo"]) {
                                $clase = "text-warning fw-bold";
                            }
                            ?>
                            <li class="<?= $clase ?>"><?= $tamanio ?></li>
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
            <h3>Comida necesaria</h3>
            <p class="h5">El viaje va a ser duro. Los dragones tienen un apetito voraz y te demandarán comida. Cada
                dragón tiene su dieta única, procura respetarla si no querés enfadarlos.</p>
            <h4 class="h6">Dieta de los dragones</h4>
            <ul>
                <?php
                foreach ($raciones["dieta_combinada"] as $comida) {
                    $para = "";
                    if (in_array($comida, $dragon->getDieta()) && in_array($comida, $aliado->getDieta())) {
                        $para = $dragon->getNombre() . " y " . $aliado->getNombre();
                    } else if (in_array($comida, $dragon->getDieta())) {
                        $para = $dragon->getNombre();
                    } else {
                        $para = $aliado->getNombre();
                    }
                    ?>
                    <li><span class="fw-bold"><?= $comida ?></span> (Para <?= $para ?>)</li>
                    <?php
                }
                ?>
            </ul>
            <p><span class="fw-bold">Comida mínima necesaria para los dos dragones:</span> <?= $raciones["total_kg"] ?>
                Kg.</p>
        </div>

        <div>
            <a href="index.php?vista=preparacion&mision=<?= $mision->getId() ?>" class="btn btn-primary w-50">Preparar
                Suministros</a>
        </div>
    </div>




</section>