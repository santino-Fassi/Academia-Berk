<?php

$datos = $_POST;

$perfil = Perfil::crearPerfil($datos);
$dragon = $perfil->calcularAfinidad();

$_SESSION["nombre"] = $perfil->getNombre();
$_SESSION["dragon"] = $dragon->getId();

?>


<section class="mt-5 mb-5 p-4 p-md-5 bg-light shadow rounded" id="resultadoCompañero">

    <div class="text-center mb-5">

        <h2 class="text-primary mb-4 text-shadow-titles">
            Tu dragón ideal es
        </h2>

        <div class="card mx-auto shadow-sm overflow-hidden">
            <div class="row g-0 align-items-center">

                <div class="col-12 col-md-5 p-3 text-center">
                    <img src="img/dragones/<?= $dragon->getIlustracion()["img"] ?>"
                        alt="<?= $dragon->getIlustracion()["alt"] ?>" class="img-fluid rounded mx-auto d-block">
                </div>

                <div class="col-12 col-md-7">
                    <div class="card-body text-center text-md-start">
                        <h3 class="card-title display-6 text-primary fw-bold mb-2">
                            <?= $dragon->getNombre() ?>
                        </h3>
                        <p class="h4 mb-3">
                            <span class="fw-bold text-primary">Clase: </span>
                            <span class="badge bg-warning"><?= $dragon->getClase() ?></span>
                        </p>

                        <div class="border rounded overflow-hidden mb-3 text-start">
                            <div class="card-header fw-bold h5 mb-0 text-primary">
                                Resumen
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <span class="fw-bold">Peso: </span><?= $dragon->getPeso() ?> Kg
                                </li>
                                <li class="list-group-item">
                                    <span class="fw-bold">Tamaño: </span><?= $dragon->getTamanio()["tipo"] ?>
                                    (<?= $dragon->getTamanio()["ancho"] ?>m x <?= $dragon->getTamanio()["alto"] ?>m)
                                </li>
                                <li class="list-group-item">
                                    <span class="fw-bold">Curiosidad: </span>¿Sabías que los <?= $dragon->getNombre() ?>
                                    tienen
                                    <?= strtolower($dragon->getCaracteristicas()[array_rand($dragon->getCaracteristicas())]) ?>?
                                </li>
                            </ul>
                        </div>

                        <div class="card-footer bg-transparent border-0 px-0 pb-0 text-center text-md-end">
                            <a href="index.php?vista=detalle-dragon&dragon_id=<?= $dragon->getId() ?>"
                                class="btn btn-purple px-4 fw-bold" target="_blank">
                                Saber más
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>

    <a href="index.php?vista=conoceTuCompanero" class="btn btn-secondary">Rehacer formulario</a>
    <a href="index.php?vista=misiones" class="btn btn-primary">¿Estás listo para hacer una misión con tu
        <?= $dragon->getNombre() ?>?</a>



</section>