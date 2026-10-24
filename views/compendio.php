<?php


$dragones = Dragon::catalogo_completo()

    ?>


<section class="mt-5 mb-5 p-4 p-md-5 bg-light shadow rounded" id="resultadoCompañero">

    <div class="text-center mb-5">

        <h2 class="text-primary mb-4 text-shadow-titles h1">Compendio</h2>
        <p></p>

        <div class="row">

            <?php
            foreach ($dragones as $dragon) {
                ?>
                <div class="col-12 col-md-6 col-lg-4 g-3">
                    <div class="card mx-auto h-100">
                        <img src="img/dragones/<?= $dragon->getIlustracion()["img"] ?>"
                            alt="<?= $dragon->getIlustracion()["alt"] ?>" class="card-img-top">
                        <div class="card-body d-flex flex-column">
                            <h3 class="card-title"><?= $dragon->getNombre() ?></h3>
                            <p class="h4"><span class="fw-bold">Clase: </span> <?= $dragon->getClase() ?></p>
                            <div class="card-header h5">Resumen</div>
                            <ul class="list-group list-group-flush flex-grow-1">
                                <li class="list-group-item"><span class="fw-bold">Peso: </span><?= $dragon->getPeso() ?> Kg
                                </li>
                                <li class="list-group-item"><span class="fw-bold">Tamaño:
                                    </span><?= $dragon->getTamanio()["tipo"] ?> (<?= $dragon->getTamanio()["ancho"] ?>m x
                                    <?= $dragon->getTamanio()["alto"] ?>m)
                                </li>
                                <li class="list-group-item"><span class="fw-bold">Curiosidad: </span>¿Sabías que los
                                    <?= $dragon->getNombre() ?> tienen
                                    <?= strtolower($dragon->getCaracteristicas()[array_rand($dragon->getCaracteristicas())]) ?>?
                                </li>
                            </ul>
                            <div class="card-footer mt-auto">
                                <a href="index.php?vista=detalle-dragon&dragon_id=<?= $dragon->getId() ?>"
                                    class="btn btn-purple" role="button">Saber
                                    más</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>
    </div>


</section>